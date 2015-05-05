<?php

namespace Sygmaa\Grids\Fields;

/**
 * Class Text
 * @package Sygmaa\Grids\Fields
 */
class Text extends Field
{
    /**
     * @return $this
     */
    function render($data)
    {
        return $data;
    }

    /**
     * @return $this
     */
    function renderFilter()
    {
        return view('grids::fields.text')
            ->with('request', $this->request)
            ->with('field', $this);
    }

    /**
     * @param $model
     * @param $input
     * @return mixed
     */
    function getFilters($model)
    {
        if($input = $this->request->input($this->getName()))
            return $model->orWhere($this->getName(), 'LIKE', "%$input%");
        return $model;
    }
}