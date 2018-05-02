<?php
namespace Limber\Mokko;

class RecursiveArrayOnlyIterator extends \RecursiveArrayIterator
{
    public function hasChildren()
    {
        return is_array($this->current()) || $this->current() instanceof \Traversable;
    }
}