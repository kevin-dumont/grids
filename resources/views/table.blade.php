{{-- Data table --}}

<form id="grids-form">

    @if($massActions = $actions->getMassActions())
        <div class="col-md-12">
            <div style="margin-top:10px" class="pull-right">
                <label for="grids-massActions">@lang('grids::grids.actions') :</label>
                <select name="urlMassAction" class="form-control" id="grids-massActions" onchange="check()">
                    <option>@lang('grids::grids.selectAction')</option>
                    @foreach($massActions as $action)
                        <option value="{{ $action->getUrl() }}">{{ $action->getLabel() }}</option>
                    @endforeach
                </select>
                <input type="hidden" name="_token" value="{{ csrf_token() }}"/>
                <input class="btn btn-primary" onclick="return confirm('@lang("grids::grids.areYouSure")');" type="submit"/>
            </div>
        </div>
        <div class="clearfix"></div>
        <hr style="margin:10px 0 0 0;padding:0;"/>
    @endif

    <table class="table table-striped table-hover">
        <thead>
            <tr>
                @if($actions)
                    @foreach($actions as $action)
                        @if($action->isMassAction())
                            <th class="text-center" style="width:50px;">
                                <input id="checkAll" type="checkbox" onClick="toggle(this)">
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

                @if($singlesAction = $actions->getSingleActions())
                    <th style="width: 250px">@lang('grids::grids.actions')</th>
                @endif
            </tr>
        </thead>
        <tbody>
        @foreach($rows as $row)
            <tr>
                @if($actions)
                    @foreach($actions as $action)
                        @if($action->isMassAction())
                            <td class="text-center">
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
                                {{ $field->render($row->$field) }}
                            @endif
                        </td>
                    @endif
                @endforeach

                @foreach($singlesAction as $action)
                    <td>
                        {!! $action->getCallback($action->getLabel(), $row) !!}
                    </td>
                @endforeach
            </tr>
        @endforeach
        </tbody>
    </table>
</form>