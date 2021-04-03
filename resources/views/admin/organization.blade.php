@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin._panel_title_block',['title' => (isset($data['item']) ? $data['item']['name_'.App::getLocale()] : trans('admin.adding_organization')),'h' => 5])
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ url('/admin/organization') }}" method="post">
                {{ csrf_field() }}
                @include('admin._hidden_id_block',['item' => isset($data['item']) ? $data['item'] : null])

                @include('admin._object_left_block',[
                    'item' => isset($data['item']) ? $data['item'] : null,
                    'objectName' => 'organization'
                ])

                <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="panel panel-flat">
                        @include('admin._panel_title_block',['title' => trans('auth.star_mark'),'h' => 3])
                        <div class="panel-body">
                            @include('_select_block',[
                                'label' => trans('content.select_the_area'),
                                'name' => 'area_id',
                                'optionName' => 'name_'.App::getLocale(),
                                'values' => $data['collection'],
                                'selected' => isset($data['item']) ? $data['item']->area_id : null
                            ])
                            @include('admin._name_and_description_block')
                            @include('_input_block', [
                                'star' => true,
                                'label' => trans('content.leader'),
                                'name' => 'leader_ru',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => trans('content.leader'),
                                'value' => isset($data['item']) ? $data['item']->leader_ru : ''
                            ])
                            @include('admin._address_fields_block')
                            @include('admin._phone_and_email_block')
                            @include('_input_block', [
                                'label' => trans('content.site'),
                                'name' => 'site',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => trans('content.site'),
                                'value' => isset($data['item']) ? $data['item']->site : ''
                            ])
                            @include('_input_block', [
                                'label' => trans('content.timetable'),
                                'name' => 'schedule_ru',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => trans('content.timetable'),
                                'value' => isset($data['item']) ? $data['item']->schedule_ru : ''
                            ])
                        </div>
                    </div>
                </div>
                @include('admin._save_button_block')
            </form>
        </div>
    </div>
    @if (isset($data['item']))
        @include('admin._gallery_block',['model' => $data['item']])
        @include('admin._objects_table',['objects' => $data['item']->sections, 'objectName' => 'section'])
    @endif
@endsection