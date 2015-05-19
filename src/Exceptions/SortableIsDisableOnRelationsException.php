<?php
/**
 * Created by PhpStorm.
 * User: sygmaa
 * Date: 08/05/2015
 * Time: 00:02
 */

namespace Sygmaa\Grids\Exceptions;


class SortableIsDisableOnRelationsException extends \Exception {

    protected $message = "Relation fields are not sortable";
}