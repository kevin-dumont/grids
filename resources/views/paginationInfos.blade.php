{{ $rows->count() }} {{ Lang::choice('grids::grids.results', $rows->count()) }}
({{ $rows->total() }} @lang('grids::grids.total')),
@lang('grids::grids.page') {{ $rows->currentPage() }} @lang('grids::grids.of') {{ $rows->lastPage() == 0 ? 1 : $rows->lastPage() }}