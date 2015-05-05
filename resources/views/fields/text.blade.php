<div class="form-group">
    <label for="{{ $field }}">@lang('grids::grids.search.by', ['name' => $field->getLabel()]) :</label>

    <input
        name="{{ $field }}"
        value="{{ $request->input($field->getName()) }}"
        type="text"
        class="form-control "
        placeholder="@lang('grids::grids.search.by', ['name' => $field->getLabel()])..."
        />
</div>

<div class="clearfix"></div>