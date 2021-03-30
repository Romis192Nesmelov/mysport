@php ob_start(); @endphp

<form method="post" action="{{ url('/register') }}">
    {!! csrf_field() !!}
    <div class="modal-body">
        <h2 class="text-center">{{ trans('auth.register') }}</h2>
        @include('auth._register_fields_block', ['email' => null])
        <button class="button green">{{ trans('auth.register') }}</button>
    </div>
</form>
@include('layouts._modal_block',['id' => 'register', 'content' => ob_get_clean()])
{{--@if (Request::path() == 'register')--}}
<script>$('#register').modal('show');</script>
{{--@endif--}}