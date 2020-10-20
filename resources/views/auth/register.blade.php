@extends('layouts.auth')

@section('content')
<form method="POST" action="{{ url('/register') }}">
    {!! csrf_field() !!}
    <div class="panel panel-body login-form">
        <div class="text-center">
            @include('auth._logo_block')
        </div>
        @include('auth._register_fields_block')
        <div class="form-group">
            @include('_button_block', [
                'type' => 'submit',
                'mainClass' => 'bg-orange-800 btn-block',
                'text' => trans('auth.register'),
                'icon' => 'icon-circle-right2 position-right'
            ])
            @include('auth._back_home_block')
            @include('auth._oauth2_block')
        </div>
    </div>
</form>

@endsection
