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
                </div>

                @include('_submit_button_block')

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
                            <p class="text-center"><a href="{{ url('/profile/child?id='.$kid->id) }}">{!! Helper::kidCreds($kid) !!}</a></p>
                            <div class="description born">{{ date('d.m.Y', $kid->born) }}</div>
                        </div>
                    @endforeach
                @endif

                @include('_right_gray_block',[
                    'addClass' => 'narrow',
                    'content' => ob_get_clean(),
                    'useMap' => false
                ])
            </form>
        </div>
    </div>
@endsection