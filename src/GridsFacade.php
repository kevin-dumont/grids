<?php namespace Sygmaa\Grids;

use Illuminate\Support\Facades\Facade;

class GridsFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor() { return 'grids'; }

}
