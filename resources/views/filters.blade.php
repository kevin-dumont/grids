{{-- Filter form --}}
<form action="{{ $request->url() }}" method="GET">
    @foreach($fields as $field)
        @if($field->isFilterable())
            {!! $field->renderFilter() !!}
            <?php $filterable = true; ?>
        @endif
    @endforeach

    @if(isset($filterable))
        <div class="btn-group">
            {!! Form::submit(Lang::get('grids::grids.apply'), ['class' => "btn btn-primary",]) !!}
            @if($reset)
                <a class="btn btn-default" href="{{ $request->url() }}">@lang('grids::grids.reset')</a>
            @endif
        </div>
    @endif
</form>