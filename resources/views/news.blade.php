@extends('layouts.main')

@section('content')
    <div class="section">
        <div class="container">
            @include('_header_block', [
                'tagName' => 'h1',
                'icon' => 'icon_news',
                'head' => trans('content.sports_news'),
                'image' => asset('images/hooks_logo.png')
            ])
            @foreach($data['news'] as $k => $news)
                @include('_news_block',['col' => (!$k ? 8 : 4), 'news' => $news])
                @if ($k == 2)
                    @include('_news_banner_block')
                @endif
            @endforeach
            {{ $data['news']->render() }}
        </div>
    </div>
@endsection