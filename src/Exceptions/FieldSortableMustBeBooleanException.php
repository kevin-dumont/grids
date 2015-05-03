<?php

namespace Sygmaa\Grids\Exceptions;

/**
 * Class FieldSortableMustBeBooleanException
 * @package Sygmaa\Grids\Exceptions
 */
class FieldSortableMustBeBooleanException extends \Exception {

    protected $message = "The field sortable must be a boolean";
}