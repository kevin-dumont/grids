<?php

namespace Sygmaa\Grids;

use Sygmaa\Grids\Components\Collection;

class ActionsCollection extends Collection
{

    /**
     * @param Field $field
     * @return mixed
     */
    public function addAction(Action $action)
    {
        return $this->add($action);
    }

    /**
     * @return array
     */
    public function getMassActions()
    {
        $return = array();

        foreach($this->array as $action){
            if($action->isMassAction())
                $return[] = $action;
        }
        return $return;
    }

    /**
     * @return array
     */
    public function getSingleActions()
    {
        $return = array();

        foreach($this->array as $action){
            if(!$action->isMassAction())
                $return[] = $action;
        }
        return $return;
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
}