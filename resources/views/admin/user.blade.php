@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin._panel_title_block',['title' => (isset($data['user']) ? Helper::userCreds($data['user']) : trans('admin.adding_user')),'h' => 5])
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ url('/admin/user') }}" method="post">
                {{ csrf_field() }}
                @include('admin._hidden_id_block',['item' => isset($data['user']) ? $data['user'] : null])
                <div class="col-md-3 col-sm-3 col-xs-12 left-block">
                    @include('_image_block', [
                        'label' => trans('content.avatar'),
                        'preview' => isset($data['user']) ? $data['user']->avatar : '',
                        'name' => 'avatar',
                        'placeholder' => asset('images/placeholder.jpg')
                    ])

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-flat">
                            @include('admin._panel_title_block',['title' => trans('admin.user_type'),'h' => 5])
                            <div class="panel-body">
                                @php
                                    if (Gate::allows('admin')) {
                                        $userTypesValues = [
                                            ['val' => 1, 'descript' => trans('admin.admin')],
                                            ['val' => 2, 'descript' => trans('admin.half_admin')]
                                        ];
                                    } else {
                                        $userTypesValues = [
                                            ['val' => 2, 'descript' => trans('admin.admin')]
                                        ];
                                    }
                                    $userTypesValues[] = ['val' => 3, 'descript' => trans('admin.organizer')];
                                    $userTypesValues[] = ['val' => 4, 'descript' => trans('admin.user')];
                                @endphp

                                @include('_radio_button_block', [
                                    'name' => 'type',
                                    'values' => $userTypesValues,
                                    'activeValue' => isset($data['user']) ? $data['user']->type : 3
                                ])
                            </div>
                        </div>
                    </div>

                    @include('admin._choice_gender_block',['user' => isset($data['user']) ? $data['user'] : null])

                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="panel panel-flat">
                            <div class="panel-body">
                                @include('admin._date_block', [
                                    'label' => trans('content.born_date'),
                                    'name' => 'born',
                                    'value' => isset($data['user']) ? $data['user']->born : time() - (60 * 60 * 24 * 365 * 18)
                                ])

                                @include('_checkbox_block',[
                                    'label' => trans('admin.trainer'),
                                    'name' => 'is_trainer',
                                    'checked' => isset($data['user']) ? $data['user']->trainer : false
                                ])

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
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-9 col-sm-9 col-xs-12">
                    <div class="panel panel-flat">
                        @include('admin._panel_title_block',['title' => trans('auth.star_mark'),'h' => 3])
                        <div class="panel-body">
                            @include('_input_block', [
                                'star' => true,
                                'label' => trans('content.user_name'),
                                'name' => 'name',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => trans('content.user_name'),
                                'value' => isset($data['user']) ? $data['user']->name : ''
                            ])

                            @include('_input_block', [
                                'star' => true,
                                'label' => trans('content.surname'),
                                'name' => 'surname',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => trans('content.surname'),
                                'value' => isset($data['user']) ? $data['user']->surname : ''
                            ])

                            @include('_input_block', [
                                'star' => true,
                                'label' => trans('content.family'),
                                'name' => 'family',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => trans('content.family'),
                                'value' => isset($data['user']) ? $data['user']->family : ''
                            ])

                            @include('_input_block', [
                                'star' => true,
                                 'label' => trans('content.phone'),
                                 'name' => 'phone',
                                 'type' => 'tel',
                                 'placeholder' => trans('content.phone'),
                                 'value' => isset($data['user']) ? $data['user']->phone : '',
                             ])

                            @include('_input_block', [
                                'star' => true,
                                'label' => 'E-mail:',
                                'name' => 'email',
                                'type' => 'email',
                                'max' => 100,
                                'placeholder' => 'E-mail:',
                                'value' => isset($data['user']) ? $data['user']->email : '',
                            ])
                        </div>
                    </div>

                    <div class="panel panel-flat">
                        @if (isset($data['user']))
                            <div class="panel-heading">
                                <h4 class="text-grey-300">{!! trans('auth.keep_password') !!}</h4>
                            </div>
                        @endif
                        <div class="panel-body">
                            @include('_input_block',[
                                'name' => 'password',
                                'type' => 'password',
                                'placeholder' => trans('auth.password')
                            ])
                            @include('_input_block',[
                                'name' => 'password_confirmation',
                                'type' => 'password',
                                'placeholder' => trans('auth.password_confirm')
                            ])
                        </div>
                    </div>
                </div>

                <div id="trainer-fields" class="col-md-9 col-sm-9 col-xs-12" {{ (!isset($data['user']) || !$data['user']->trainer) && old('is_trainer') != 'on' ? 'style=display:none;' : '' }} >
                    <div class="panel panel-flat">
                        <div class="panel-heading">
                            <h4 class="text-grey-300">{!! trans('admin.trainer') !!}</h4>
                        </div>
                        <div class="panel-body">
                            <div class="panel panel-flat">
                                <div class="panel-heading">
                                    <h3 class="panel-title">{!! trans('content.approve_docs') !!}</h3>
                                </div>
                                <div class="panel-body">
                                    <div class="col-md-6 col-sm-12 col-xs-12">
                                        @include('admin._trainer_doc_block',[
                                            'description' => trans('content.license'),
                                            'name' => 'license'
                                        ])
                                        @include('admin._trainer_doc_block',[
                                            'description' => trans('content.add_doc'),
                                            'name' => 'add_doc'
                                        ])
                                    </div>
                                </div>
                            </div>

                            @if (isset($data['user']) && $data['user']->trainer)
                                @include('admin._objects_table',[
                                    'objects' => $data['user']->trainer->sections,
                                    'objectName' => 'trainer-section',
                                    'withOutAdding' => true
                                ])
                            @endif

                            @if (isset($data['free_sections']) && count($data['free_sections']))
                                @include('_select_block',[
                                    'label' => trans('content.add_section'),
                                    'name' => 'new_section_id',
                                    'values' => $data['free_sections'],
                                    'optionName' => 'name_ru',
                                    'selected' => null,
                                    'useNull' => true
                                ])
                            @endif

                            @include('_textarea_block', [
                                'label' => trans('content.about_me'),
                                'name' => 'about_ru',
                                'max' => 1000,
                                'value' => isset($data['user']) && $data['user']->trainer ? $data['user']->trainer->about_ru : ''
                            ])

                            @include('_input_block', [
                                'star' => true,
                                'label' => trans('content.education'),
                                'name' => 'education_ru',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => trans('content.education'),
                                'value' => isset($data['user']) && $data['user']->trainer ? $data['user']->trainer->education_ru : ''
                            ])

                            @include('_input_block', [
                                'label' => trans('content.add_education'),
                                'name' => 'add_education_ru',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => trans('content.add_education'),
                                'value' => isset($data['user']) && $data['user']->trainer ? $data['user']->trainer->add_education_ru : ''
                            ])

                            @include('_input_block', [
                                'label' => trans('content.achievements'),
                                'name' => 'achievements_ru',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => trans('content.achievements'),
                                'value' => isset($data['user']) && $data['user']->trainer ? $data['user']->trainer->achievements_ru : ''
                            ])

                            @include('_input_block', [
                                'label' => trans('auth.fb_profile'),
                                'name' => 'fb',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => trans('auth.fb_profile'),
                                'value' => isset($data['user']) && $data['user']->trainer ? $data['user']->trainer->fb : ''
                            ])

                            @include('_input_block', [
                                'label' => trans('auth.vk_profile'),
                                'name' => 'vk',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => trans('auth.vk_profile'),
                                'value' => isset($data['user']) && $data['user']->trainer ? $data['user']->trainer->vk : ''
                            ])

                            @include('_input_block', [
                                'label' => trans('auth.inst_profile'),
                                'name' => 'vk',
                                'type' => 'text',
                                'max' => 255,
                                'placeholder' => trans('auth.inst_profile'),
                                'value' => isset($data['user']) && $data['user']->trainer ? $data['user']->trainer->inst : ''
                            ])

                            <div class="col-md-6 col-sm-12 col-xs-12">
                                @include('_input_block', [
                                    'star' => true,
                                    'label' => trans('content.experience_since'),
                                    'name' => 'since',
                                    'type' => 'number',
                                    'min' => 1900,
                                    'max' => date('Y'),
                                    'placeholder' => trans('content.experience_since'),
                                    'value' => isset($data['user']) && $data['user']->trainer ? $data['user']->trainer->since : date('Y')
                                ])
                            </div>
                            <div class="col-md-6 col-sm-12 col-xs-12">
                                @include('_select_block',[
                                    'label' => trans('content.select_the_kind_of_sport'),
                                    'name' => 'kind_of_sport_id',
                                    'values' => $data['collection'],
                                    'optionName' => 'name_ru',
                                    'selected' => isset($data['user']) && $data['user']->trainer ? $data['user']->trainer->kind_of_sport_id : null
                                ])
                            </div>

                            @include('_checkbox_block',[
                                'label' => trans('content.active'),
                                'name' => 'trainer_active',
                                'checked' => isset($data['user']) && $data['user']->trainer ? $data['user']->trainer->active : true
                            ])

                            @include('_checkbox_block',[
                                'label' => trans('content.best_trainer'),
                                'name' => 'best',
                                'checked' => isset($data['user']) && $data['user']->trainer ? $data['user']->trainer->best_trainer : false
                            ])
                        </div>
                    </div>
                </div>

                @include('admin._save_button_block')
            </form>
        </div>
    </div>

    @if (isset($data['user']))
        @include('admin._users_table_block',['users' => $data['user']->kids, 'objectName' => 'kid', 'parent' => $data['user']->id])
    @endif

    <script>
        $('input[name=is_trainer]').change(function () {
            var trainerFields = $('#trainer-fields');
            if ($(this).is(':checked')) {
                trainerFields.show('fast',function () {
                    previewImageHeight();
                });
            } else trainerFields.hide('fast');
        });
    </script>
@endsection