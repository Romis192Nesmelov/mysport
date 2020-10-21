<!DOCTYPE html>
<!--  This site was created in Webflow. http://www.webflow.com  -->
<!--  Last Published: Wed Mar 21 2018 11:43:04 GMT+0000 (UTC)  -->
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $data['seo']['title'] }}</title>
    @foreach($metas as $meta => $params)
        @if ($data['seo'][$meta])
            <meta {{ $params['name'] ? 'name='.$params['name'] : 'property='.$params['property'] }} content="{{ $data['seo'][$meta] }}">
        @endif
    @endforeach

    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@500&display=swap" rel="stylesheet">
    <link href="{{ asset('css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    {{--<link href="{{ asset('css/icons/fontawesome/styles.min.css') }}" rel="stylesheet" type="text/css">--}}
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/core.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/components.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/colors.css') }}" rel="stylesheet" type="text/css">
    {{--<link href="{{ asset('css/bootstrap-switch.css') }}" rel="stylesheet">--}}
    {{--<link href="{{ asset('css/bootstrap-toggle.min.css') }}" rel="stylesheet">--}}

    <link href="{{ asset('css/loader.css') }}" rel="stylesheet" type="text/css">
    {{--<link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet" type="text/css">--}}
    {{--<link href="{{ asset('css/owl.theme.default.min.css') }}" rel="stylesheet" type="text/css">--}}
    <link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css">

    <!-- Core JS files -->
    <script type="text/javascript" src="{{ asset('js/core/libraries/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/core/libraries/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/loaders/blockui.min.js') }}"></script>
    <!-- /core JS files -->

    {{--<script type="text/javascript" src="{{ asset('js/plugins/forms/styling/uniform.min.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('js/plugins/forms/styling/bootstrap-switch.js') }}"></script>--}}

    {{--<script type="text/javascript" src="{{ asset('js/plugins/ui/moment/moment.min.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('js/plugins/pickers/daterangepicker.js') }}"></script>--}}

    {{--<script type="text/javascript" src="{{ asset('js/plugins/pickers/anytime.min.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('js/plugins/pickers/pickadate/picker.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('js/plugins/pickers/pickadate/picker.date.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('js/plugins/pickers/pickadate/picker.time.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('js/plugins/pickers/pickadate/legacy.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('js/pages/picker_date.js') }}"></script>--}}

    {{--<script type="text/javascript" src="{{ asset('js/plugins/tables/datatables/datatables.min.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('js/plugins/forms/selects/select2.min.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('js/plugins/media/fancybox.min.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('js/pages/datatables_basic.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('js/pages/components_thumbnails.js') }}"></script>--}}

    {{--<script type="text/javascript" src="{{ asset('js/core/main.controls.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('js/scrollreveal.min.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('js/jquery.easing.1.3.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('js/jquery.maskedinput.min.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('js/core/libraries/jquery_ui/widgets.min.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('js/core/libraries/jquery_ui/touch.min.js') }}"></script>--}}
{{--    <script type="text/javascript" src="{{ asset('js/plugins/sliders/slider_pips.min.js') }}"></script>--}}
{{--    <script type="text/javascript" src="{{ asset('js/plugins/forms/styling/switchery.min.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('js/core/app.js') }}"></script>--}}

    <script type="text/javascript" src="{{ asset('js/loader.js') }}"></script>
    {{--<script type="text/javascript" src="{{ asset('js/owl.carousel.js') }}"></script>--}}
{{--    <script type="text/javascript" src="{{ asset('js/preview_image.js') }}"></script>--}}
    <script type="text/javascript" src="{{ asset('js/max_height.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/main.js?').Helper::randHash() }}"></script>
</head>
<body>
@include('layouts._message_modal_block')

<!-- Main navbar -->
<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="/">
            <img src="{{ asset('images/logo.svg') }}" alt="{{ $data['seo']['title'] }}">
            <div>{{ $data['seo']['title'] }}</div>
        </a>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <li class="dropdown language-switch">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('images/'.(App::getLocale() == 'en' ? 'eng' : 'rus').'.png') }}" class="position-left">
                        {{ App::getLocale() == 'en' ? trans('content.en') : trans('content.ru') }}
                        <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu">
                        <li><a href="{{ url('/change-lang?lang=en') }}" class="english"><img src="{{ asset('images/eng.png') }}" alt="{{ trans('content.en') }}"> {{ trans('content.en') }}</a></li>
                        <li><a href="{{ url('/change-lang?lang=ru') }}" class="russian"><img src="{{ asset('images/rus.png') }}" alt="{{ trans('content.ru') }}"> {{ trans('content.ru') }}</a></li>
                    </ul>
                </li>

                @if (!Auth::guest())
                    <li class="dropdown dropdown-user">
                        <a class="dropdown-toggle" data-toggle="dropdown">
                            <span>{{ Auth::user()->email }}</span>
                            <i class="caret"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-right">
                            <li><a href="{{ url('/logout') }}"><i class="icon-switch2"></i> {{ trans('auth.logout') }}</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>
