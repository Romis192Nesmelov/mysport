@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin._panel_title_block',['title' => (isset($data['item']) ? $data['item']['name_'.App::getLocale()] : trans('admin.adding_kind_of_sport')),'h' => 5])
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ url('/admin/kind_of_sport') }}" method="post">
                {{ csrf_field() }}
                @include('admin._hidden_id_block',['item' => isset($data['item']) ? $data['item'] : null])

                @include('admin._object_left_block',[
                    'item' => isset($data['item']) ? $data['item'] : null,
                    'imageName' => 'icon',
                    'objectName' => 'kind_of_sport'
                ])

                <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="panel panel-flat">
                        @include('admin._panel_title_block',['title' => trans('auth.star_mark'),'h' => 3])
                        <div class="panel-body">
                            @include('admin._name_and_description_block',['simple' => true])
                            @include('_textarea_block', [
                                'star' => true,
                                'label' => trans('content.sports_recommendations'),
                                'name' => 'recommendation_ru',
                                'max' => 500,
                                'simple' => true,
                                'value' => isset($data['item']) ? $data['item']->recommendation_ru : ''
                            ])
                            @include('_textarea_block', [
                                'star' => true,
                                'label' => trans('content.what_needed'),
                                'name' => 'needed_ru',
                                'max' => 500,
                                'simple' => true,
                                'value' => isset($data['item']) ? $data['item']->needed_ru : ''
                            ])
                        </div>
                    </div>
                </div>
                @include('admin._save_button_block')
            </form>
        </div>
    </div>
@endsection