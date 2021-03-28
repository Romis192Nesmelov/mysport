@extends('layouts.main')

@section('content')
    <div class="section">
        <div class="container">
            @php ob_start(); @endphp
            @include('_cir_image_block', [
                'image' => Auth::user()->avatar,
                'name' => Helper::simpleCreds(Auth::user())
            ])

            @include('_left_gray_block',['content' => ob_get_clean(),'buttons' => false])

            @php ob_start(); @endphp
            @include('_header_block', [
                'tagName' => 'h1',
                'head' => trans('content.add_event')
            ])
            <form class="form-horizontal" action="{{ url('/event') }}" method="post">
                {{ csrf_field() }}

                @if (isset($data['item']))
                    <input type="hidden" name="id" value="{{ $data['item']->id }}">
                @endif

                <div class="col-md-12 col-sm-12 col-xs-12">
                    @include('_input_block',[
                        'label' => trans('content.event_name'),
                        'type' => 'text',
                        'max' => 255,
                        'name' => 'name_ru',
                        'value' => isset($data['item']) ? $data['item']->name_ru : ''
                    ])

                    @include('_textarea_block', [
                        'label' => trans('content.event_description'),
                        'name' => 'description_ru',
                        'value' => isset($data['item']) ? $data['item']->description_ru : '',
                        'simple' => true
                    ])
                </div>

                <div class="col-md-6 col-sm-6 col-xs-12">
                    <div class="description input-label">{{ trans('content.date') }}</div>
                    @include('_calendar_block',[
                        'year' => $data['year'],
                        'events' => $data['events_on_year'],
                        'inputName' => 'date',
                        'value' => isset($data['item']) ? date('d.m.Y',$data['item']->start_time) : date('d.m.Y',time() + (60 * 60 * 24 * 10))
                    ])
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    @include('_input_block',[
                        'label' => trans('content.start_time'),
                        'type' => 'text',
                        'name' => 'start_time',
                        'placeholder' => trans('content.time_placeholder'),
                        'value' => isset($data['item']) ? date('H.i',Helper::setMoscowTimeZone($data['item']->start_time)) : '09.00'
                    ])
                    @include('_input_block',[
                        'label' => trans('content.end_time'),
                        'type' => 'text',
                        'name' => 'end_time',
                        'placeholder' => trans('content.time_placeholder'),
                        'value' => isset($data['item']) ? date('H.i',Helper::setMoscowTimeZone($data['item']->end_time)) : '16.00'
                    ])
                    <div style="margin-top: 20px;">
                        @include('_checkbox_type1_block',[
                            'name' => 'active',
                            'label' => trans('content.event_active'),
                            'active' => isset($data['item']) ? $data['item']->active : 1
                        ])
                    </div>
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12 table">
                    @include('_input_block',[
                        'label' => trans('content.address'),
                        'type' => 'text',
                        'name' => 'address_ru',
                        'placeholder' => trans('content.address'),
                        'value' => isset($data['item']) ? $data['item']->address_ru : ''
                    ])
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    @include('_input_block',[
                        'label' => trans('content.latitude'),
                        'type' => 'text',
                        'name' => 'latitude',
                        'placeholder' => trans('content.coords_placeholder'),
                        'value' => isset($data['item']) ? $data['item']->latitude : ''
                    ])
                </div>
                <div class="col-md-6 col-sm-6 col-xs-12">
                    @include('_input_block',[
                        'label' => trans('content.longitude'),
                        'type' => 'text',
                        'name' => 'longitude',
                        'placeholder' => trans('content.coords_placeholder'),
                        'value' => isset($data['item']) ? $data['item']->longitude : ''
                    ])
                </div>
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="description input-label">{{ trans('content.select_the_area') }}</div>
                    @include('layouts._areas_select_block',[
                        'areaInputName' => 'area_id',
                        'type' => 2,
                        'useLabel' => false,
                        'selected' => isset($data['item']) ? $data['item']->area_id : null
                    ])

                    @php
                        $ageGroupItems = [];
                        for ($a=1;$a<=count(Helper::ageGroups());$a++) {
                            $ageGroupItems[] = ['value' => $a, 'name' => Helper::ageGroups()[$a-1]];
                        }
                    @endphp

                    @include('_radio_buttons_type3_block',[
                        'name' => 'age_group',
                        'label' => trans('content.age_group'),
                        'items' => $ageGroupItems,
                        'active' => isset($data['item']) ? $data['item']->age_group : 4
                    ])
                </div>

                @include('_submit_button_block')
            </form>

            @include('_right_gray_block',[
                'addClass' => 'narrow',
                'content' => ob_get_clean(),
                'useMap' => isset($data['item'])
            ])
        </div>
    </div>
    @if (isset($data['item']))
        @include('_map_script_block')
    @endif
@endsection