<!-- /main navbar -->

<!-- Page header -->
<div class="page-header">
    <div class="breadcrumb-line">
        <ul class="breadcrumb">
            <li><a href="{{ url('/') }}"><i class="icon-home2 position-left"></i>{{ trans('content.home_page') }}</a></li>
            <?php
                $bcCounter = 0;
                $lastCrumb = '';
            ?>
            @foreach ($breadcrumbs as $href => $crumb)
                <?php
                    $bcCounter++;
                    $lastCrumb = $crumb;
                ?>
                <li {{ $bcCounter == count($breadcrumbs)-1 ? 'class=active' : '' }}><a href="{{ url('/'.$href) }}">{{ strip_tags($crumb) }}</a></li>
            @endforeach
        </ul>

        <ul class="breadcrumb-elements">
            @if (Auth::guest())
                <li><a href="{{ url('login') }}"><i class="icon-enter3 position-left"></i> {{ trans('auth.login') }}</a></li>
                <li><a href="{{ url('register') }}"><i class="icon-user-plus position-left"></i> {{ trans('auth.register') }}</a></li>
            @endif
            {{--<li class="dropdown">--}}
                {{--<a href="#" class="dropdown-toggle" data-toggle="dropdown">--}}
                    {{--<i class="icon-gear position-left"></i>--}}
                    {{--Settings--}}
                    {{--<span class="caret"></span>--}}
                {{--</a>--}}

                {{--<ul class="dropdown-menu dropdown-menu-right">--}}
                    {{--<li><a href="#"><i class="icon-user-lock"></i> Account security</a></li>--}}
                    {{--<li><a href="#"><i class="icon-statistics"></i> Analytics</a></li>--}}
                    {{--<li><a href="#"><i class="icon-accessibility"></i> Accessibility</a></li>--}}
                    {{--<li class="divider"></li>--}}
                    {{--<li><a href="#"><i class="icon-gear"></i> All settings</a></li>--}}
                {{--</ul>--}}
            {{--</li>--}}
        </ul>
    </div>

    <div class="page-header-content">
        <div class="page-title">
            <h1>
                <span class="part1">{{ trans('content.head_part1') }}</span>
                <span class="part2">{{ trans('content.head_part2') }}</span>
                <span class="part3">{{ trans('content.head_part3') }}</span>
            </h1>
        </div>

        {{--<div class="heading-elements">--}}
            {{--<div class="heading-btn-group">--}}
                {{--<a href="#" class="btn btn-link btn-float text-size-small has-text"><i class="icon-bars-alt text-indigo-400"></i><span>Statistics</span></a>--}}
                {{--<a href="#" class="btn btn-link btn-float text-size-small has-text"><i class="icon-calculator text-indigo-400"></i><span>Invoices</span></a>--}}
                {{--<a href="#" class="btn btn-link btn-float text-size-small has-text"><i class="icon-calendar5 text-indigo-400"></i><span>Schedule</span></a>--}}
            {{--</div>--}}
        {{--</div>--}}
    </div>
</div>
<!-- /page header -->

