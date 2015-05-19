<div class="form-group">
    {!! Form::label($field, Lang::get('grids::grids.search.by', ['name' => $field->getLabel()]) ." : ") !!}
    {!! Form::text($field, $request->input($field->getName()), [
        'class' => "form-control",
        'placeholder' => Lang::get('grids::grids.search.by', ['name' => $field->getLabel()])."..."
    ]) !!}
</div>
<div class="clearfix"></div>