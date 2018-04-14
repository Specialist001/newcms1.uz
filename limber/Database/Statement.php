<?php
namespace Limber\Database;

use \PDO;
use \PDOException;

class Statement
{
    protected $sql = '';

    protected $stmt;

    public function __construct(string $sql = '')
    {
        // If we have SQL, prepare the statement.
        if ($sql !== '') {
            $this->prepare($sql);
        }
    }

    public function prepare(string $sql): Statement
    {
        // Prepare the query.
        $this->stmt = Database::connection()->prepare($this->sql = $sql);
        // Return class.
        return $this;
    }

    public function bind($parameter, $value, int $type = 0): Statement
    {
        // Detect the value type if one has not already been set.
        if ($type === 0) {
            switch (strtolower(gettype($value)))
            {
                case 'integer':
                    $type = PDO::PARAM_INT;
                    break;
                case 'boolean':
                    $type = PDO::PARAM_BOOL;
                    break;
                case 'null':
                    $type = PDO::PARAM_NULL;
                    break;
                default:
                    $type = PDO::PARAM_STR;
            }
        }
        // Bind the value.
        $this->stmt->bindValue($parameter, $value, $type);
        // Return class.
        return $this;
    }

    public function execute(): bool
    {
        try {
            return $this->stmt->execute();
        } catch (PDOException $error) {
            echo '<h1>MySQL Error</h1>';
            echo '<p>' . $error->errorInfo[2] . '</p>';
            echo '<h3>Last Query</h3>';
            echo '<p>' . $this->sql . '</p>';
            exit;
        }
        return $this->stmt->execute();
    }

    public function fetch()
    {
        return $this->stmt->fetch(PDO::FETCH_OBJ);
    }

    public function all(): array
    {
        return $this->stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function count(): int
    {
        return $this->stmt->rowCount();
    }

    public function errors(): array
    {
        return $this->stmt->errorInfo();
    }
}