<!-- Page container -->
<div class="page-container">
    <!-- Page content -->
    <div class="page-content">

        <!-- Main sidebar -->
        <div class="sidebar sidebar-main sidebar-default">
            <div class="sidebar-content">
                <div class="sidebar-user-material">
                    <div class="category-content">
                        <div class="sidebar-user-material-content text-center">
                            <img class="img-responsive" src="{{ asset('images/logo.jpg') }}">
                        </div>
                    </div>
                </div>

                <!-- Main navigation -->
                <div class="sidebar-category sidebar-category-visible">
                    <div class="category-content no-padding">
                        <ul class="navigation navigation-main navigation-accordion">
                            <!-- Main -->
                            @foreach ($mainMenu as $menu)
                                @if ($menu['href'] == '/')
                                    <li><a href="{{ url('/') }}"><i class="{{ $menu['icon'] }}"></i> <span>{{ str_limit($menu['name'], 20) }}</span></a></li>
                                @else
                                    @include('layouts._menu_item_block', ['menu' => $menu, 'prefix' => null])
                                @endif
                            @endforeach

                            @if (Helper::isAdmin())
                                <li class="navigation-header"><span>{{ trans('menu.admin_menu') }}</span> <i class="icon-menu" title="" data-original-title="{{ trans('menu.admin_menu') }}"></i></li>
                                @foreach ($adminMenu as $menu)
                                    @include('layouts._menu_item_block', ['menu' => $menu, 'prefix' => 'admin/'])
                                @endforeach
                            @endif
                        </ul>
                    </div>
                </div>
                <!-- /main navigation -->
                <!-- Calendar -->
                <hr>
                <h2 class="panel-heading">{{ trans('content.events_calendar') }}</h2>
                <div class="panel-body">
                    <?php $week = 1; ?>
                    @for($month=1;$month<=12;$month++)
                        <?php
                        $weeksOnMonth = 1;
                        for($d=1;$d<=cal_days_in_month(CAL_GREGORIAN, $month, date('Y'));$d++) {
                            if ($d > 1 && date('N', strtotime($month.'/'.$d.'/'.date('Y'))) == 1) $weeksOnMonth++;
                        }
                        ?>
                        <table id="month_{{ $month }}" class="calendar single-height {{ $month != date('n') && $month != date('n')+1 ? 'hidden' : ''}}">
                            <tr>
                                <th class="arrow backward">
                                    @if ($month != 1)
                                        <i class="icon-backward2"></i>
                                    @endif
                                </th>
                                <th colspan="6" class="month">{{ trans('calendar.m'.$month) }}</th>
                                <th class="arrow forward">
                                    @if ($month != 12)
                                        <i class="icon-forward3"></i>
                                    @endif
                                </th>
                            </tr>
                            <tr>
                                @for($wd=0;$wd<=7;$wd++)
                                    <th>{{ $wd ? trans('calendar.d'.$wd) : '' }}</th>
                                @endfor
                            </tr>
                            <?php $day = 0; ?>
                            @for($w=1;$w<=$weeksOnMonth;$w++)
                                <tr>
                                    @for($wd=0;$wd<=7;$wd++)
                                        @if(!$wd)
                                            <td><b>{{ $week }}</b></td>
                                        @else
                                            <?php if ($w == 1 && $wd == date('N', strtotime($month.'/1/'.date('Y')))) $day = 1; ?>
                                            <td>
                                                @if ($day && $day <= cal_days_in_month(CAL_GREGORIAN, $month, date('Y')))
                                                <?php $incrementWeek = true; ?>
                                                    {{ $day }}
                                                @else
                                                    <?php $incrementWeek = false; ?>
                                                @endif
                                            </td>
                                        @endif
                                        <?php if ($day && $wd) $day++; ?>
                                    @endfor
                                </tr>
                                <?php if ($incrementWeek) $week++; ?>
                            @endfor
                        </table>
                    @endfor
                </div>
            </div>
        </div>
        <!-- /main sidebar -->
        <!-- Main content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /main content -->

    </div>
    <!-- /page content -->
</div>
<!-- /page container -->

<!-- Footer -->
<div class="navbar navbar-default navbar-fixed-bottom footer">
    <ul class="nav navbar-nav visible-xs-block">
        <li><a class="text-center collapsed" data-toggle="collapse" data-target="#footer"><i class="icon-circle-up2"></i></a></li>
    </ul>

    <div class="navbar-collapse collapse" id="footer">
        <div class="navbar-text">
            &copy; 2020. <a href="#" class="navbar-link" target="_blank">{{ trans('content.official_support') }}</a>
        </div>

        <div class="navbar-right hidden-sm">
            <ul class="nav navbar-nav">
                <li><a href="/">{{ trans('content.home_page') }}</a></li>
                @foreach ($mainMenu as $menu)
                    <li><a href="{{ url($menu['href']) }}">{{ $menu['name'] }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<!-- /footer -->

</body>
</html>
