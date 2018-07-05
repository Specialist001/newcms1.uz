<?php
declare(strict_types=1);
namespace Limber\Orm;

use Limber\Database\Database;
use Limber\Orm\Exception\ModelException;
use Limber\Limber;

abstract class Model
{
    protected static $table = '';

    protected $attributes = [];

    protected $guarded = ['id'];

    public function __construct()
    {
    }

    public static function getTable(): string
    {
        return static::$table;
    }

    public function __get(string $attribute)
    {
        return $this->getAttribute($attribute);
    }

    public function __set(string $attribute, $value)
    {
        $this->setAttribute($attribute, $value);
    }

    public function attributes(): array
    {
        return $this->attributes;
    }

    public function getAttribute(string $attribute)
    {
        return $this->attributes[$attribute] ?? false;
    }

    public function setAttribute(string $attribute, $value)
    {
        $this->attributes[$attribute] = $value;
    }

    public function hasAttribute(string $attribute): bool
    {
        return isset($this->attributes[$attribute]);
    }

    public function save(): bool
    {
        // Get the model attributes.
        //$attributes = $this->attributes();

        $attributes = [];

        if (method_exists($this, 'columnMap')) {
            $columnMap = $this->columnMap();

            foreach ($columnMap as $column => $map) {
                if (empty($this->$map)) continue;

                $attributes[$column] = $this->$map;
            }
        } else {
            throw new ModelException('Missing columnMap');
        }

        // Remove guarded attributes.
        foreach ($this->guarded as $guarded) {
            if (isset($attributes[$guarded])) {
                unset($attributes[$guarded]);
            }
        }

        // Instantiate query.
        $query = static::query();

        // If we have an id then update the record.
        if (method_exists($this, 'getId') && $this->getId('id')) {
            $query  = $query->where('id', '=', $this->getId('id'));
            $saved  = $query->edit($attributes);
        } else {
            $saved  = $query->create($attributes);

            // If successfully created, add the insert id.
            if ($saved) {
                if (method_exists($this, 'setId')) {
                    $this->setId(Database::insertId());
                }
            }
        }

        // Return true if successfully saved.
        return $saved;
    }

    public static function findFirst(int $id)
    {
        $query = new Query(static::$table, get_called_class());

        $result = $query
            ->select()
            ->where('id', '=', $id)
            ->first();

        return $result;
    }

    public static function all(): array
    {
        $query = static::query();
        return $query->all();
    }

    public static function select(array $fields = []): Query
    {
        $query = static::query();
        return $query->select($fields);
    }

    /**
     * @param string $column      The name of the column.
     * @param string $operator    The clause operator.
     * @param mixed $value        The value to check against the column.
     * @return \Limber\Orm\Query
     */
    public static function where(string $column, string $operator = '=', $value): Query
    {
        $query = static::query();
        return $query->where($column, $operator, $value);
    }

    public static function query(): Query
    {
        return new Query(static::$table, get_called_class());
    }
}