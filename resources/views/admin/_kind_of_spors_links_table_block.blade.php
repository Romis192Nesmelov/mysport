<div class="panel panel-flat">
    @include('admin._panel_title_block',['title' => trans('admin.kind_of_sports')])
    <div class="panel-body {{ $errors && $errors->has('kind_of_sports') ? 'has-error' : '' }}">
        <table class="table datatable-basic table-items">
            <tr>
                <th class="text-center"></th>
                <th class="text-center">{{ trans('content.image') }}</th>
                <th class="text-center">{{ trans('content.name') }}</th>
                <th class="text-center">{{ trans('content.description') }}</th>
                <th class="text-center">{{ trans('auth.status') }}</th>
                <th class="text-center">{{ trans('admin.edit') }}</th>
            </tr>
            @foreach ($sports as $sport)
                <tr class="data" role="row">
                    <td class="text-center">
                        @php
                            $selectFlag = false;
                            if (isset($data['item'])) {
                                foreach ($data['item']->sports as $eventSport) {
                                    if ($eventSport->kind_of_sport_id == $sport->id) {
                                        $selectFlag = true;
                                        break;
                                    }
                                }
                            }
                        @endphp
                        @include('_checkbox_block',[
                            'name' => 'sport'.$sport->id,
                            'checked' => $selectFlag
                        ])
                    </td>
                    @include('admin._image_on_table_block',['image' => $sport->icon])
                    <td class="text-left name">{{ $sport['name_'.App::getLocale()] }}</td>
                    <td class="text-left">{{ Helper::croppedContent($sport['description_'.App::getLocale()], 150) }}</td>
                    <td class="text-center">
                        @include('admin._status_simple_block',[
                            'status' => $sport->active,
                            'trueLabel' => trans('admin.kind_of_sport_active'),
                            'falseLabel' => trans('admin.kind_of_sport_not_active')
                        ])
                    </td>
                    @include('admin._edit_on_table_block',['method' => 'kind_of_sports', 'id' => $sport->id])
                </tr>
            @endforeach
        </table>
        @include('_input_error_block',['name' => 'kind_of_sports'])
    </div>
</div>