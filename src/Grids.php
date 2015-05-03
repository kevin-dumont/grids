<?php

namespace Sygmaa\Grids;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

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

                if($field->isFilterable()){

                    if($input = $this->request->input($field->getName()))
                        $model = $model->orWhere($field->getName(), 'LIKE', "%$input%");
                }

                if($field->isSortable()){

                    $inputName  = 'sort' . ucfirst($field->getName());
                    $inputValue = strtoupper($this->request->input($inputName));

                    if($inputValue && ($inputValue == "ASC" || $inputValue == "DESC"))
                        $model = $model->orderBy($field->getName(), $inputValue);
                }
            }
            $this->rows = $model->paginate($this->pagination, $this->fieldsCollection->getAll())->setPath($this->request->url());
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
        return view('grids::table')
            ->with('fields', $this->fieldsCollection)
            ->with('actions', $this->actionsCollection)
            ->with('request', $this->request)
            ->with('rows', $this->rows());
    }
}