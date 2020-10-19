@extends('layouts.mail')

@section('content')
    @include('auth.emails._head_block',['hLevel' => 1, 'head' => trans('auth.confirm_register_head')])
    @include('auth.emails._p_block',['content' => trans('auth.confirm_register_part1')])
    @include('auth.emails._p_block',['content' => trans('auth.confirm_register_part2')])

    <?php ob_start(); ?>
    @include('auth.emails._button_block',['href' => url('/confirm-registration/'.$token), 'buttonText' => trans('auth.complete_registration')])

    @include('auth.emails._content_block', ['content' => ob_get_clean()])

    @include('auth.emails._footer_message_block',['footerContent' => trans('auth.trouble_with_url_button2', [
        'actionText' => trans('auth.complete_registration'),
        'actionURL' => url('/confirm-registration/'.$token)
    ])])
@endsection