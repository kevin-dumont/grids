<?php

namespace Sygmaa\Grids;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

/**
 * Class GridsShortcuts
 * @package Sygmaa\Grids
 */
class GridsShortcuts {

    /**
     * @var Request
     */
    private $request;

    /**
     * Constructor
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * @param Model $model
     * @return mixed
     */
    public function make(Model $model)
    {
        return new Grids($this->request, $model);
    }

    /**
     * @param $label
     * @param $callback
     * @return Action
     */
    public function action($label, $callback)
    {
        return new SingleAction($this->request, $label, $callback);
    }

    /**
     * @param $label
     * @param $url
     * @return Action
     */
    public function massAction($label, $url)
    {
        return new MassAction($this->request, $label, $url);
    }

    /**
     * @param $name
     * @param $label
     * @return Field
     */
    public function field($name, $label)
    {
        return new Field($this->request, $name, ($label !== "") ? $label : $name);
    }
}
