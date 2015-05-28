<?php

namespace Sygmaa\Grids;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Sygmaa\Grids\Fields as Fields;

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
     * @return Fields\Text
     */
    public function text($name, $label = null)
    {
        return new Fields\Text($this->request, $name, isset($label) ? $label : $name);
    }

    /**
     * @param $name
     * @param $label
     * @param $modelName
     * @return Fields\ManyRelation
     */
    public function manyRelation($name, $label, $modelName)
    {
        return new Fields\ManyRelation($this->request, $name, $label, $modelName);
    }

    /**
     * @param $name
     * @param $label
     * @param $modelName
     * @return Fields\ManyRelation
     */
    public function oneRelation($name, $label, $modelName)
    {
        return new Fields\OneRelation($this->request, $name, $label, $modelName);
    }

    /**
     * @param $name
     * @param $label
     * @return Fields\Boolean
     */
    public function boolean($name, $label)
    {
        return new Fields\Boolean($this->request, $name, $label);
    }

    public function custom($name, $label, $callback)
    {
        return new Fields\Custom($this->request, $name, $label, $callback);
    }

    /**
     * @param $name
     * @param $label
     * @return Fields\Date
     */
    public function date($name, $label, $formatting)
    {
        return new Fields\Date($this->request, $name, $label, $formatting);
    }

    /**
     * @return \Illuminate\View\View
     */
    public function head()
    {
        return view('grids::assets.head');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function styles()
    {
        return view('grids::assets.styles');
    }

    /**
     * @return \Illuminate\View\View
     */
    public function scripts()
    {
        return view('grids::assets.scripts');
    }
}
