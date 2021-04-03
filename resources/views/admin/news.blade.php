@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin._panel_title_block',['title' => (isset($data['news']) ? $data['news']['head_'.App::getLocale()] : trans('admin.adding_news')),'h' => 5])
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ url('/admin/news') }}" method="post">
                {{ csrf_field() }}
                @include('admin._hidden_id_block',['item' => isset($data['news']) ? $data['news'] : null])

                @include('admin._object_left_block',[
                    'item' => isset($data['news']) ? $data['news'] : null,
                    'objectName' => 'news',
                    'col' => 4
                ])

                <div class="col-md-8 col-sm-8 col-xs-12">
                    <div class="panel panel-flat">
                        @include('admin._panel_title_block',['title' => trans('auth.star_mark'),'h' => 3])
                        <div class="panel-body">
                            @include('_input_block', [
                                'star' => true,
                                'label' => trans('content.head'),
                                'name' => 'head_ru',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => trans('content.head'),
                                'value' => isset($data['news']) ? $data['news']->head_ru : ''
                            ])

                            @include('_textarea_block', [
                                'star' => true,
                                'label' => trans('admin.content'),
                                'name' => 'content_ru',
                                'max' => 500,
                                'simple' => true,
                                'value' => isset($data['news']) ? $data['news']->content_ru : ''
                            ])
                        </div>
                    </div>
                </div>
                @include('admin._save_button_block')
            </form>
        </div>
    </div>
@endsection