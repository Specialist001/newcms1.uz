<?php
declare(strict_types=1);

namespace Limber\Exception;

class LimberException extends \Exception
{
    public function getName()
    {
        return 'LimberException';
    }
}