@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin._panel_title_block',['title' => (isset($data['item']) ? $data['item']['name_'.App::getLocale()] : trans('admin.adding_place')),'h' => 5])
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ url('/admin/place') }}" method="post">
                {{ csrf_field() }}
                @include('admin._hidden_id_block',['item' => isset($data['item']) ? $data['item'] : null])

                @include('admin._object_left_block',[
                    'item' => isset($data['item']) ? $data['item'] : null,
                    'objectName' => 'place'
                ])

                <div class="col-md-9 col-sm-9 col-xs-12">
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

                            @include('admin._name_and_description_block')
                            @include('admin._address_fields_block')
                        </div>
                    </div>
                    @include('admin._kind_of_spors_links_table_block',['sports' => $data['collections']['kind_of_sports']])
                </div>
                @include('admin._save_button_block')
            </form>
        </div>
    </div>
    @if (isset($data['item']))
        @include('admin._gallery_block',['model' => $data['item']])
    @endif
@endsection