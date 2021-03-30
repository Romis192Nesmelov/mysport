@php ob_start(); @endphp

<form method="post" action="{{ url('/password/reset') }}">
    {!! csrf_field() !!}
    <input type="hidden" name="token" value="{{ $token }}">
    <div class="modal-body">
        <h2 class="text-center">{{ trans('auth.reset_password') }}</h2>
        <p class="auth-register">{!! trans('auth.new_password_head') !!}</p>
        @include('auth._register_fields_block', ['email' => Request::has('email') ? Request::input('email') : ''])
        <button class="button green">{{ trans('auth.save_new_password') }}</button>
    </div>
</form>

@include('layouts._modal_block',['id' => 'password-reset', 'content' => ob_get_clean()])
{{--@if (preg_match('/^(password\/reset\/.+)$/', Request::path()))--}}
    <script>$('#password-reset').modal('show');</script>
{{--@endif--}}