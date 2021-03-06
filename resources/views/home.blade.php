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
                <div class="col-md-{{ $blindVer ? 12 : 4 }} col-sm-{{ $blindVer ? 12 : 4 }} col-xs-12">
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
            <div class="col-md-{{ $blindVer ? '4' : '3' }} col-sm-{{ $blindVer ? '6' : '4' }} col-xs-12 calendar-container">
                @include('_header_block', [
                    'tagName' => 'h2',
                    'icon' => 'icon_date',
                    'head' => trans('content.the_calendar_of_sports_events')
                ])

                <div class="owl-carousel calendar">
                    @php $week = 1; @endphp
                    @for($month=1;$month <= (date('n') > 10 ? 12 + date('n') - 8 : 12);$month++)
                        @php
                            if ($month > 12) {
                                $month = $month - 12;
                                $year = $data['year'] + 1;
                            } else {
                                $year = $data['year'];
                            }
                        @endphp
                        <div class="calendar-block">
                            @php
                                // Calculate how many weeks in month
                                $weeksOnMonth = 1;
                                for($d=1;$d<=Helper::getNumberDaysInMonth($month, $year);$d++) {
                                    if ($d > 1 && date('N', strtotime($month.'/'.$d.'/'.$year)) == 1) $weeksOnMonth++;
                                }
                            @endphp

                            <div class="month">{{ trans('calendar.m'.$month).' '.$year }}</div>
                            <table>
                                <tr class="week">
                                    @for($wd=0;$wd<=7;$wd++)
                                        <td>{{ $wd ? trans('calendar.d'.$wd) : '' }}</td>
                                    @endfor
                                </tr>
                                @php $day = 0; @endphp
                                @for($w=1;$w<=$weeksOnMonth;$w++)
                                    <tr>
                                        @for($wd=0;$wd<=7;$wd++)
                                            @if(!$wd)
                                                <td><i>{{ $week }}</i></td>
                                            @else
                                                @php if ($w == 1 && $wd == date('N', strtotime($month.'/1/'.$year))) $day = 1; @endphp
                                                <td>
                                                    @if ($day && $day <= Helper::getNumberDaysInMonth($month, $year))
                                                        @php
                                                            $eventsMatch = false;
                                                            foreach ($data['events_on_year'] as $event) {
                                                                if (date('Y',$event->start_time) == $year && date('n',$event->start_time) == $month && date('j',$event->start_time) == $day) {
                                                                    $eventsMatch = $event;
                                                                    break;
                                                                }
                                                            }
                                                            $incrementWeek = true;
                                                        @endphp
                                                        @if ($eventsMatch)
                                                            <div class="event-day"><a href="{{ url('/events/'.$eventsMatch->slug) }}">{{ $day }}</a></div>
                                                        @else
                                                            {{ $day }}
                                                        @endif
                                                    @else
                                                        @php $incrementWeek = false; @endphp
                                                    @endif
                                                </td>
                                            @endif
                                            @php if ($day && $wd) $day++; @endphp
                                        @endfor
                                    </tr>
                                    @php if ($incrementWeek) $week++; @endphp
                                @endfor
                            </table>
                        </div>
                    @endfor
                </div>

            </div>
            @for($i=0;$i<(count($data['events']) > 5 ? 5 : count($data['events']));$i++)
                @php $event = $data['events'][$i]; @endphp
                <div class="col-md-{{ $blindVer ? '4' : '3' }} col-sm-{{ $blindVer ? '6' : '4' }} col-xs-12 event">
                    <div class="button green">{{ date('j',$event->start_time).' '.trans('months.'.date('m',$event->start_time)).' '.date('Y',$event->start_time).' '.date('G:i',$event->start_time) }}</div>
                    <h3>{{ $event['name_'.App::getLocale()] }}</h3>
                    <p>{{ $event['description_'.App::getLocale()] }}</p>
                </div>
            @endfor
            <div class="col-md-6 col-sm-{{ $blindVer ? '12' : '6' }} col-xs-12 banner3">
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
                @foreach($sports as $sport)
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

                    {{--@include('_radio_buttons_type2_block',[--}}
                    {{--'name' => 'test1',--}}
                    {{--'label' => 'Укажите ваш пол',--}}
                    {{--'items' => ['М','Ж'],--}}
                    {{--'active' => 'М'--}}
                    {{--])--}}

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

                    @include('_checkbox_type1_block',[
                        'name' => 'places',
                        'label' => trans('content.sports_grounds'),
                        'active' => 1
                    ])

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
    <script>window.currentMonth = parseInt("{{ date('n') }}")-1;</script>

    @include('_map_script_block')
@endsection