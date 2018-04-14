<?php
namespace Limber\Orm\Behaviour;

class Builder
{
    public static function insert(string $table, array $insert): string
    {
        $set    = [];
        $values = [];
        foreach (array_keys($insert) as $column) {
            array_push($set, $column);
            array_push($values, ':' . $column);
        }

        return 'INSERT INTO ' . $table . ' (' . implode(', ', $set) . ') VALUES (' . implode(', ', $values) . ') ';
    }

    public static function update(string $table, array $attributes): string
    {
        $set = [];
        foreach (array_keys($attributes) as $column) {
            array_push($set, '`' . $column . '` = :' . $column);
        }

        return 'UPDATE ' . $table . ' SET ' . implode(', ', $set);
    }

    public static function delete(string $table): string
    {
        return 'DELETE FROM ' . $table;
    }

    public static function select(array $fields = []): string
    {
        if (empty($fields)) {
            return 'SELECT * ';
        } else {
            return 'SELECT ' . implode(', ', $fields) . ' ';
        }
    }

    public static function from(string $table): string
    {
        return ' FROM ' . $table;
    }

    public static function where(array $where = []): string
    {
        // Return nothing if $where is empty.
        if (empty($where)) {
            return '';
        } else {
            $clause = ' WHERE ';
            $first  = true;
            foreach ($where as $w) {
                $value = ':' . $w['column'];
                if ($first == false) {
                    $clause .= ' AND ';
                }
                $clause .= $w['column'] . ' ' . $w['operator'] . ' ' . $value;
                $first = false;
            }
        }
        return $clause;
    }

    public static function describe(string $table): string
    {
        return 'DESCRIBE ' . $table;
    }
}