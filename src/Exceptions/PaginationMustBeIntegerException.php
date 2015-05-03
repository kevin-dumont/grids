<?php

namespace Sygmaa\Grids\Exceptions;

class PaginationMustBeIntegerException extends \Exception {

    protected $message = "The pagination must be an integer";
}