{{-- Filter form --}}
<form action="{{ $request->url() }}" method="GET">
    @foreach($fields as $field)
        @if($field->isFilterable())
            <div class="form-group">
                <label for="{{ $field }}">@lang('grids::grids.search.by', ['name' => $field->getLabel()]) :</label>
                <input
                    name="{{ $field }}"
                    value="{{ $request->input($field->getName()) }}"
                    type="text"
                    class="form-control"
                    placeholder="@lang('grids::grids.search.by', ['name' => $field->getLabel()])..."
                    />
            </div>
            <?php $filterable = true; ?>
        @endif
    @endforeach

    @if(isset($filterable))
        <div class="btn-group">
            <input type="submit" class="btn btn-primary" value="@lang('grids::grids.apply')"/>

            @if($reset)
                <a class="btn btn-default" href="{{ $request->url() }}">@lang('grids::grids.reset')</a>
            @endif
        </div>
    @endif
</form>