<div class="form-group">
    {!! Form::label($field, Lang::get('grids::grids.search.by', ['name' => $field->getLabel()])) !!}

    <div class="input-daterange input-group col-md-3" id="datepicker">
        {!! Form::text($field->getName().'Start', $request->input($field->getName().'Start'), ['class' => "datepicker form-control"]) !!}
        <span class="text-dark input-group-addon">@lang('grids::grids.to')</span>
        {!! Form::text($field->getName().'End', $request->input($field->getName().'End'), ['class' => "datepicker form-control"]) !!}
    </div>
    <div class="clearfix"></div>
</div>