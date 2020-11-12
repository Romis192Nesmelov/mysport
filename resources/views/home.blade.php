@extends('layouts.main')

@section('content')
    <div class="row">
        <div class="col-md-3 col-sm-4 col-xs-12">
            <div class="panel panel-flat">
                <div class="panel-body">
                    @include('_button_block',['text' => trans('menu.to_record'), 'type' => 'button', 'addClass' => 'big'])
                    @include('_button_block',['text' => trans('menu.create_a_training'), 'type' => 'button', 'addClass' => 'big'])
                    @include('_button_block',['text' => trans('menu.organize_an_event'), 'type' => 'button', 'addClass' => 'big'])
                </div>
            </div>

            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h2 class="panel-title">{{ trans('content.filtering_by') }}</h2>
                </div>
                <form class="form-horizontal">
                    <div class="panel-body">
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{ trans('content.filter_area') }}</h3>
                            </div>
                            <div class="panel-body">
                                @include('_select_block', [
                                    'name' => 'area',
                                    'values' => [1 => 'Выберите район'],
                                    'selected' => 1
                                ])
                            </div>
                        </div>
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{ trans('content.filter_kind_of_sport') }}</h3>
                            </div>
                            <div class="panel-body">
                                <div class="sport-icon"><i class="icon-star-full2"></i></div>
                                <div class="sport-icon"><i class="icon-star-full2"></i></div>
                                <div class="sport-icon"><i class="icon-star-full2"></i></div>
                                <div class="sport-icon"><i class="icon-star-full2"></i></div>
                                <div class="sport-icon"><i class="icon-star-full2"></i></div>
                                <div class="sport-icon"><i class="icon-star-full2"></i></div>
                                <div class="sport-icon"><i class="icon-star-full2"></i></div>
                                <div class="sport-icon"><i class="icon-star-full2"></i></div>
                                <div class="sport-icon"><i class="icon-star-full2"></i></div>
                            </div>
                        </div>
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{ trans('content.filter_location_of_sport') }}</h3>
                            </div>
                            <div class="panel-body">
                                @include('_select_block', [
                                    'name' => 'location',
                                    'values' => [1 => 'Выберите локацию доя спорта'],
                                    'selected' => 1
                                ])
                            </div>
                        </div>
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{ trans('content.filter_spot_organisation') }}</h3>
                            </div>
                            <div class="panel-body">
                                @include('_select_block', [
                                    'name' => 'organisation',
                                    'values' => [1 => 'Выберите спортивную организацию'],
                                    'selected' => 1
                                ])
                            </div>
                        </div>
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{ trans('content.filter_old_group') }}</h3>
                            </div>
                            <div class="panel-body">
                                @include('_radio_simple_block', [
                                    'name' => 'old',
                                    'data' => [
                                        ['value' => 1, 'label' => '5-17 лет'],
                                        ['value' => 2, 'label' => '18-65 лет'],
                                        ['value' => 3, 'label' => '65+ лет'],
                                    ],
                                    'checked' => 1
                                ])
                            </div>
                        </div>
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{ trans('content.filter_gender') }}</h3>
                            </div>
                            <div class="panel-body">
                                @include('_radio_simple_block', [
                                    'name' => 'old',
                                    'data' => [
                                        ['value' => 1, 'label' => '<i class="fa fa-mars"></i> Мужской'],
                                        ['value' => 2, 'label' => '<i class="fa fa-venus"></i> Женский']
                                    ],
                                    'checked' => 1
                                ])
                            </div>
                        </div>
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{ trans('content.filter_skills_level') }}</h3>
                            </div>
                            <div class="panel-body">
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    @include('_radio_button_block',[
                                        'name' => 'skills',
                                        'values' => [
                                            ['val' => 1, 'descript' => 'Новичок'],
                                            ['val' => 2, 'descript' => 'Любитель']

                                        ],
                                        'activeValue' => 1
                                    ])
                                </div>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    @include('_radio_button_block',[
                                        'name' => 'skills',
                                        'values' => [
                                            ['val' => 3, 'descript' => 'Опытный'],
                                            ['val' => 4, 'descript' => 'Профессионал']

                                        ],
                                        'activeValue' => 1
                                    ])
                                </div>
                            </div>
                        </div>
                        <div class="panel panel-flat">
                            <div class="panel-heading">
                                <h3 class="panel-title">{{ trans('content.filter_event_type') }}</h3>
                            </div>
                            <div class="panel-body">
                                @include('_radio_simple_block', [
                                    'name' => 'event_type',
                                    'data' => [
                                        ['value' => 1, 'label' => 'Открытое'],
                                        ['value' => 2, 'label' => 'Закрытое']
                                    ],
                                    'checked' => 1
                                ])
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-9 col-sm-8 col-xs-12">
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h2 class="panel-title">{{ trans('menu.news') }}</h2>
                </div>
                <div class="panel-body">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="panel panel-flat single-height">
                            <div class="panel-heading">
                                <div class="news-date">24.20.2020г.</div>
                                <h4 class="panel-title">Lorem ipsum dolor sit amet, consectetur adipiscing elit</h4>
                            </div>
                            <div class="panel-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed auctor libero eget lorem eleifend faucibus. Maecenas viverra pharetra purus nec pulvinar. Quisque tristique suscipit diam, nec pretium mi gravida in. Cras congue rutrum nunc vitae placerat. Praesent non libero nec elit pharetra posuere. Proin in porta erat. Vivamus dapibus nisl sit amet luctus placerat. Praesent sit amet hendrerit quam. Nam congue mi eu risus ultricies, sollicitudin gravida mauris gravida. Etiam a condimentum est, eget tempus lorem. Etiam elit enim, laoreet sit amet scelerisque a, sagittis eget arcu. Morbi eget nulla euismod, tincidunt lorem vel, malesuada leo.</p>
                                <p>Nunc metus mauris, sollicitudin sed est quis, ultrices vestibulum justo. Cras ac metus convallis, elementum dui quis, vestibulum est. Quisque tincidunt, nunc sed volutpat tempus, neque neque rutrum orci, convallis consectetur leo quam laoreet nisl. In tortor massa, vulputate nec congue at, lacinia at sem. Nulla quis nisi in libero sodales pretium. Quisque sed sollicitudin libero, sed rhoncus nibh. Ut rhoncus rutrum ante, non semper enim lacinia eu.</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="panel panel-flat single-height">
                            <div class="panel-body">
                                <ul class="news">
                                    <li>
                                        <table>
                                            <tr>
                                                <td class="news-date in-line">22.20.2020г.</td>
                                                <td><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean fermentum convallis sollicitudin. Nunc in massa eleifend, facilisis odio sit amet.</a></td>
                                            </tr>
                                        </table>
                                    </li>
                                    <li>
                                        <table>
                                            <tr>
                                                <td class="news-date in-line">22.20.2020г.</td>
                                                <td><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean fermentum convallis sollicitudin. Nunc in massa eleifend, facilisis odio sit amet.</a></td>
                                            </tr>
                                        </table>
                                    </li>
                                    <li>
                                        <table>
                                            <tr>
                                                <td class="news-date in-line">22.20.2020г.</td>
                                                <td><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Suspendisse sit amet nisi at sem faucibus pharetra eu sit amet arcu. Mauris sollicitudin vulputate neque et mollis. Cras in dictum ligula.</a></td>
                                            </tr>
                                        </table>
                                    </li>
                                    <li>
                                        <table>
                                            <tr>
                                                <td class="news-date in-line">22.20.2020г.</td>
                                                <td><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec vitae cursus augue. Donec porta risus ac elit efficitur, id imperdiet nunc facilisis.</a></td>
                                            </tr>
                                        </table>
                                    </li>
                                    <li>
                                        <table>
                                            <tr>
                                                <td class="news-date in-line">22.20.2020г.</td>
                                                <td><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean fermentum convallis sollicitudin. Nunc in massa eleifend, facilisis odio sit amet.</a></td>
                                            </tr>
                                        </table>
                                    </li>
                                    <li>
                                        <table>
                                            <tr>
                                                <td class="news-date in-line">22.20.2020г.</td>
                                                <td><a href="#">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean fermentum convallis sollicitudin. Nunc in massa eleifend, facilisis odio sit amet.</a></td>
                                            </tr>
                                        </table>
                                    </li>
                                </ul>
                                <a href="#" class="pull-right">{{ trans('content.all_news') }} »</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h2 class="panel-title">{{ trans('content.events_calendar') }}</h2>
                </div>
                <div class="panel-body">
                    @php $week = 36; $year = 2020; @endphp
                    @for($month=9;$month<=12;$month++)
                        @php
                        $weeksOnMonth = 1;
                        for($d=1;$d<=cal_days_in_month(CAL_GREGORIAN, $month, $year);$d++) {
                            if ($d > 1 && date('N', strtotime($month.'/'.$d.'/'.$year)) == 1) $weeksOnMonth++;
                        }
                        @endphp

                        <div class="col-md-3 col-sm-4 col-xs-12 month">
                            <div class="panel-heading text-center">
                                <h5>{{ trans('calendar.m'.$month) }}</h5>
                            </div>
                            <table>
                                <tr>
                                    @for($wd=0;$wd<=7;$wd++)
                                        <th>{{ $wd ? trans('calendar.d'.$wd) : '' }}</th>
                                    @endfor
                                </tr>
                                @php $day = 0; @endphp
                                @for($w=1;$w<=$weeksOnMonth;$w++)
                                    <tr>
                                        @for($wd=0;$wd<=7;$wd++)
                                            @if(!$wd)
                                                <td><b>{{ $week }}</b></td>
                                            @else
                                                @php if ($w == 1 && $wd == date('N', strtotime($month.'/1/'.$year))) $day = 1; @endphp
                                                <td>
                                                    @if ($day && $day <= cal_days_in_month(CAL_GREGORIAN, $month, $year))
                                                        @php $incrementWeek = true; @endphp
                                                        {{ $day }}
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
            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h2 class="panel-title">{{ trans('content.sports_events') }}</h2>
                </div>
                <div class="panel-body">
                    @for ($i=0;$i<4;$i++)
                        <div class="col-md-3 col-sm-6 col-xs-12">
                            <div class="panel panel-flat">
                                <div class="panel-body">
                                    <div class="framed-image"><img src="{{ asset('images/placeholder.jpg') }}" /></div>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed auctor libero eget lorem eleifend faucibus.
                                </div>
                            </div>
                        </div>
                    @endfor
                </div>
            </div>

            <div class="panel panel-flat">
                <div class="panel-heading">
                    <h2 class="panel-title">{{ trans('menu.map') }}</h2>
                </div>
                <div class="panel-body">
                    <div style="width: 100%; height: 830px; border: 1px solid #ddd; position:relative;overflow:hidden;"><iframe src="https://yandex.ru/map-widget/v1/-/CCQ~bQDr1A" width="100%" height="830" frameborder="0" allowfullscreen="true" style="position:relative;"></iframe></div>
                </div>
            </div>
        </div>
    </div>
@endsection