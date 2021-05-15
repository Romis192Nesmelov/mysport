@extends('layouts.main')

@section('content')
    <div class="section">
        <div class="container">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ url('/profile') }}" method="post">
                {{ csrf_field() }}

                @php ob_start(); @endphp
                @include('_cir_image_block', [
                    'inputName' => 'avatar',
                    'image' => Auth::user()->avatar,
                    'name' => Helper::userCreds(),
                    'counter1' => count(Auth::user()->kids) ? Helper::countKids(count(Auth::user()->kids)) : null,
                    'scroll1' => 'kids'
                ])

                @include('_left_gray_block',[
                    'content' => ob_get_clean(),
                    'buttons' => false,
                    'kidsMode' => true
                ])

                @php ob_start(); @endphp

                <div class="col-md-6 col-sm-12 col-xs-12">
                    @include('_header_block', [
                        'tagName' => 'h1',
                        'head' => trans('content.account')
                    ])

                    @include('_input_block',[
                        'label' => 'E-mail',
                        'type' => 'email',
                        'name' => 'email',
                        'value' => Auth::user()->email
                    ])

                    @include('_input_block',[
                        'label' => trans('content.phone'),
                        'type' => 'text',
                        'name' => 'phone',
                        'placeholder' => '+7(___)___-__-__',
                        'value' => Auth::user()->phone
                    ])

                    <h2 class="text-grey-600">{{ trans('content.change_password') }}</h2>

                    @include('_input_block',[
                        'label' => trans('content.enter_old_password'),
                        'type' => 'password',
                        'name' => 'old_password',
                        'value' => ''
                    ])

                    @include('_input_block',[
                        'label' => trans('content.enter_new_password'),
                        'type' => 'password',
                        'name' => 'password',
                        'value' => ''
                    ])

                    @include('_input_block',[
                        'label' => trans('content.confirm_new_password'),
                        'type' => 'password',
                        'name' => 'password_confirmation',
                        'value' => ''
                    ])
                </div>

                <div class="col-md-6 col-sm-12 col-xs-12">
                    @include('_user_info_block',[
                        'user' => Auth::user(),
                        'secondHead' => true
                    ])

                    <div class="flex-container">
                        @include('_checkbox_type1_block',[
                            'name' => 'send_mail',
                            'label' => trans('content.receive_spam'),
                            'active' => Auth::user()->send_mail
                        ])
                        <div class="vertical-delimiter"></div>
                        @include('_radio_buttons_type2_block',[
                            'name' => 'gender',
                            'label' => trans('content.your_gender'),
                            'items' => [trans('content.man_letter'),trans('content.woman_letter')],
                            'active' => Auth::user()->gender ? trans('content.man_letter') : trans('content.woman_letter')
                        ])
                    </div>
                    @if (Gate::denies('trainer') && Gate::denies('organizer'))
                        @php
                            $hasErrsTrainerFields = false;
                            if (count($errors)) {
                                foreach (['about_me','education_ru','add_education_ru','achievements','since','fb','vk','inst'] as $errField) {
                                    if ($errors->has($errField)) {
                                        $hasErrsTrainerFields = true;
                                        break;
                                    }
                                }
                            }
                        @endphp

                        @include('_checkbox_type1_block',[
                            'name' => 'trainer_request',
                            'label' => trans('content.trainer_request'),
                            'active' => Auth::user()->trainer || $hasErrsTrainerFields
                        ])
                    @endif
                </div>

                @include('_submit_button_block',['addClass' => 'middle-save-button'.(Auth::user()->trainer || $hasErrsTrainerFields ? ' hidden' : '')])

                @if (count(Auth::user()->kids))
                    @include('_modal_delete_block',[
                        'modalId' => 'delete-modal',
                        'function' => 'profile/delete-child',
                         'head' => trans('content.confirm_delete_record')
                     ])

                    @include('_header_block', [
                        'tagName' => 'h2',
                        'addClass' => 'center',
                        'head' => trans('content.children_accounts'),
                        'scroll' => 'kids'
                    ])

                    @foreach(Auth::user()->kids as $kid)
                        <div id="kid_{{ $kid->id }}" class="col-md-6 col-sm-6 col-xs-12">
                            @include('layouts._avatar_block',[
                                'avatar' => $kid->avatar,
                                'deleteModal' => 'delete-modal',
                                'delData' => $kid->id
                            ])
                            <p class="text-center"><a href="{{ url('/profile/child?id='.$kid->id) }}">{!! Helper::simpleCreds($kid) !!}</a></p>
                            <div class="description born">{{ date('d.m.Y', $kid->born) }}</div>
                        </div>
                    @endforeach
                @endif

                @include('_right_gray_block',[
                    'addClass' => 'narrow',
                    'content' => ob_get_clean(),
                    'useMap' => false
                ])

                <!-- Trainer block -->
                @if (Gate::denies('organizer'))

                    @php ob_start(); @endphp
                    @include('_header_block', [
                        'tagName' => 'h1',
                        'head' => trans('content.trainer_info')
                    ])

                    <h2>{{ trans('content.approve_docs') }}</h2>
                    <div class="content-block table">
                        <div class="description input-label">{{ trans('content.license') }}</div>
                        <div class="col-md-6 col-sm-12 col-xs-12">
                            @include('_image_block',[
                                'name' => 'license',
                                'preview' => Auth::user()->trainer ? Auth::user()->trainer->license : ''
                            ])
                        </div>
                    </div>

                    @include('_select_type3_block',[
                        'label' => trans('content.select_the_kind_of_sport'),
                        'name' => 'kind_of_sport_id',
                        'values' => $sports,
                        'optionName' => 'name_ru',
                        'selected' => Auth::user()->trainer ? Auth::user()->trainer->kind_of_sport_id : ''
                    ])

                    @if (Auth::user()->trainer && count(Auth::user()->trainer->activeSections))
                        {{ csrf_field() }}
                        @include('_modal_delete_block',['modalId' => 'delete-trainer-section-modal', 'function' => url('delete-trainer-section'), 'head' => trans('admin.do_you_want_to_delete_trainer-section')])
                        <table class="table datatable-basic items-list">
                            <tr>
                                <th class="text-center">{{ trans('content.image') }}</th>
                                <th class="text-center">{{ trans('content.name') }}</th>
                                <th class="text-center">{{ trans('admin.del') }}</th>
                            </tr>
                            @foreach (Auth::user()->trainer->activeSections as $section)
                                <tr id="{{ 'section_'.$section->id }}">
                                    <td class="text-center">@include('layouts._avatar_block',['avatar' => $section->image, 'usePreview' => true])</td>
                                    <td class="text-center"><a href="{{ url('/sections/'.$section->slug) }}">{{ $section['name_'.App::getLocale()] }}</a></td>
                                    <td class="delete"><span del-data="{{ $section->id }}" modal-data="delete-trainer-section-modal" class="glyphicon glyphicon-remove-circle"></span></td>
                                </tr>
                            @endforeach
                        </table>
                        <script>window.dtColumns = 2;</script>

                        @if (count($data['free_sections']))
                            @include('_select_type3_block',[
                                'label' => trans('content.add_section'),
                                'name' => 'new_section_id',
                                'values' => $data['free_sections'],
                                'optionName' => 'name_ru',
                                'selected' => null,
                                'useNull' => true
                            ])
                        @endif
                    @endif

                    @include('_textarea_block', [
                        'label' => trans('content.about_me'),
                        'name' => 'about_ru',
                        'value' => Auth::user()->trainer ? Auth::user()->trainer->about_ru : ''
                    ])

                    @include('_input_block',[
                        'label' => trans('content.education'),
                        'type' => 'text',
                        'name' => 'education_ru',
                        'value' => Auth::user()->trainer ? Auth::user()->trainer->education_ru : ''
                    ])

                    @include('_input_block',[
                        'label' => trans('content.add_education'),
                        'type' => 'text',
                        'name' => 'add_education_ru',
                        'value' => Auth::user()->trainer ? Auth::user()->trainer->add_education_ru : ''
                    ])

                    @include('_input_block',[
                        'label' => trans('content.achievements'),
                        'type' => 'text',
                        'name' => 'achievements_ru',
                        'value' => Auth::user()->trainer ? Auth::user()->trainer->achievements_ru : ''
                    ])

                    @include('_input_block',[
                        'label' => trans('auth.fb_profile'),
                        'type' => 'text',
                        'name' => 'fb',
                        'value' => Auth::user()->trainer ? Auth::user()->trainer->fb : ''
                    ])

                    @include('_input_block',[
                        'label' => trans('auth.vk_profile'),
                        'type' => 'text',
                        'name' => 'vk',
                        'value' => Auth::user()->trainer ? Auth::user()->trainer->vk : ''
                    ])

                    @include('_input_block',[
                        'label' => trans('auth.inst_profile'),
                        'type' => 'text',
                        'name' => 'inst',
                        'value' => Auth::user()->trainer ? Auth::user()->trainer->inst : ''
                    ])

                    @include('_input_block',[
                        'label' => trans('content.experience_since').' ('.trans('content.year').')',
                        'type' => 'number',
                        'name' => 'since',
                        'min' => 1970,
                        'max' => (int)date('Y'),
                        'value' => Auth::user()->trainer ? Auth::user()->trainer->since : date('Y'),
                        'addAttr' => ['style' => 'width:150px']
                    ])

                    @include('_submit_button_block')

                    @include('_right_gray_block',[
                        'addClass' => 'narrow trainer-fields'.(!Auth::user()->trainer && !$hasErrsTrainerFields ? ' hidden' : ''),
                        'content' => ob_get_clean(),
                        'useMap' => false
                    ])

                @endif
                <!-- /trainer block -->
            </form>
            @if (Gate::allows('trainer') || Gate::allows('organizer'))

                @php ob_start(); @endphp

                @include('_header_block', [
                    'tagName' => 'h2',
                    'head' => trans('content.my_sports_events')
                ])

                <div class="content-block">
                    @foreach ($data['events'] as $event)
                        @include('_event_block', [
                            'prefix' => 'trainer',
                            'colMd' => 6,
                            'blindColMd' => 12,
                            'colSm' => 6,
                            'blindColSm' => 12
                        ])
                    @endforeach

                    <div class="table text-center">{{ $data['events']->render() }}</div>
                </div>

                <div class="button gray2"><a href="{{ url('/trainer/events/add') }}">{{ trans('content.add_event') }}</a></div>

                @include('_right_gray_block',[
                    'addClass' => 'narrow',
                    'content' => ob_get_clean(),
                    'useMap' => false
                ])
            @endif
        </div>
    </div>
@endsection