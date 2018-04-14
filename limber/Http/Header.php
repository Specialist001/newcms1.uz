<?php
namespace Limber\Http;


class Header
{
    public static function sent(string $header = ''): bool
    {
        // Are we just checking if headers have been sent?
        if ($header === '') {
            return headers_sent();
        } else {

            // Normalize the header.
            $header = strtolower($header);

            // Check headers.
            foreach (static::get() as $sent) {

                // Get the header name.
                $name = explode(':', $sent);
                $name = strtolower($name[0]);

                // If it matches, return true.
                if ($name === $header) {
                    return true;
                }
            }
        }

        // Nothing found.
        return false;
    }

    public static function get(): array
    {
        return headers_list();
    }

    public static function send(string $header, string $data = '', bool $replace = true)
    {
        header($header . ($data !== '' ? ':' . $data : ''), $replace);
    }

    public static function remove(string $header)
    {
        header_remove($header);
    }

}