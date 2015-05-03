<?php

namespace Sygmaa\Grids\Exceptions;

/**
 * Class FieldNameMustBeStringException
 * @package Sygmaa\Grids\Exceptions
 */
class FieldNameMustBeStringException extends \Exception {

    protected $message = "The field name must be a string";
}