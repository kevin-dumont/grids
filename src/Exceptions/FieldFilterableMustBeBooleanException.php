<?php

namespace Sygmaa\Grids\Exceptions;

/**
 * Class FieldFilterableMustBeBooleanException
 * @package Sygmaa\Grids\Exceptions
 */
class FieldFilterableMustBeBooleanException extends \Exception {

    protected $message = "The field sortable must be a boolean";
}