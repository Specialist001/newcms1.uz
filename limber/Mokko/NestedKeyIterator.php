<?php
namespace Limber\Mokko;

use RecursiveArrayIterator;

class NestedKeyIterator extends \RecursiveArrayIterator
{
    private $stack = [];

    private $keySeparator;

    public function __construct(\Traversable $iterator, $separator = '.', $mode = \RecursiveIteratorIterator::LEAVES_ONLY, $flags = 0)
    {
        $this->keySeparator = $separator;
        parent::__construct($iterator, $mode, $flags);
    }

    public function callGetChildren()
    {
        $this->stack[] = parent::key();
        return parent::callGetChildren();
    }

    public function endChildren()
    {
        parent::endChildren();
        array_pop($this->stack);
    }

    public function key()
    {
        $keys = $this->stack;
        $keys[] = parent::key();

        return implode($this->keySeparator, $keys);
    }
}