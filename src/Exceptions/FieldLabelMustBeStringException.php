<?php

namespace Sygmaa\Grids\Exceptions;

/**
 * Class FieldLabelMustBeStringException
 * @package Sygmaa\Grids\Exceptions
 */
class FieldLabelMustBeStringException extends \Exception {

    protected $message = "The field label must be a string";
}