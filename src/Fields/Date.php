<?php

namespace Sygmaa\Grids\Fields;
use Illuminate\Http\Request;

/**
 * Class Date
 * @package Sygmaa\Grids\Fields
 */
class Date extends Field
{
    /**
     * @var
     */
    protected $formatting;

    public function __construct(Request $request, $name, $label, $formatting)
    {
        parent::__construct($request, $name, $label);
        $this->formatting = $formatting;
    }

    /**
     * @return mixed
     */
    public function getFormatting()
    {
        return $this->formatting;
    }

    /**
     * @param $data
     * @return mixed
     */
    function render($row)
    {
        $nameField = $this->getName();
        if(isset($row->$nameField)) {
            $datetime = new \DateTime($row->$nameField);
            return $datetime->format($this->formatting);
        }
        return "";
    }

    /**
     * @return $this
     */
    function renderFilter()
    {
        return view('grids::fields.date')
            ->with('request', $this->request)
            ->with('field', $this);
    }

    /**
     * @return mixed
     */
    function getFilters($model)
    {
        $start = $this->request->input($this->getName()."Start");
        $end   = $this->request->input($this->getName()."End");

        if($this->validateDate($start) && $this->validateDate($end)) {
            return $model
                ->where($this->getName(), '>=', new \DateTime($start))
                ->where($this->getName(), '<=', with(new \DateTime($end))->add(new \DateInterval('P1D')));
        }
        return $model;
    }

    /**
     * @param $date
     * @return bool
     */
    private function validateDate($date)
    {
        $d = \DateTime::createFromFormat('Y-m-d', $date);
        return $d && $d->format('Y-m-d') == $date;
    }
}