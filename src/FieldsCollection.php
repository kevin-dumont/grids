<?php

namespace Sygmaa\Grids;

use Sygmaa\Grids\Components\Collection;

class FieldsCollection extends Collection
{

    /**
     * @param Field $field
     * @return mixed
     */
    public function addFields(Field $field)
    {
        return $this->add($field);
    }

    /**
     * @return array
     */
    public function getAll()
    {
        $return = array();

        foreach($this->array as $field)
            $return[] = $field->getName();

        return $return;
    }

    /**
     * @return array
     */
    public function getPrimary()
    {
        foreach($this->array as $field)
        {
            if($field->isPrimary())
                return $field;
        }
        return false;
    }
}