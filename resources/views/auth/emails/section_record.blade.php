@extends('layouts.mail')

@section('content')
    @include('auth.emails._head_block',['hLevel' => 1, 'head' => $head])
    @include('auth.emails._head_block',['hLevel' => 2, 'head' => $user])
    @include('auth.emails._p_block',['content' => trans('content.address').' <b>'.$model['address_'.App::getLocale()].'</b>']);
    @if ($model->phone)
        @include('auth.emails._p_block',['content' => trans('content.phone').' <b>'.$model->phone.'</b>']);
    @endif

    @if ($model->email)
        @include('auth.emails._p_block',['content' => trans('content.contact_email').' <b><a href="mailto:'.$model->email.'">'.$model->email.'</a></b>']);
    @endif

    <?php ob_start(); ?>
    @include('auth.emails._button_block',['href' => url('/sections/'.$model->slug), 'buttonText' => trans('mail.section_link')])

    @include('auth.emails._content_block', ['content' => ob_get_clean()])

    @include('auth.emails._footer_message_block',['footerContent' => trans('auth.trouble_with_url_button2', [
        'actionText' => trans('mail.event_link'),
        'actionURL' => url('/sections/'.$model->slug)
    ])])
@endsection