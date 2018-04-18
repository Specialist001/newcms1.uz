<?php
declare(strict_types=1);

namespace Limber\Mail;

interface InterfaceMailer
{
    function send(Message $mail): void;
}