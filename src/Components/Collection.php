<?php

namespace Sygmaa\Grids\Components;

class Collection implements \IteratorAggregate  {

    /**
     * @var
     */
    public $array = array();

    /**
     * @var int
     */
    private $count = 0;


    /**
     * @param $array
     * @return mixed
     */
    final protected function add($array)
    {
        $this->array[$this->count++] = $array;
        return $this->array[$this->count - 1];
    }

    /**
     * @return Iterator
     */
    public function getIterator()
    {
        return new Iterator($this->array);
    }
}