<?php
namespace Limber\Session\Driver;

use Limber\Session\SessionDriver;
use Limber\Session\SessionInterface;


class Native extends SessionDriver implements SessionInterface
{
    protected $keep = [];

    public function initialize(): bool
    {
        if (!headers_sent()) {
            session_start();
        }

        if (!isset($_SESSION[$this->key])) {
            $_SESSION[$this->key] = [];
        }

        if (!isset($_SESSION['flash'])) {
            $_SESSION['flash'] = [];
        }

        return true;
    }

    public function finalize(): bool
    {
        foreach (array_keys($this->kept()) as $name) {
            if (!in_array($name, $this->keep, true)) {
                unset($_SESSION['flash'][$name]);
            }
        }

        return true;
    }

    public function put(string $name, $data): SessionDriver
    {
        // Insert the session data.
        $_SESSION[$this->key][$name] = $data;

        // Return class instance.
        return $this;
    }

    public function get(string $name)
    {
        return $_SESSION[$this->key][$name] ?? false;
    }

    public function has(string $name): bool
    {
        return isset($_SESSION[$this->key][$name]);
    }

    public function forget(string $name): SessionDriver
    {
        if ($this->has($name)) {
            unset($_SESSION[$this->key][$name]);
        }
        return $this;
    }

    public function flush(): SessionDriver
    {
        $_SESSION[$this->key] = [];
        return $this;
    }

    public function all(): array
    {
        return $_SESSION[$this->key] ?? [];
    }

    public function flash(string $name, $data = null)
    {
        // If data is null return what is stored.
        if ($data === null) {
            return $_SESSION['flash'][$name] ?? false;
        } else {

            // Keep this for the next request.
            $this->keep($name);

            // Store data.
            return $_SESSION['flash'][$name] = $data;
        }
    }

    public function keep(string $name): SessionDriver
    {
        // Store in the keep array if it isn't there already.
        if (!in_array($name, $this->keep, true)) {
            array_push($this->keep, $name);
        }

        // Return session object.
        return $this;
    }

    public function kept()
    {
        return $this->keep;
    }

}