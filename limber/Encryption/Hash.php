<?php
namespace Limber\Encryption;

use Exception;

class Hash
{
    public static function validAlgo(string $algo): bool
    {
        return in_array($algo, hash_algos());
    }

    public static function make(string $data, string $algo = 'md5'): string
    {
        // Check that we are using a valid algorithm.
        if (!self::validAlgo($algo)) {
            throw new Exception(
                sprintf('Invalid hashing algorithm: %s.', $algo)
            );
        }
        return hash($algo, $data);
    }
}