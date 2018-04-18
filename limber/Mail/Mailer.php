<?php
declare(strict_types=1);

namespace Limber\Mail;

use Limber;

class Mailer implements InterfaceMailer
{
    const NAMESPACE_COMPONENT = 'Limber\\Mail\\Transport\\%s';

    protected $transport;

    public function __construct(string $nameTransport = 'Mail', array $config =[])
    {
        $transport = sprintf(self::NAMESPACE_COMPONENT, $nameTransport);

        $this->transport = new $transport;
    }

    function send(Message $mail): void
    {
        $this->transport->send($mail);
    }
}