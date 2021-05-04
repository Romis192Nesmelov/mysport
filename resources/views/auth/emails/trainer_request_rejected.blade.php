@extends('layouts.mail')

@section('content')
    @include('auth.emails._head_block',['hLevel' => 1, 'head' => trans('messages.your_trainer_request_rejected')])
    @include('auth.emails._p_block',['content' => trans('mail.contact_the_admin').'<a href="mailto:'.(string)Settings::getSettings()->email.'">'.(string)Settings::getSettings()->email.'</a>']);
@endsection