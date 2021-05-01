@extends('layouts.main')

@section('content')
    <div id="main-slider"></div>
    <div class="section">
        <div class="container">
            @for ($i=1;$i<=3;$i++)
                @php
                    switch ($i) {
                        case 1:
                            $addClass = 'gray';
                            $blockHref = url('/trainers');
                            break;
                        case 2:
                            $addClass = 'orange';
                            $blockHref = url('/trainers');
                            break;
                        case 3:
                            $addClass = 'green';
                            $blockHref = url('/kinds-of-sport');
                            break;

                    }
                @endphp
                <div class="col-md-{{ $blindVer ? 12 : 4 }} col-sm-{{ $blindVer ? 12 : 4 }} col-xs-12">
                    <div class="triple-block {{ $addClass }}" style="background-image: url({{ asset('images/triple_block_bg'.$i.'.png') }})">
                        <div>{{ trans('content.triple_block_text'.$i) }}</div>
                        <a href="{{ $blockHref }}"><button><span>{!! trans('content.triple_block_button_text'.$i) !!}</span><i class="icon-arrow-right32"></i></button></a>
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
                'button' => ['class' => '', 'href' => 'events/all', 'text' => trans('content.all_events')]
            ])
            @include('_events_calendar_block')
            @foreach($data['events'] as $event)
                @include('_event_block', [
                    'event' => $event,
                    'colMd' => 3,
                    'blindColMd' => 4,
                    'colSm' => 4,
                    'blindColSm' => 6
                ])
            @endforeach
            @include('_events_banner_block')
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
                @include('_news_block',['col' => (!$k ? 8 : 4), 'news' => $news])
            @endforeach
            @include('_news_banner_block')
        </div>
    </div>

    <div class="section" style="padding-bottom:0;">
        <div class="container">
            @include('_header_block', [
                'tagName' => 'h1',
                'icon' => 'icon_kind_of_sport',
                'head' => trans('content.kind_of_sport'),
                'button' => ['class' => 'red', 'href' => url('/kinds-of-sport'), 'text' => trans('content.open_all_kind_of_sport')]
            ])
        </div>
    </div>
    <div class="section gray">
        <div class="container">
            @include('_kind_of_sports_block')
        </div>
    </div>

    <div class="section" data-scroll-destination="map">
        <a name="map"></a>
        <div class="container">
            @include('_header_block', [
                'tagName' => 'h1',
                'icon' => 'icon_map',
                'head' => trans('content.sport_map')
            ])

            <div class="col-md-{{ $blindVer ? '12' : '8' }} col-sm-{{ $blindVer ? '12' : '12' }} col-xs-12">
                <div id="map" class="rounded-block"></div>
            </div>

            <div class="col-md-{{ $blindVer ? '12' : '4' }} col-sm-{{ $blindVer ? '12' : '12' }} col-xs-12">
                <div class="rounded-block gray">
                    {!! csrf_field() !!}

                    <h1>{{ trans('content.find') }}</h1>
                    @include('layouts._areas_select_block',[
                        'type' => 2,
                        'useLabel' => true,
                        'selected' => isset($data['area_id']) ? $data['area_id'] : null
                    ])

                    @include('_select_type2_block',[
                        'name' => 'kind_of_sport',
                        'items' => $sports,
                        'nullItem' => trans('content.not_select_the_kind_of_sport'),
                        'label' => trans('content.select_the_kind_of_sport')
                    ])

                    {{--@include('_radio_buttons_type1_block',[--}}
                    {{--'name' => 'test2',--}}
                    {{--'items' => [--}}
                    {{--'text1' => 'Тестовый<br>текст о чем-то1',--}}
                    {{--'text2' => 'Тестовый<br>текст о чем-то2'--}}
                    {{--],--}}
                    {{--'active' => 'text2'--}}
                    {{--])--}}

                    @include('_checkbox_type1_block',[
                        'name' => 'events',
                        'label' => trans('content.sports_events'),
                        'active' => 1
                    ])

                    @include('_checkbox_type1_block',[
                        'name' => 'organizations',
                        'label' => trans('content.organizations'),
                        'active' => 1
                    ])

                    @include('_checkbox_type1_block',[
                        'name' => 'sections',
                        'label' => trans('content.sections'),
                        'active' => 1
                    ])

                    {{--@include('_checkbox_type1_block',[--}}
                        {{--'name' => 'places',--}}
                        {{--'label' => trans('content.sports_grounds'),--}}
                        {{--'active' => 1--}}
                    {{--])--}}

                    <div id="exec-find" class="button green">{{ trans('content.execute_find') }}</div>
                </div>
            </div>
        </div>
    </div>

    <div class="section" data-scroll-destination="trainers">
        <a name="trainers"></a>
        <div class="container">
            @include('_header_block', [
                'tagName' => 'h1',
                'icon' => 'icons_trainer',
                'head' => trans('content.best_trainers'),
                'button' => ['class' => 'red', 'href' => url('/trainers'), 'text' => trans('content.show_all_trainers')]
            ])

            <div class="owl-carousel sports">
                @foreach($data['trainers'] as $trainer)
                    @include('_trainer_block', ['trainer' => $trainer])
                @endforeach
            </div>
        </div>
    </div>
    <div class="section">
        <div class="container">
            @include('_header_block', [
                'tagName' => 'h1',
                'icon' => 'icons_website',
                'head' => trans('content.created_with_support')
            ])
            @for($i=1;$i<=4;$i++)
                <div class="col-md-3 col-sm-6 col-xs-6 support-logo">
                    <img src="{{ asset('images/logo'.$i.'.png') }}" />
                </div>
            @endfor
        </div>
    </div>

    @include('_map_script_block')
@endsection