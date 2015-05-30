<?php

namespace Sygmaa\Grids;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Sygmaa\Grids\Fields\Field;

/**
 * Class Grids
 * @package Sygmaa\Grids
 */
class Grids {

    /**
     * @var bool
     */
    protected $reset;

    /**
     * @var Request
     */
    protected $request;

    /**
     * @var int
     */
    protected $pagination;

    /**
     * @var FieldsCollection
     */
    protected $fieldsCollection;

    /**
     * @var
     */
    protected $rows;

    /**
     * @var ActionsCollection
     */
    protected $actionsCollection;

    /**
     * @var array
     */
    protected $conditions;

    /**
     * @var array
     */
    protected $inConditions;

    /**
     * @var array
     */
    protected $orders;

    /**
     * Constructor
     */
    public function __construct(Request $request, Model $model)
    {
        $this->fieldsCollection  = new FieldsCollection();
        $this->actionsCollection = new ActionsCollection();
        $this->request           = $request;
        $this->model             = $model;
        $this->reset             = false;
        $this->pagination        = 15;
        $this->conditions        = array();
        $this->inConditions      = array();
        $this->orders            = array();
    }

    /**
     * @param $name
     * @param string $label
     * @return $this
     */
    public function addField(Field $field)
    {
        $this->fieldsCollection->addFields($field);
        return $this;
    }

    /**
     * @param $field
     * @return $this
     */
    public function addAction(Action $action)
    {
        $this->actionsCollection->addAction($action);
        return $this;
    }

    /**
     * @param $nbEntries
     * @return $this
     */
    public function paginate($nbEntries)
    {
        $this->pagination = $nbEntries;
        return $this;
    }

    /**
     * @return $this
     */
    public function reset()
    {
        $this->reset = true;
        return $this;
    }

    /**
     * @return mixed
     */
    protected function rows()
    {
        if(!$this->rows) {
            $model = $this->model;

            foreach($this->fieldsCollection as $field) {

                if($field->isFilterable())
                    $model = $field->getFilters($model);


                if($field->isSortable()){

                    $inputName  = 'sort' . ucfirst($field->getName());
                    $inputValue = strtoupper($this->request->input($inputName));

                    if($inputValue && ($inputValue == "ASC" || $inputValue == "DESC"))
                        $model = $model->orderBy($field->getName(), $inputValue);
                }
            }

            foreach($this->conditions as $condition) {
                if(isset($condition['operator']))
                    $model = $model->where($condition['key'], $condition['operator'], $condition['value']);
                else
                    $model = $model->where($condition['key'], $condition['value']);
            }

            foreach($this->inConditions as $condition) {
                $model = $model->whereIn($condition['key'], $condition['array']);
            }

            foreach($this->orders as $order) {
                $model = $model->orderBy($order['key'], $order['value']);
            }

            $this->rows = $model->paginate($this->pagination)->setPath($this->request->url());
        }
        return $this->rows;
    }

    /**
     * @return $this
     */
    public function renderPaginationInfos()
    {
        return view('grids::paginationInfos')
            ->with('rows', $this->rows());
    }

    /**
     * @return $this
     */
    public function renderPagination()
    {
        $url = $this->request->url() . '?' . http_build_query($this->request->except('page'));

        return view('grids::pagination')
            ->with('url', $url)
            ->with('rows', $this->rows());
    }

    /**
     * @return $this
     */
    public function renderFilters()
    {
        return view('grids::filters')
            ->with('fields', $this->fieldsCollection)
            ->with('reset', $this->reset)
            ->with('request', $this->request)
            ->with('rows', $this->rows());
    }

    /**
     * @return $this
     */
    public function renderTable()
    {
        $massActions = $this->actionsCollection->getMassActions();

        $array = array();

        foreach($massActions as $action) {
            $array[$action->getUrl()] = $action->getLabel();
        }

        return view('grids::table')
            ->with('fields', $this->fieldsCollection)
            ->with('actions', $this->actionsCollection)
            ->with('massActions', $array)
            ->with('request', $this->request)
            ->with('rows', $this->rows());
    }

    /**
     * @param $key
     * @param $operator
     * @param null $value
     * @return $this
     */
    public function where($key, $operator, $value = null)
    {
        $condition = array(
            'key' => $key
        );

        if(isset($value)) {
            $condition['operator'] = $operator;
            $condition['value']    = $value;
        } else {
            $condition['value'] = $operator;
        }

        $this->conditions[] = $condition;
        return $this;
    }

    /**
     * @param $key
     * @param $array
     * @return $this
     */
    public function whereIn($key, $array)
    {
        $condition = array();
        $condition['key'] = $key;
        $condition['array'] = $array;
        $this->inConditions[] = $condition;
        return $this;
    }

    /**
     * @param $key
     * @param $value
     * @return $this
     */
    public function orderBy($key, $value)
    {
        $order = array();
        $order['key'] = $key;
        $order['value'] = $value;
        $this->orders[] = $order;
        return $this;
    }
}