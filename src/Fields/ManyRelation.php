<?php

namespace Sygmaa\Grids\Fields;
use Illuminate\Http\Request;
use Sygmaa\Grids\Exceptions\SortableIsDisableOnRelationsException;

/**
 * Class ManyRelation
 * @package Sygmaa\Grids\Fields
 */
class ManyRelation extends Field
{

    /**
     * @var string
     */
    protected $relation;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var
     */
    private $modelName;

    /**
     * @param Request $request
     * @param $name
     * @param $label
     * @param $className
     * @throws \Sygmaa\Grids\Exceptions\FieldLabelMustBeStringException
     * @throws \Sygmaa\Grids\Exceptions\FieldNameMustBeStringException
     */
    public function __construct(Request $request, $name, $label, $modelName)
    {
        parent::__construct($request, $name, $label);

        $explode = explode('.', $name);
        $this->relation  = $explode[0];
        $this->name      = $explode[1];
        $this->modelName = $modelName;
    }

    /**
     * @param bool $sortable
     */
    public function setSortable($sortable = true)
    {
        throw new SortableIsDisableOnRelationsException();
    }

    /**
     * @return $this
     */
    function render($row)
    {
        $relation = $this->relation;
        $name     = $this->name;
        $return   = '';
        $count    = 0;
        $size     = count($row->$relation);

        foreach($row->$relation as $entity){
            $return .= $entity->$name;
            if($count < $size - 1)
                $return .= ', ';
            $count++;
        }

        return $return;
    }

    /**
     * @return string
     */
    public function getNameForUrl()
    {
        return $this->relation . ucfirst($this->name);
    }

    /**
     * @return $this
     */
    function renderFilter()
    {
        $model = new $this->modelName();

        return view('grids::fields.manyRelation')
            ->with('input', $this->request->input($this->getNameForUrl()))
            ->with('field', $this)
            ->with('model', $model->lists($this->name, $model->getKeyName()));
    }

    /**
     * @param $model
     * @param $input
     * @return mixed
     */
    function getFilters($model)
    {
        $relation   = $this->relation;
        $input      = $this->request->input($this->getNameForUrl());
        $primaryKey = $model->getModel()->$relation()->getRelated()->getKeyName();

        if($input) {
            $model = $model->whereHas($relation, function($q) use ($input, $primaryKey) {
                $q->where($primaryKey, '=', $input);
            });
        }
        return $model;
    }
}