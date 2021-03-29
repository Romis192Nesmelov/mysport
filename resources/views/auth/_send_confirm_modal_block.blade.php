@php ob_start(); @endphp

<form method="post" action="{{ url('/confirm-user') }}">
    {!! csrf_field() !!}
    <div class="modal-body">
        <h2 class="text-center">{{ trans('auth.confirm_mail') }}</h2>
        <p class="auth-register">{!! trans('auth.confirm_mail_head') !!}</p>
        @include('_input_block',['name' => 'email', 'type' => 'email', 'placeholder' => 'E-mail', 'icon' => 'icon-user'])
        @include('auth._re_captcha_block')
        <button class="button green">{{ trans('auth.send_confirm_mail') }}</button>
    </div>
</form>
@include('layouts._modal_block',['id' => 'send-confirm', 'content' => ob_get_clean()])
{{--@if (Request::path() == 'send-confirm')--}}
    <script>$('#send-confirm').modal('show');</script>
{{--@endif--}}