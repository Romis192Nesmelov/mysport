@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin._panel_title_block',['title' => (isset($data['kid']) ? Helper::userCreds($data['kid']) : trans('admin.adding_kid')),'h' => 5])
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ url('/admin/kid') }}" method="post">
                {{ csrf_field() }}
                @include('admin._hidden_id_block',['item' => isset($data['kid']) ? $data['kid'] : null])
                <div class="col-md-3 col-sm-3 col-xs-12">
                    @include('_image_block', [
                        'label' => trans('content.avatar'),
                        'preview' => isset($data['kid']) ? $data['kid']->avatar : '',
                        'name' => 'avatar',
                        'placeholder' => asset('images/placeholder.jpg')
                    ])

                    @include('admin._choice_gender_block',['user' => isset($data['kid']) ? $data['kid'] : null])

                    @include('admin._date_block', [
                        'label' => trans('content.born_date'),
                        'name' => 'born',
                        'value' => isset($data['kid']) ? $data['kid']->born : time() - (60 * 60 * 24 * 365 * 5)
                    ])

                    @include('_checkbox_block',[
                        'label' => trans('content.active'),
                        'name' => 'active',
                        'checked' => isset($data['kid']) ? $data['kid']->active : true
                    ])
                </div>

                <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="panel panel-flat">
                        @include('admin._panel_title_block',['title' => trans('auth.star_mark'),'h' => 3])
                        <div class="panel-body">
                            @include('admin._select_user_block',[
                                'label' => trans('admin.parent'),
                                'users' => $data['collection'],
                                'selected' => Request::has('user_id') ? Request::input('user_id') : null
                            ])

                            @include('_input_block', [
                                'star' => true,
                                'label' => trans('content.user_name'),
                                'name' => 'name',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => trans('content.user_name'),
                                'value' => isset($data['kid']) ? $data['kid']->name : ''
                            ])

                            @include('_input_block', [
                                'star' => true,
                                'label' => trans('content.surname'),
                                'name' => 'surname',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => trans('content.surname'),
                                'value' => isset($data['kid']) ? $data['kid']->surname : ''
                            ])

                            @include('_input_block', [
                                'star' => true,
                                'label' => trans('content.family'),
                                'name' => 'family',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => trans('content.family'),
                                'value' => isset($data['kid']) ? $data['kid']->family : ''
                            ])
                        </div>
                    </div>
                </div>
                @include('admin._save_button_block')
            </form>
        </div>
    </div>
@endsection