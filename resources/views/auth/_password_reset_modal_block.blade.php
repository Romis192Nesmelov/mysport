@php ob_start(); @endphp

<form method="post" action="{{ route('password.email') }}">
    {!! csrf_field() !!}
    <div class="modal-body">
        <h2 class="text-center">{{ trans('auth.reset_password') }}</h2>
        <p class="auth-register">{!! trans('auth.reset_password_head') !!}</p>
        @include('_input_block',['name' => 'email', 'type' => 'email', 'placeholder' => 'E-mail', 'icon' => 'icon-user'])
        @include('auth._re_captcha_block')
        <button class="button green">{{ trans('auth.send_password_reset_link') }}</button>
    </div>
</form>

@include('layouts._modal_block',['id' => 'password-reset', 'content' => ob_get_clean()])
{{--@if (Request::path() == 'password-reset')--}}
<script>$('#password-reset').modal('show');</script>
{{--@endif--}}