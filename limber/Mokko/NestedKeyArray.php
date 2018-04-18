<?php
namespace Limber\Mokko;

class NestedKeyArray implements \ArrayAccess, \IteratorAggregate
{
    private $array;

    private $keySeparator;

    public function __construct(array &$array, $keySeparator = '.')
    {
        $this->array = $array;
        $this->keySeparator = $keySeparator;
    }

    public function getIterator()
    {
        return new NestedKeyIterator(new RecursiveArrayOnlyIterator($this->array));
    }

    public function offsetExists($offset)
    {
        $keys = explode($this->keySeparator, $offset);
        $ary = &$this->array;
        foreach ($keys as $key) {
            if (!isset($ary[$key])) {
                return false;
            }
            $ary = &$ary[$key];
        }
        return true;
    }
}