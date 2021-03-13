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
                    'name' => Helper::userCreds()
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
                    @include('_header_block', [
                        'tagName' => 'h1',
                        'head' => trans('content.information')
                    ])

                    @include('_input_block',[
                        'label' => trans('content.user_name'),
                        'type' => 'text',
                        'name' => 'name',
                        'value' => Auth::user()->name
                    ])

                    @include('_input_block',[
                        'label' => trans('content.surname'),
                        'type' => 'text',
                        'name' => 'surname',
                        'value' => Auth::user()->surname
                    ])

                    @include('_input_block',[
                        'label' => trans('content.family'),
                        'type' => 'text',
                        'name' => 'family',
                        'value' => Auth::user()->family
                    ])

                    @include('_input_block',[
                        'label' => trans('content.born_date'),
                        'type' => 'text',
                        'name' => 'born',
                        'placeholder' => trans('content.date_placeholder'),
                        'value' => Auth::user()->born ? date('d.m.Y',Auth::user()->born) : ''
                    ])

                    @include('_radio_buttons_type2_block',[
                        'name' => 'gender',
                        'label' => trans('content.your_gender'),
                        'items' => [trans('content.man_letter'),trans('content.woman_letter')],
                        'active' => Auth::user()->gender ? trans('content.man_letter') : trans('content.woman_letter')
                    ])

                    @include('_checkbox_type1_block',[
                        'name' => 'send_mail',
                        'label' => trans('content.receive_spam'),
                        'active' => Auth::user()->send_mail
                    ])
                </div>

                <button type="submit" class="button">{{ trans('content.save') }}</button>

                @include('_right_gray_block',[
                    'addClass' => 'narrow',
                    'content' => ob_get_clean(),
                    'useMap' => false
                ])
            </form>
        </div>
    </div>
@endsection