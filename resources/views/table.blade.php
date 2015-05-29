{{-- Data table --}}

{!! Form::open(['id' => 'grids-form']) !!}

    @if($massActions )
        <div class="col-md-12">
            <div style="margin-top:10px" class="pull-right">
                {!! Form::label('grids-massActions', Lang::get('grids::grids.actions') . " : ") !!}
                {!! Form::select('urlMassAction', [null =>  Lang::get("grids::grids.select")] + $massActions, null, [
                    'class'    => "form-control",
                    'id'       => "grids-massActions",
                    'onchange' => "check()"
                ]) !!}
                {!! Form::hidden('_token', csrf_token()) !!}
                {!! Form::submit(Lang::get("grids::grids.ok"), [
                    'class'   => "btn btn-primary",
                    'onclick' => "return confirm('" . Lang::get("grids::grids.areYouSure") . "');"
                ]) !!}
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
                            <?php $primary = $fields->getPrimary()->getName() ?>
                            <td class="text-center">{!! Form::checkbox('grids-ids[]', $row->$primary) !!}</td>
                        @endif
                    @endforeach
                @endif

                @foreach($fields as $field)
                    @if($field->isVisible())
                        <td>{!! $field->render($row) !!}</td>
                    @endif
                @endforeach

                @if($singlesAction)
                    <td>
                        @foreach($singlesAction as $action)
                            {!! $action->getCallback($action->getLabel(), $row) !!}
                        @endforeach
                    </td>
                @endif

            </tr>
        @endforeach
        </tbody>
    </table>
{!! Form::close() !!}