<?php

namespace Sygmaa\Grids;


use Illuminate\Http\Request;
use Sygmaa\Grids\Exceptions\MassAttributeMustBeBooleanException;

/**
 * Class Action
 * @package Sygmaa\Grids
 */
abstract class Action {

    /**
     * @var
     */
    protected $label;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @param $label
     * @param $url
     * @param $mass
     */
    public function __construct(Request $request, $label)
    {
        $this->request = $request;
        $this->label   = $label;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @return mixed
     */
    public function isMassAction()
    {
        return is_a($this, 'Sygmaa\Grids\MassAction');
    }

    /**
     * @param mixed $label
     */
    public function setLabel($label)
    {
        $this->label = $label;
    }
}