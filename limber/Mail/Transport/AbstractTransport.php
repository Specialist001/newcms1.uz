<?php
declare(strict_types=1);

namespace Limber\Mail\Transport;

use Limber\Mail\Message;

abstract class AbstractTransport
{
    public function sending(Message $mail)
    {
        if (!mail('darking-uz@yandex.ru', 'subject', 'message')) {
            return false;
        }

        return true;
    }
}