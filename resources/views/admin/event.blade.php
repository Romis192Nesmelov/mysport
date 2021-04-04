@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin._panel_title_block',['title' => (isset($data['item']) ? $data['item']['name_'.App::getLocale()] : trans('admin.adding_event')),'h' => 5])
        <div class="panel-body">
            <form class="form-horizontal" action="{{ url('/admin/event') }}" method="post">
                {{ csrf_field() }}
                @include('admin._hidden_id_block',['item' => isset($data['item']) ? $data['item'] : null])
                <div class="col-md-2 col-sm-3 col-xs-12">
                    <div class="panel panel-flat">
                        @include('admin._panel_title_block',['title' => trans('content.age_group'),'h' => 6])
                        <div class="panel-body">
                            @php
                                $values = [];
                                foreach (Helper::ageGroups() as $k => $group) {
                                    $values[] = ['val' => $k+1, 'descript' => $group];
                                }
                            @endphp
                            @include('_radio_button_block', [
                                'name' => 'age_group',
                                'values' => $values,
                                'activeValue' => isset($data['item']) ? $data['item']->age_group : 2
                            ])

                            @include('_checkbox_block',[
                                'label' => trans('content.event_active'),
                                'name' => 'active',
                                'checked' => isset($data['item']) ? $data['item']->active : true
                            ])
                        </div>
                    </div>
                </div>
                <div class="col-md-10 col-sm-9 col-xs-12">
                    <div class="panel panel-flat">
                        @include('admin._panel_title_block',['title' => trans('auth.star_mark'),'h' => 3])
                        <div class="panel-body">
                            @include('_select_block',[
                                'label' => trans('content.select_the_area'),
                                'name' => 'area_id',
                                'optionName' => 'name_'.App::getLocale(),
                                'values' => $data['collections']['areas'],
                                'selected' => isset($data['item']) ? $data['item']->area_id : null
                            ])

                            <div class="description input-label">{{ trans('content.organizer') }}</div>
                            <div class="form-group has-feedback">
                                <select name="user_id" class="form-control">
                                    @foreach ($data['collections']['users'] as $user)
                                        @if (Gate::forUser($user)->allows('trainer') || Gate::forUser($user)->allows('organizer'))
                                            <option value="{{ $user->id }}" {{ (!count($errors) ? $user->id == (isset($data['item']) ? $data['item']->user_id : null) : $user->id == old('user_id')) ? 'selected' : '' }}>{{ Helper::simpleCreds($user, true) }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>

                            @include('admin._name_and_description_block', ['simple' => true])
                            @include('admin._address_fields_block')

                            <div class="col-md-4 col-sm-4 col-xs-12">
                                @include('admin._date_block', [
                                    'label' => trans('content.date'),
                                    'name' => 'date',
                                    'value' => isset($data['item']) ? $data['item']->start_time : date('d.m.Y',time() + (60 * 60 * 24 * 10))
                                ])
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                @include('_input_block',[
                                    'label' => trans('content.start_time'),
                                    'type' => 'text',
                                    'name' => 'start_time',
                                    'placeholder' => trans('content.time_placeholder'),
                                    'value' => isset($data['item']) ? date('H.i',Helper::setMoscowTimeZone($data['item']->start_time)) : '09.00'
                                ])
                            </div>
                            <div class="col-md-4 col-sm-4 col-xs-12">
                                @include('_input_block',[
                                    'label' => trans('content.end_time'),
                                    'type' => 'text',
                                    'name' => 'end_time',
                                    'placeholder' => trans('content.time_placeholder'),
                                    'value' => isset($data['item']) ? date('H.i',Helper::setMoscowTimeZone($data['item']->end_time)) : '16.00'
                                ])
                            </div>
                        </div>
                    </div>
                    @include('admin._kind_of_spors_links_table_block',['sports' => $data['collections']['kind_of_sports']])
                </div>
                @include('admin._save_button_block')
            </form>
        </div>
    </div>

    @if (isset($data['item']))
        @include('admin._users_records_table_block',['objectName' => 'user','recordName' => 'event'])
        @include('admin._users_records_table_block',['objectName' => 'kid','recordName' => 'event'])
    @endif

@endsection