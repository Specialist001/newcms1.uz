<?php
namespace Limber\Orm;

use Limber\Database\Statement;
use Exception;

class Query
{
    protected $table = '';

    protected $sql = '';

    protected $model = '';

    protected $insert = [];

    protected $update = [];

    protected $delete = [];

    protected $select = [];

    protected $where = [];

    protected $orderBy = [];

    protected $stmt;

    protected $result;

    private $methods = [
        'create',
        'read',
        'update',
        'delete',
        'describe'
    ];

    public function __construct(string $table = '', string $model = '')
    {
        $this->table = $table;
        $this->model = $model;
    }

    public function insert(array $data)
    {
        $this->insert = array_merge($this->insert, $data);
        return $this;
    }

    public function update(array $data)
    {
        $this->update = array_merge($this->update, $data);
        return $this;
    }

    public function delete()
    {
        return $this;
    }

    public function select(array $fields = [])
    {
        $this->select = array_merge($this->select, $fields);
        return $this;
    }

    public function where(string $column, string $operator = '=', $value): Query
    {
        array_push($this->where, compact('column', 'operator', 'value'));
        return $this;
    }

    public function orderBy(string $column, string $direction = 'asc'): Query
    {
        array_push($this->orderBy, compact('column', 'direction'));
        return $this;
    }

    public function run(string $method = 'read'): Query
    {
        // Normalize the method.
        $method = strtolower($method);

        // Ensure this is a valid query method.
        if (!in_array($method, $this->methods)) {
            throw new Exception(
                sprintf('Invalid query method: %s', $method)
            );
        }

        // Ensure the SQL is cleared.
        $this->sql = '';

        // The builder methods we run depends on the query method.
        switch ($method) {
            case 'read':
                $this->sql .= Builder::select($this->select);
                $this->sql .= Builder::from($this->table);
                $this->sql .= Builder::where($this->where);
                break;
            case 'create':
                $this->sql .= Builder::insert($this->table, $this->insert);
                break;
            case 'update':
                $this->sql .= Builder::update($this->table, $this->update);
                $this->sql .= Builder::where($this->where);
                break;
            case 'delete':
                $this->sql .= Builder::delete($this->table);
                $this->sql .= Builder::where($this->where);
                break;
            case 'describe':
                $this->sql .= Builder::describe($this->table);
                break;
        }

        // Instantiate the statement.
        $this->stmt = new Statement($this->sql);

        // Bind WHERE values.
        foreach ($this->where as $where) {
            $this->stmt->bind(':' . $where['column'], $where['value']);
        }

        // Do we need to bind INSERT values.
        if ($method === 'create' || $method === 'update') {
            $property = $method === 'create' ? 'insert' : 'update';
            foreach ($this->$property as $key => $value) {
                $this->stmt->bind(':' . $key, $value);
            }
        }

        // Execute the statement.
        $this->result = $this->stmt->execute();

        // Return object.
        return $this;
    }

    /**
     * @param string $sql
     * @return array
     */
    public static function result(string $sql)
    {
        // Instantiate the statement.
        $stmt = new Statement($sql);
        $stmt->execute();

        return $stmt->all();
    }

    public function create(array $attributes = []): bool
    {
        if (!empty($attributes)) {
            $this->insert($attributes);
        }
        return $this->run('create') ? true : false;
    }

    public function edit(array $attributes = []): bool
    {
        if (!empty($attributes)) {
            $this->update($attributes);
        }
        return $this->run('update') ? true : false;
    }

    public function all(): array
    {
        // Execute the query.
        $this->run('read');

        // Fetch results.
        $fetched = $this->stmt->all();

        // Do we need to assign results against a model.
        if ($this->model !== null) {
            $records = [];
            foreach ($fetched as $record) {
                $model = new $this->model;
                foreach ($record as $attribute => $value) {
                    $model->$attribute = $value;
                }
                array_push($records, $model);
            }
        } else {
            $records = $fetched;
        }

        // Fetch results.
        return $records;
    }

    public function first()
    {
        // Execute the query.
        $this->run('read');

        // Fetch results.
        $fetched = $this->stmt->fetch();

        // Don't continue if fetched is null.
        if ($fetched === false) return false;

        // Do we have a model to instantiate?
        if ($this->model !== null && is_object($fetched)) {
            $record = new $this->model;
            foreach ($fetched as $attribute => $value) {
                $record->$attribute = $value;
            }
        } else {
            $record = $fetched;
        }

        // Return record.
        return $record;
    }

    public function describe(): array
    {
        if ($this->run('describe')) {
            return $this->stmt->all();
        } else {
            return [];
        }
    }

    public static function table(string $table, string $model = '')
    {
        $class = get_called_class();

        if ($model == '') {
            $model = $class;
        }

        return new $class($table, $model);
    }
}