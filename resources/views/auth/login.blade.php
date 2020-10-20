@extends('layouts.auth')

@section('content')
<form method="POST" action="{{ url('/login') }}">
    {!! csrf_field() !!}
    <div class="panel panel-body login-form">
        <div class="text-center">
            @include('auth._logo_block')
            <h5>{{ trans('auth.login_to_your_account') }}<small class="display-block">{{ trans('auth.or_pass') }} <a href="{{ url('/register') }}"> {{ trans('auth.registration') }}</a></small></h5>
        </div>

        @include('auth._login_fields_block')
        @include('auth._oauth2_block')

        <div class="form-group">
            @include('_button_block', [
                'type' => 'submit',
                'mainClass' => 'bg-orange-800 btn-block',
                'text' => trans('content.enter'),
                'icon' => 'icon-circle-right2 position-right'
            ])
            @include('auth._back_home_block')
        </div>
    </div>
</form>

@endsection