<?php

namespace Sygmaa\Grids\Fields;
use Illuminate\Http\Request;
use Lang;
use League\Flysystem\Exception;

/**
 * Class Date
 * @package Sygmaa\Grids\Fields
 * TODO renderFilters()
 * TODO getFilters()
 */
class Boolean extends Field
{

    public function __construct(Request $request, $name, $label)
    {
        parent::__construct($request, $name, $label);
    }


    /**
     * @param $data
     * @return mixed
     */
    function render($row)
    {
        $nameField = $this->getName();
        if(isset($row->$nameField) && $row->$nameField) {
            return Lang::get('grids::grids.yes');
        }
        return Lang::get('grids::grids.no');
    }

    /**
     * @return $this
     */
    function renderFilter()
    {
        throw new Exception('This feature is not implemented. Coming soon.');
    }

    /**
     * @return mixed
     */
    function getFilters($model)
    {
        throw new Exception('This feature is not implemented. Coming soon.');
    }
}