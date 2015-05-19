<div class="form-group">
    {!! Form::label($field, Lang::get('grids::grids.search.by', ['name' => $field->getLabel()])) !!}

    <div class="input-daterange input-group col-md-3" id="datepicker">
        {!! Form::text($field->getName(), $request->input($field->getName()), ['class' => "datepicker form-control"]) !!}
    </div>
    <div class="clearfix"></div>
</div>