@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin._panel_title_block',['title' => (isset($data['news']) ? $data['news']['head_'.App::getLocale()] : trans('admin.adding_news')),'h' => 5])
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ url('/admin/news') }}" method="post">
                {{ csrf_field() }}
                @include('admin._hidden_id_block',['item' => isset($data['news']) ? $data['news'] : null])

                <div class="col-md-{{ isset($col) ? $col : '3' }} col-sm-{{ isset($col) ? $col : '3' }} col-xs-12">
                    @include('_image_block', [
                        'label' => trans('content.image'),
                        'preview' => isset($data['news']) ? $data['news']->image : '',
                        'name' => 'image',
                        'placeholder' => asset('images/placeholder.jpg')
                    ])

                    @include('admin._date_block', [
                        'label' => trans('content.date'),
                        'name' => 'date',
                        'value' => isset($data['news']) ? $data['news']->date : date('d.m.Y')
                    ])

                    @include('_checkbox_block',[
                        'col' => 12,
                        'label' => trans('admin.news_active'),
                        'name' => 'active',
                        'checked' => isset($data['news']) ? $data['news']->active : true
                    ])
                </div>

                <div class="col-md-9 col-sm-9 col-xs-12 current-news">
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
                                'max' => 5000,
                                'simple' => false,
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