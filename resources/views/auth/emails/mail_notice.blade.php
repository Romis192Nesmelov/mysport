@extends('layouts.mail')

@section('content')
    @include('auth.emails._head_block',['hLevel' => 1, 'head' => $noticeEn])
    @include('auth.emails._head_block',['hLevel' => 2, 'head' => $noticeRu])

    <?php ob_start(); ?>
    @if (isset($content) && $content)
        <p>{{ $content }}</p>
    @endif

    @if (isset($price) && $price)
        <h1>The amount of the contract is:<br> {{ Helper::valueFormat($price) }}</h1>
        <h2>Сумма контракта составляет:<br> {{ Helper::valueFormat($price) }}</h2>
    @endif

    <div>
        <p><a href="{{ $url }}" target="_blank">Details here…</a></p>
        <sup><a href="{{ $url }}" target="_blank">Подробности здесь…</a></sup>
    </div>
    @include('auth.emails._content_block', ['content' => ob_get_clean()])

    @if (isset($useUnsubscribe) && $useUnsubscribe)
        <?php ob_start(); ?>
        @include('auth.emails._unsubscribe_block')
        @include('auth.emails._footer_message_block',['footerContent' => ob_get_clean()])
    @endif
@endsection