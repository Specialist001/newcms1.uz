<?php
namespace Limber\Database\Migration;

class Blueprint
{
    public $table = '';

    public $primary = '';

    public $columns = [];

    public function __construct(string $table)
    {
        $this->table = $table;
    }

    public function increments($name): Column
    {
        $column = new Column([
            'name'          => $name,
            'type'          => 'int',
            'length'        => 11,
            'autoincrement' => true
        ]);

        array_push($this->columns, $column);

        $this->primary = $name;

        return $column;
    }

    public function integer($name, $length = 11): Column
    {
        $column = new Column([
            'name'      => $name,
            'type'      => 'int',
            'length'    => $length
        ]);

        array_push($this->columns, $column);

        return $column;
    }

    public function string($name, $length = 200): Column
    {
        $column = new Column([
            'name'      => $name,
            'type'      => 'varchar',
            'length'    => $length
        ]);

        array_push($this->columns, $column);

        return $column;
    }

    public function boolean($name): Column
    {
        $column = new Column([
            'name'      => $name,
            'type'      => 'tinyint',
            'default'   => '0',
            'length'    => 1
        ]);

        array_push($this->columns, $column);

        return $column;
    }

    public function text($name): Column
    {
        return $this->add($name, 'text');
    }

    public function datetime($name): Column
    {
        return $this->add($name, 'datetime');
    }

    public function timestamps()
    {
        $this->datetime('created_at');
        $this->datetime('updated_at');
    }

    private function add($name, $type): Column
    {
        $column = new Column([
            'name'      => $name,
            'type'      => $type
        ]);

        array_push($this->columns, $column);
        
        return $column;
    }
}