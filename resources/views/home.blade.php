@extends('layouts.main')

@section('content')
    <div id="main-slider"></div>
    <div class="section">
        <div class="container">
            @for ($i=1;$i<=3;$i++)
                @php
                    switch ($i) {
                        case 1:
                            $addClass = 'orange';
                            break;
                        case 2:
                            $addClass = 'green';
                            break;
                        case 3:
                            $addClass = 'gray';
                            break;
                    }
                @endphp
                <div class="col-md-4 col-sm-4 col-xs-12">
                    <div class="triple-block {{ $addClass }}" style="background-image: url({{ asset('images/triple_block_bg'.$i.'.png') }})">
                        <div>{{ trans('content.triple_block_text'.$i) }}</div>
                        <a data-scroll="map"><button><span>{!! trans('content.triple_block_button_text'.$i) !!}</span><i class="icon-arrow-right32"></i></button></a>
                    </div>
                </div>
            @endfor
        </div>
    </div>
    <div class="banner"><img src="{{ asset('images/banner1.jpg') }}" /></div>

    <div class="section" data-scroll-destination="events">
        <a name="events"></a>
        <div class="container">
            @include('_header_block', [
                'tagName' => 'h1',
                'icon' => 'icon_sports_events',
                'head' => trans('content.sports_events_poster'),
                'button' => ['class' => '', 'href' => 'events', 'text' => trans('content.all_events')]
            ])
            <div class="col-md-3 col-sm-3 col-xs-12 event">

            </div>
            @foreach($data['events'] as $k => $event)
                <div class="col-md-3 col-sm-3 col-xs-12 event">
                    <div class="button green">{{ date('j',$event->time).' '.trans('months.'.date('m',$event->time)).' '.date('Y',$event->time).' '.date('G:i',$event->time) }}</div>
                    <h3>{{ $event['name_'.App::getLocale()] }}</h3>
                    <p>{{ $event['description_'.App::getLocale()] }}</p>
                </div>
            @endforeach
            <div class="col-md-6 col-sm-6 col-xs-12 event">
                <div class="banner"><img src="{{ asset('images/banner3.jpg') }}" /></div>
            </div>
        </div>
    </div>

    <div class="section" data-scroll-destination="news">
        <a name="news"></a>
        <div class="container">
            @include('_header_block', [
                'tagName' => 'h1',
                'icon' => 'icon_news',
                'head' => trans('content.sports_news'),
                'image' => asset('images/hooks_logo.png'),
                'button' => ['class' => '', 'href' => 'news', 'text' => trans('content.read_all_news')]
            ])

            @foreach($data['news'] as $k => $news)
                <div class="col-md-{{ !$k ? 8 : 4 }} col-sm-12 col-xs-12">
                    <div class="news">
                        <img src="{{ asset($news->image) }}" />
                        <div class="grad"></div>
                        <div class="text">
                            <div class="head">{{ $news['head_'.App::getLocale()] }}</div>
                            @if (!$k)
                                <div class="content hidden-sm hidden-xs">{{ $news['content_'.App::getLocale()] }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="banner"><img src="{{ asset('images/banner2.jpg') }}" /></div>
            </div>
        </div>
    </div>

    <div class="section" style="padding-bottom:0;">
        <div class="container">
            @include('_header_block', [
                'tagName' => 'h1',
                'icon' => 'icon_kind_of_sport',
                'head' => trans('content.kind_of_sport'),
                'button' => ['class' => 'red', 'href' => '#', 'text' => trans('content.open_all_kind_of_sport')]
            ])
        </div>
    </div>
    <div class="section gray">
        <div class="container">
            <div class="owl-carousel sports">
                @foreach($data['sports'] as $sport)
                    <div class="kind-of-sport">
                        <a href="{{ url('sport/?id='.$sport->id) }}"><img src="{{ asset($sport->icon) }}" /></a>
                        {{ $sport['name_'.App::getLocale()] }}
                    </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="section" data-scroll-destination="map">
        <a name="map"></a>
        <div class="container">
            @include('_header_block', [
                'tagName' => 'h1',
                'icon' => 'icon_sports_events',
                'head' => trans('content.sport_map')
            ])
        </div>
    </div>
    <div class="section" data-scroll-destination="trainers">
        <a name="trainers"></a>
        <div class="container">
            @include('_header_block', [
                'tagName' => 'h1',
                'icon' => 'icons_trainer',
                'head' => trans('content.best_trainers'),
                'button' => ['class' => 'red', 'href' => '#', 'text' => trans('content.show_all_trainers')]
            ])

            <div class="owl-carousel sports">
                @foreach($data['trainers'] as $trainer)
                    @if ($trainer->sport->active)
                        <div class="trainer">
                            <a href="{{ url('$trainers/?id='.$trainer->id) }}">
                                <div class="photo"><img src="{{ asset($trainer->image) }}" /></div>
                                @php $partsOfName = explode(' ',$trainer['name_'.App::getLocale()]); @endphp
                                <div class="family">{{ $partsOfName[0] }}</div>
                                {{ $partsOfName[1].(isset($partsOfName[2]) ? ' '.$partsOfName[2] : '') }}
                                <div class="section-name">{{ trans('content.trainer_section', ['section' => $trainer->sport['name_'.App::getLocale()]]) }}</div>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container">
            @include('_header_block', [
                'tagName' => 'h1',
                'icon' => 'icons_trainer',
                'head' => trans('content.created_with_support')
            ])
            @for($i=1;$i<=4;$i++)
                <div class="col-md-3 col-sm-6 col-xs-12 support-logo">
                    <img src="{{ asset('images/logo'.$i.'.png') }}" />
                </div>
            @endfor
        </div>
    </div>

@endsection