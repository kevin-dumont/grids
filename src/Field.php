<?php

namespace Sygmaa\Grids;

use Illuminate\Http\Request;
use Sygmaa\Grids\Exceptions\FieldNameMustBeStringException;
use Sygmaa\Grids\Exceptions\FieldLabelMustBeStringException;
use Sygmaa\Grids\Exceptions\FieldSortableMustBeBooleanException;
use Sygmaa\Grids\Exceptions\FieldFilterableMustBeBooleanException;

/**
 * Class Field
 * @author DUMONT Kévin
 */
class Field {

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $label;

    /**
     * @var bool
     */
    protected $sortable;

    /**
     * @var bool
     */
    protected $filterable;

    /**
     * @var bool
     */
    protected $visible;

    /**
     * @var int
     */
    protected $primary;

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->name;
    }

    /**
     * @param Request $request
     * @param Grids $grids
     * @param $name
     * @param $label
     * @throws FieldLabelMustBeStringException
     * @throws FieldNameMustBeStringException
     */
    public function __construct(Request $request, $name, $label)
    {
        if(!is_string($name))
            throw new FieldNameMustBeStringException();

        if(!is_string($label))
            throw new FieldLabelMustBeStringException();

        $this->name       = $name;
        $this->label      = $label;
        $this->request    = $request;
        $this->sortable   = false;
        $this->filterable = false;
        $this->primary    = false;
        $this->visible    = true;
    }

    /**
     * @return int
     */
    public function isPrimary()
    {
        return $this->primary;
    }

    /**
     * @param int $primary
     */
    public function setPrimary()
    {
        $this->primary = true;
        return $this;
    }

    /**
     * $name Getter
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * $label Getter
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * $label Setter
     * @param $label
     * @return $this
     * @throws FieldLabelMustBeStringException
     */
    public function setLabel($label)
    {
        if(!is_string($label))
            throw new FieldLabelMustBeStringException();

        $this->label = $label;
        return $this;
    }

    /**
     * $sortable Getter
     * @return string
     */
    public function isSortable()
    {
        return $this->sortable;
    }

    /**
     * $sortable Setter
     * @return $this
     */
    public function setSortable($sortable = true)
    {
        if(!is_bool($sortable))
            throw new FieldSortableMustBeBooleanException();

        $this->sortable = $sortable;
        return $this;
    }

    /**
     * $filterable Getter
     * @return string
     */
    public function isFilterable()
    {
        return $this->filterable;
    }

    /**
     * $filterable Setter
     * @return $this
     */
    public function setFilterable($filterable = true)
    {
        if(!is_bool($filterable))
            throw new FieldFilterableMustBeBooleanException();

        $this->filterable = $filterable;
        return $this;
    }

    /**
     * @param $order
     * @return string
     */
    public function sortingUrl($order)
    {
        $inputName = 'sort'. ucfirst($this->getName());
        return $this->request->url() . '?' . http_build_query(array_merge($this->request->except($inputName), [$inputName => $order]));
    }

    /**
     * @param $visible
     * @return $this
     */
    public function setVisible($visible)
    {
        $this->visible = $visible;
        return $this;
    }

    /**
     * @return bool
     */
    public function isVisible()
    {
        return $this->visible;
    }
}