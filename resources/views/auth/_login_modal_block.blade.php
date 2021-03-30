@php ob_start(); @endphp

<form method="post" action="{{ url('/login') }}">
    {!! csrf_field() !!}
    <input type="hidden" name="token" value="{{ $token }}">
    <div class="modal-body">
        <h2 class="text-center">{{ trans('auth.login_to_your_account') }}</h2>
        <p class="auth-register">{{ trans('auth.or_pass') }} <a href="{{ url('?auth=register') }}"> {{ trans('auth.registration') }}</a></p>
        @include('auth._login_fields_block')
        @include('auth._oauth2_block')
        <button class="button green">{{ trans('content.enter') }}</button>
    </div>
</form>
@include('layouts._modal_block',['id' => 'login', 'content' => ob_get_clean()])
{{--@if (Request::path() == 'login')--}}
<script>$('#login').modal('show');</script>
{{--@endif--}}