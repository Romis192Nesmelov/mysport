@extends('layouts.mail')

@section('content')
    @include('auth.emails._head_block',['hLevel' => 1, 'head' => trans('messages.your_trainer_request_agree')])

    @include('auth.emails._p_block',['content' => trans('mail.you_can_change_info')]);

    <?php ob_start(); ?>
    @include('auth.emails._button_block',['href' => url('/profile'), 'buttonText' => trans('content.my_profile')])

    @include('auth.emails._content_block', ['content' => ob_get_clean()])

    @include('auth.emails._footer_message_block',['footerContent' => trans('auth.trouble_with_url_button2', [
        'actionText' => trans('content.my_profile'),
        'actionURL' => url('/profile')
    ])])
@endsection