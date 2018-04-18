<?php
declare(strict_types=1);

namespace Limber\Mail\Transport;

use Limber\Mail\InterfaceMailer;
use Limber\Mail\Message;

class Mail extends AbstractTransport implements InterfaceMailer
{
    public function send(Message $mail): void
    {
        $this->sending($mail);
    }
}