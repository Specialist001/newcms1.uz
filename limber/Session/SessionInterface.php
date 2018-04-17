<?php
namespace Limber\Session;


interface SessionInterface
{
    public function initialize();

    public function finalize();

    public function put(string $name, $data);

    public function get(string $name);

    public function has(string $name): bool;

    public function forget(string $name);

    public function flush();

    public function all();

    public function flash(string $name, $data = null);

    public function keep(string $name);

    public function kept();
}