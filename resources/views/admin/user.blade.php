@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('_panel_title_block',['title' => (isset($data['user']) ? trans('admin.editing_user').' '.$data['user']->email : trans('admin.adding_user')),'h' => 5])
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ url('/admin/user') }}" method="post">
                {{ csrf_field() }}
                @if (isset($data['user']))
                    <input type="hidden" name="id" value="{{ $data['user']->id }}">
                @endif

                <div class="col-md-3 col-sm-3 col-xs-12">
                    @include('_image_block', [
                        'col' => 12,
                        'label' => trans('auth.avatar'),
                        'preview' => isset($data['user']) ? $data['user']->avatar : '',
                        'name' => 'avatar',
                        'placeholder' => asset('images/avatar.svg')
                    ])

                    @include('_image_block', [
                        'col' => 12,
                        'addClass' => 'doc-edit',
                        'label' => trans('auth.document'),
                        'preview' => $data['user']->document,
                        'name' => 'document',
                        'placeholder' => asset('images/doc.svg')
                    ])

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-flat">
                            <div class="panel-body">
                                @include('_radio_button_block', [
                                    'name' => 'type',
                                    'values' => [
                                        ['val' => 1, 'descript' => trans('auth.admin')],
                                        ['val' => 2, 'descript' => trans('auth.employee')],
                                        ['val' => 3, 'descript' => trans('auth.employer')]
                                    ],
                                    'activeValue' => isset($data['user']) ? $data['user']->type : 2
                                ])
                            </div>
                        </div>
                    </div>

                    @include('_checkbox_block',[
                        'label' => trans('auth.sending_mail'),
                        'name' => 'send_mail',
                        'checked' => isset($data['user']) ? $data['user']->send_mail : true
                    ])

                    @include('_checkbox_block',[
                        'label' => trans('content.active'),
                        'name' => 'active',
                        'checked' => isset($data['user']) ? $data['user']->active : true
                    ])

                    @include('_checkbox_block',[
                        'label' => trans('auth.confirmed_account'),
                        'name' => 'confirmed',
                        'checked' => isset($data['user']) ? $data['user']->confirmed : false
                    ])
                </div>

                <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="panel panel-flat">
                        @include('_panel_title_block',['title' => trans('auth.star_mark'),'h' => 3])
                        <div class="panel-body">
                            @include('_user_basic_fields_block')

                            @include('_input_block', [
                                'label' => trans('auth.rating'),
                                'name' => 'rating',
                                'type' => 'number',
                                'max' => 100,
                                'placeholder' => trans('auth.rating'),
                                'value' => isset($data['user']) ? ($data['user']->rating ? $data['user']->rating : 0) : 0
                            ])
                        </div>
                    </div>

                    <div class="panel panel-flat">
                        <div class="panel-body">
                            @include('_user_extended_fields_block')
                        </div>
                    </div>

                    <div class="panel panel-flat">
                        @if (isset($data['user']))
                            <div class="panel-heading">
                                <h4 class="text-grey-300">{!! trans('auth.keep_password') !!}</h4>
                            </div>
                        @endif
                        <div class="panel-body">
                            @include('_user_password_block')
                        </div>
                    </div>
                </div>

                @include('admin._save_button_block')
            </form>
        </div>
    </div>

    @if (isset($data['user']))
        @if ($data['user']->type == 2)
            @include('admin._resumes_table_block',['resumes' => $data['user']->myResumes])
            @include('admin._collection_table_block', [
                'postfix' => 'contracts',
                'collections' => $data['user']->contractsCollections,
                'item' => 'contract',
                'itemDirections' => 'contractDirections'
            ])
        @elseif ($data['user']->type == 1 || $data['user']->type == 3)
            @include('admin._contracts_table_block',['contracts' => $data['user']->contracts])
            @include('admin._collection_table_block', [
                'postfix' => 'resumes',
                'collections' => $data['user']->resumesCollections,
                'item' => 'myResume',
                'itemDirections' => 'resumeDirections'
            ])
        @endif
    @endif
@endsection