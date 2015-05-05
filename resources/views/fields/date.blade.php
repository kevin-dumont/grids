<div class="form-group">
    <label for="{{ $field }}">@lang('grids::grids.search.by', ['name' => $field->getLabel()]) :</label>

    <div class="input-daterange input-group col-md-3" id="datepicker">
        <input
            name="{{ $field }}Start"
            value="{{ $request->input($field->getName()."Start") }}"
            type="text"
            class="datepicker form-control"
            />
        <span class="text-dark input-group-addon">@lang('grids::grids.to')</span>
        <input
                name="{{ $field }}End"
                value="{{ $request->input($field->getName()."End") }}"
                type="text"
                class="datepicker form-control"
                />
    </div>
    <div class="clearfix"></div>
</div>