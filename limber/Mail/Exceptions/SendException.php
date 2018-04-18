<?php
declare(strict_types=1);

namespace Limber\Mail\Exceptions;

use Limber;

class SendException extends Limber\Exception\LimberException
{
    public function getName()
    {
        return 'Flexi MailSendException';
    }
}