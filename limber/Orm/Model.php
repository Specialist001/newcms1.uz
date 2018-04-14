<?php
namespace Limber\Orm;

use Limber\Database\Database;

class Model
{
    protected static $table = '';

    protected $attributes = [];

    protected $guarded = ['id'];

    public function __construct()
    {
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
        $attributes = $this->attributes();

        // Remove guarded attributes.
        foreach ($this->guarded as $guarded) {
            if (isset($attributes[$guarded])) {
                unset($attributes[$guarded]);
            }
        }

        // Instantiate query.
        $query  = static::query();

        // If we have an id then update the record.
        if ($this->hasAttribute('id')) {
            $query  = $query->where('id', '=', $this->getAttribute('id'));
            $saved  = $query->edit($attributes);
        } else {
            $saved  = $query->create($attributes);

            // If successfully created, add the insert id.
            if ($saved) {
                $this->setAttribute('id', Database::insertId());
            }
        }

        // Return true if successfully saved.
        return $saved;
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