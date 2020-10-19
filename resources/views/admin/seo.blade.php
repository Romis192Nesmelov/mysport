@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ url('/admin/seo') }}" method="post">
                {{ csrf_field() }}
                <div class="panel-body">
                    @include('_input_block', [
                        'label' => 'Title (Eng)',
                        'name' => 'title_en',
                        'type' => 'text',
                        'placeholder' => 'Title',
                        'value' => $data['seo']['title_en']
                    ])
                    @include('_input_block', [
                        'label' => 'Title (Рус)',
                        'name' => 'title_ru',
                        'type' => 'text',
                        'placeholder' => 'Title',
                        'value' => $data['seo']['title_ru']
                    ])
                </div>
                @include('_panel_title_block',['title' => trans('admin.meta_tags'),'h' => 4])
                <div class="panel-body">
                    @foreach($data['metas'] as $meta => $params)
                        @if ($params['name'] == 'description' || $params['name'] == 'keywords' || $params['property'] == 'og:description')
                            @include('_textarea_block', [
                                'label' => $params['name'] ? 'name="'.$params['name'].'"' : 'property="'.$params['property'].'"',
                                'name' => $meta,
                                'value' => $data['seo'][$meta],
                                'simple' => true
                            ])
                        @else
                            @include('_input_block', [
                                'label' => $params['name'] ? 'name="'.$params['name'].'"' : 'property="'.$params['property'].'"',
                                'name' => $meta,
                                'type' => 'text',
                                'placeholder' => $params['name'] ? 'name="'.$params['name'].'"' : 'property="'.$params['property'].'"',
                                'value' => $data['seo'][$meta]
                            ])
                        @endif
                    @endforeach
                </div>
                @include('admin._save_button_block')
            </form>
        </div>
    </div>
@endsection