<div class="form-group">
    {!! Form::label($field->getNameForUrl(), Lang::get('grids::grids.search.by', ['name' => $field->getLabel()])) !!}
    {!! Form::select($field->getNameForUrl(), [null =>  Lang::get("grids::grids.select")] + $model, $input, ['class' => "form-control"]) !!}
</div>
<div class="clearfix"></div>