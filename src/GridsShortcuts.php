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
    public function text($name, $label)
    {
        return new Fields\Text($this->request, $name, ($label !== "") ? $label : $name);
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
