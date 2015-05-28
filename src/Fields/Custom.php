<?php

namespace Sygmaa\Grids\Fields;
use Illuminate\Http\Request;

/**
 * Class Custom
 * @package Sygmaa\Grids\Fields
 */
class Custom extends Field
{
    /**
     * @var
     */
    private $callback;

    public function __construct(Request $request, $name, $label, $callback)
    {
        parent::__construct($request, $name, $label);
        $this->callback = $callback;
    }

    /**
     * @param $data
     * @return mixed
     */
    function render($row)
    {
        $return = $this->callback;

        if($row && is_callable($return))
            return $return($row);
        return false;
    }

    /**
     * @return $this
     */
    function renderFilter()
    {
        throw new \Exception('This feature is disabled for this field');
    }

    /**
     * @return mixed
     */
    function getFilters($model)
    {
        throw new \Exception('This feature is disabled for this field');
    }
}