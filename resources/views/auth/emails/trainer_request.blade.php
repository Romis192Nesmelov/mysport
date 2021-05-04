@extends('layouts.mail')

@section('content')
    @include('auth.emails._head_block',['hLevel' => 1, 'head' => $head])
    @include('auth.emails._head_block',['hLevel' => 2, 'head' => Helper::userCreds($user,true) ])

    @if ($user->phone)
        @include('auth.emails._p_block',['content' => trans('content.phone').' <b>'.$user->phone.'</b>']);
    @endif
    @if ($user->email)
        @include('auth.emails._p_block',['content' => trans('content.contact_email').' <b><a href="mailto:'.$user->email.'">'.$user->email.'</a></b>']);
    @endif

    <?php ob_start(); ?>
    @include('auth.emails._button_block',['href' => url('/admin/users?id='.$user->id), 'buttonText' => trans('content.user'.' '.Helper::userCreds($user,true))])

    @include('auth.emails._content_block', ['content' => ob_get_clean()])

    @include('auth.emails._footer_message_block',['footerContent' => trans('auth.trouble_with_url_button2', [
        'actionText' => trans('content.user'.' '.Helper::userCreds($user,true)),
        'actionURL' => url('/admin/users?id='.$user->id)
    ])])
@endsection