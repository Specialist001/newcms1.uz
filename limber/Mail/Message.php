<?php
declare(strict_types=1);

namespace Limber\Mail;

class Message
{
    protected $to = [];

    protected $subject;

    protected $body;

    /**
     * @return array
     */
    public function getTo(): array
    {
        return $this->to;
    }

    /**
     * @param array $to
     */
    public function setTo(string $to)
    {
        $this->to[] = $to;
    }

    /**
     * @return mixed
     */
    public function getSubject(): string
    {
        return $this->subject;
    }

    /**
     * @param mixed $subject
     */
    public function setSubject(string $subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @param mixed $body
     */
    public function setBody(string $body)
    {
        $this->body = $body;
    }
}