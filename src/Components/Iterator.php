<?php

namespace Sygmaa\Grids\Components;

class Iterator implements \Iterator {

    private $array = array();

    /**
     * @param $array
     */
    public function __construct(array $array)
    {
        if (is_array($array))
            $this->array = $array;
    }

    /**
     *
     */
    public function rewind()
    {
        reset($this->array);
    }

    /**
     * @return mixed
     */
    public function current()
    {
        return current($this->array);
    }

    /**
     * @return mixed
     */
    public function key()
    {
        return key($this->array);
    }

    /**
     * @return mixed
     */
    public function next()
    {
        return next($this->array);
    }

    /**
     * @return bool
     */
    public function valid()
    {
        return ($this->key() !== null && $this->key() !== false);
    }
}