@extends('layouts.main')

@section('content')
    <div class="section">
        <div class="container">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ url('/child') }}" method="post">
                {{ csrf_field() }}
                @if (isset($data['kid']))
                    <input type="hidden" name="id" value="{{ $data['kid']->id }}">
                @endif

                @php ob_start(); @endphp
                @include('_cir_image_block', [
                    'inputName' => 'avatar',
                    'image' => isset($data['kid']) ? $data['kid']->avatar : null,
                    'name' => isset($data['kid']) ? Helper::simpleCreds($data['kid']) : trans('content.adding_kid_profile')
                ])

                @include('_left_gray_block',[
                    'content' => ob_get_clean(),
                    'buttons' => false
                ])

                @php ob_start(); @endphp

                @include('_user_info_block',['user' => isset($data['kid']) ? $data['kid'] : null])

                <div class="flex-container">
                    @include('_checkbox_type1_block',[
                        'name' => 'active',
                        'label' => trans('content.active'),
                        'active' => isset($data['kid']) ? $data['kid']->active : 1
                    ])
                    <div class="vertical-delimiter"></div>
                    @include('_radio_buttons_type2_block',[
                        'name' => 'gender',
                        'label' => trans('content.kid_gender'),
                        'items' => [trans('content.man_letter'),trans('content.woman_letter')],
                        'active' => (isset($data['kid']) && $data['kid']->gender) || isset($data['kid']) ? trans('content.man_letter') : trans('content.woman_letter')
                    ])
                </div>

                @include('_submit_button_block')

                @include('_right_gray_block',[
                    'content' => ob_get_clean(),
                    'useMap' => false
                ])
            </form>
        </div>
    </div>
@endsection