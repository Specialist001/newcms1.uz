<?php
namespace Limber\Orm\Exception;

use Exception;

class ModelException extends Exception
{
    public function getName()
    {
        return 'OrmModelException';
    }
}