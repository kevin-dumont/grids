<?php

namespace Sygmaa\Grids;
use Illuminate\Http\Request;

/**
 * Class SingleAction
 * @package Sygmaa\Grids
 */
class SingleAction extends Action {

    /**
     * @var
     */
    private $callback;

    /**
     * @param Request $request
     * @param $label
     * @param $callback
     */
    public function __construct(Request $request, $label, $callback)
    {
        parent::__construct($request, $label);
        $this->callback = $callback;
    }

    /**
     * @return mixed
     */
    public function getCallback($label, $row = false)
    {
        $return = $this->callback;

        if($row && is_callable($return))
            return $return($label, $row);
        return false;
    }

    /**
     * @param mixed $callback
     */
    public function setCallback($callback)
    {
        $this->callback = $callback;
    }
}