@extends('layouts.mail')

@section('content')
    @include('auth.emails._head_block',['hLevel' => 1, 'head' => $head])
    @include('auth.emails._head_block',['hLevel' => 2, 'head' => $user])
    @include('auth.emails._p_block',['content' => trans('content.date').' <b>'.date('d.m.Y',Helper::setMoscowTimeZone($model->start_time)).'</b>'])
    @include('auth.emails._p_block',['content' => trans('content.time').' <b>'.date('H:i',Helper::setMoscowTimeZone($model->start_time)).' – '.date('H:i',Helper::setMoscowTimeZone($model->end_time)).'</b>'])
    @include('auth.emails._p_block',['content' => trans('content.address').' <b>'.$model['address_'.App::getLocale()].'</b>']);
    @include('auth.emails._p_block',['content' => trans('content.coordinates').' <b>'.$model->latitude.','.$model->longitude.'</b>']);

    <?php ob_start(); ?>
    @include('auth.emails._button_block',['href' => url('/events/'.$model->slug), 'buttonText' => trans('mail.event_link')])

    @include('auth.emails._content_block', ['content' => ob_get_clean()])

    @include('auth.emails._footer_message_block',['footerContent' => trans('auth.trouble_with_url_button2', [
        'actionText' => trans('mail.event_link'),
        'actionURL' => url('/events/'.$model->slug)
    ])])
@endsection