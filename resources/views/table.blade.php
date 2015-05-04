{{-- Data table --}}

<form id="grids-form">

    @if($massActions = $actions->getMassActions())
        <script type="text/javascript">
            function check() {
                var f = document.getElementById('grids-form');
                var s = document.getElementById('grids-massActions');
                if( s.selectedIndex > 0 ) {
                    f.setAttribute("action", s.options[1].value) ;
                    f.setAttribute("method", "POST");
                } else {
                    f.setAttribute("method", "GET") ;
                    f.removeAttribute("action") ;
                }
            }

            function toggle(source) {
                checkboxes = document.getElementsByName('grids-ids[]');
                for(var i=0, n=checkboxes.length;i<n;i++) {
                    checkboxes[i].checked = source.checked;
                }
            }
        </script>
        <div class="col-md-12">
            <label for="grids-massActions">@lang('grids::grids.action') :</label>
            <select name="urlMassAction" class="form-control" id="grids-massActions" onchange="check()">
                <option>@lang('grids::grids.selectAction')</option>
                @foreach($massActions as $action)
                    <option value="{{ $action->getUrl() }}">{{ $action->getLabel() }}</option>
                @endforeach
            </select>
            <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
            <input class="btn btn-primary" onclick="return confirm('@lang("grids::grids.areYouSure")';" type="submit"/>
        </div>
    @endif

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                @if($actions)
                    @foreach($actions as $action)
                        @if($action->isMassAction())
                            <th>
                                <input type="checkbox" onClick="toggle(this)">
                            </th>
                        @endif
                    @endforeach
                @endif

                @foreach($fields as $field)
                    @if($field->isVisible())
                        <th>
                            {{ $field->getLabel() }}

                            @if($field->isSortable())
                                @if($request->input('sort'.ucfirst($field->getName())) == "desc")
                                    <a href="{{ $field->sortingUrl('asc') }}">
                                        <span class="glyphicon glyphicon-triangle-top"></span>
                                    </a>
                                @else
                                    <a href="{{ $field->sortingUrl('desc') }}">
                                        <span class="glyphicon glyphicon-triangle-bottom"></span>
                                    </a>
                                @endif
                            @endif
                        </th>
                    @endif
                @endforeach

                @if($actions->getSingleActions())
                    <th>@lang('grids::grids.action')</th>
                @endif
            </tr>
        </thead>
        <tbody>
        @foreach($rows as $row)
            <tr>
                @if($actions)
                    @foreach($actions as $action)
                        @if($action->isMassAction())
                            <td>
                                <?php $primary = $fields->getPrimary()->getName() ?>
                                <input type="checkbox" name="grids-ids[]" value="{{ $row->$primary }}">
                            </td>
                        @endif
                    @endforeach
                @endif

                @foreach($fields as $field)
                    @if($field->isVisible())
                        <td>
                            @if(isset($row->$field))
                                {{ $row->$field }}
                            @endif
                        </td>
                    @endif
                @endforeach

                @foreach($actions as $action)
                    @if(!$action->isMassAction())
                        <td>
                            {!! $action->getCallback($action->getLabel(), $row) !!}
                        </td>
                    @endif
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
</form>