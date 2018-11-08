<?php

class Collection implements IteratorAggregate
{
    private $items = [];

    public function __construct($items = [])
    {
        $this->items = $items;
    }

    public function getIterator()
    {
        return (function () {
            while(list($key, $val) = each($this->items)) {
                yield $key => $val;
            }
        })();
    }
}

$data = [ 'A', 'B', 'C', 'D' ];
$collection = new Collection($data);

foreach ($collection as $key => $val) {
    echo sprintf("[%s] => %s\n", $key, $val);
}