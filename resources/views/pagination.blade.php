<ul class="pagination">
    @if($rows->currentPage() > 1)

        <li>
            <a href="{{ $url . '&page=1' }}">
                @lang('grids::grids.first')
            </a>
        </li>

        @if($rows->currentPage()-1 >= 1)
            <li>
                <a href="{{ $url . '&page=' . ($rows->currentPage()-1) }}">
                    @lang('grids::grids.previous')
                </a>
            </li>
        @endif
    @endif

    @if($rows->currentPage() >= 1 && $rows->currentPage() <= 5 && $rows->lastPage() >= 10)

        @for($i= 1; $i <= 10; $i++)
            <li @if($i == $rows->currentPage()) class="active" @endif>
                <a href="{{ $url . '&page=' . $i }}">
                    {{ $i }}
                </a>
            </li>
        @endfor

    @elseif($rows->currentPage() <= $rows->lastPage() && $rows->currentPage() >= $rows->lastPage() - 5 && $rows->lastPage() >= 10)

        @for($i = $rows->lastPage() - 10; $i <= $rows->lastPage() ; $i++)
            <li @if($i == $rows->currentPage())class="active"@endif>
                <a href="{{ $url . '&page=' . $i }}">
                    {{ $i }}
                </a>
            </li>
        @endfor

    @elseif($rows->currentPage() > $rows->lastPage() && $rows->currentPage() < $rows->lastPage() - 5 && $rows->lastPage() >= 10)

        @for($i = ($rows->currentPage() - 5);  $i < ($rows->currentPage() + 5); $i++)
            <li @if($i == $rows->currentPage())class="active"@endif>
                <a href="{{ $url . '&page=' . $i }}">
                    {{ $i }}
                </a>
            </li>
        @endfor
    @else
        @for($i = 1;  $i <= $rows->lastPage(); $i++)
            <li @if($i == $rows->currentPage()) class="active" @endif>
                <a href="{{ $url . '&page=' . $i }}">
                    {{ $i }}
                </a>
            </li>
        @endfor
    @endif

    @if($rows->currentPage() < $rows->lastPage())

        @if($rows->currentPage() + 1 <= $rows->lastPage())
            <li>
                <a href="{{ $url . '&page=' . ($rows->currentPage()+1) }}">
                    @lang('grids::grids.next')
                </a>
            </li>
        @endif

        <li>
            <a href="{{ $url . '&page=' . $rows->lastPage() }}">
                @lang('grids::grids.last')
            </a>
        </li>
    @endif
</ul>