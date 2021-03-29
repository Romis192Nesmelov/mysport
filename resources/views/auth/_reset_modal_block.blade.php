@php ob_start(); @endphp

<form method="post" action="{{ url('/password/reset') }}">
    {!! csrf_field() !!}
    <div class="modal-body">
        <h2 class="text-center">{{ trans('auth.reset_password') }}</h2>
        <p class="auth-register">{!! trans('auth.new_password_head') !!}</p>
        @include('_input_block',['name' => 'email', 'type' => 'email', 'placeholder' => 'E-mail', 'icon' => 'icon-user', 'value' => Request::has('email') ? Request::input('email') : ''])
        @include('_input_block',['name' => 'password', 'type' => 'password', 'placeholder' => trans('auth.password'), 'icon' => 'icon-lock2'])
        @include('_input_block',['name' => 'password_confirmation', 'type' => 'password', 'placeholder' => trans('auth.password_confirm'), 'icon' => 'icon-lock2'])
        @include('auth._re_captcha_block')
        <button class="button green">{{ trans('auth.save_new_password') }}</button>
    </div>
</form>

@include('layouts._modal_block',['id' => 'password-reset', 'content' => ob_get_clean()])
{{--@if (preg_match('/^(password\/reset\/.+)$/', Request::path()))--}}
    <script>$('#password-reset').modal('show');</script>
{{--@endif--}}