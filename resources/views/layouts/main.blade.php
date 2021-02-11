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

    {{--<link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">--}}
    <link href="https://fonts.googleapis.com/css2?family=Rubik:wght@500&display=swap" rel="stylesheet">
    <link href="{{ asset('css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    {{--<link href="{{ asset('css/icons/fontawesome/styles.min.css') }}" rel="stylesheet" type="text/css">--}}
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/core.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/components.css') }}" rel="stylesheet" type="text/css">
    {{--<link href="{{ asset('css/colors.css') }}" rel="stylesheet" type="text/css">--}}
    <link href="{{ asset('css/bootstrap-switch.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-toggle.min.css') }}" rel="stylesheet">

    <link href="{{ asset('css/loader.css') }}" rel="stylesheet" type="text/css">
    {{--<link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet" type="text/css">--}}
    {{--<link href="{{ asset('css/owl.theme.default.min.css') }}" rel="stylesheet" type="text/css">--}}
    <link href="{{ asset('css/calendar.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css">

    <!-- Core JS files -->
    <script type="text/javascript" src="{{ asset('js/core/libraries/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/core/libraries/bootstrap.min.js') }}"></script>
{{--    <script type="text/javascript" src="{{ asset('js/plugins/loaders/blockui.min.js') }}"></script>--}}
    <!-- /core JS files -->

    <script type="text/javascript" src="{{ asset('js/plugins/forms/styling/uniform.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/forms/styling/bootstrap-switch.js') }}"></script>

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
    <script type="text/javascript" src="{{ asset('js/scrollreveal.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.easing.1.3.js') }}"></script>
    {{--<script type="text/javascript" src="{{ asset('js/jquery.maskedinput.min.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('js/core/libraries/jquery_ui/widgets.min.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('js/core/libraries/jquery_ui/touch.min.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('js/plugins/sliders/slider_pips.min.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('js/plugins/forms/styling/switchery.min.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('js/core/app.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('js/core/main.controls.js') }}"></script>--}}

    <script type="text/javascript" src="{{ asset('js/loader.js') }}"></script>
    {{--<script type="text/javascript" src="{{ asset('js/owl.carousel.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('js/preview_image.js') }}"></script>--}}
    {{--<script type="text/javascript" src="{{ asset('js/max_height.js') }}"></script>--}}
    <script type="text/javascript" src="{{ asset('js/main.js?').Helper::randHash() }}"></script>
</head>
<body>
{{--@include('layouts._message_modal_block')--}}

<!-- Top navbar -->
<div class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-logo">
            <a class="navbar-brand" href="/">
                <img src="{{ asset('images/logo.svg') }}" alt="{{ $data['seo']['title'] }}">
                <div>{{ trans('content.head_part1').trans('content.head_part2').trans('content.head_part3') }}</div>
            </a>
        </div>

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
                @foreach($topMenu as $top)
                    <li class="button {{ isset($top['addClass']) ? $top['addClass'] : '' }}"><a href="{{ $top['href'] }}">{{ $top['name'] }}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</div>
<!-- /top navbar -->

<div class="container">
    <div class="col-md-4 col-sm-12 col-xs-12 logo-container">
        @include('layouts._logo_block',['tagName' => 'h1', 'withSpan' => true])
    </div>
    <div class="col-md-8 col-sm-12 col-xs-12 menu-container">
        <div class="over-menu hidden-xs">
            <div class="line-menu">
                {{ trans('menu.select_area') }}
                <select name="area" class="type1">
                    @foreach($areas as $k => $area)
                        <option value="{{ $k+1 }}">{{ $area }}</option>
                    @endforeach
                </select>
                @include('layouts._soc_nets_block')
                <div class="button pull-right red small"><a data-scroll="map">{{ trans('menu.search') }}</a><i class="glyphicon glyphicon-search"></i></div>
            </div>
        </div>
        <!-- Main navbar -->
        <nav class="navbar navbar-default">
            <div class="navbar-header">
                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                    <i class="icon-arrow-down12"></i>
                </button>
            </div>
            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav">
                    @include('layouts._menu_items_block',['menu' => $mainMenu, 'start' => 0, 'end' => count($mainMenu), 'break' => false])
                </ul>
            </div>
        </nav>
        <!-- /main navbar -->
        <div class="line-menu hidden-xs">
            <div class="button pull-left gray1 small"><a data-scroll="#">{{ trans('menu.to_record') }}</a></div>
            <div class="button pull-left gray2"><a data-scroll="#">{{ trans('menu.create_a_training') }}</a></div>
            <div class="button pull-left green"><a data-scroll="#">{{ trans('menu.organize_an_event') }}</a></div>
        </div>
    </div>
</div>

<!-- Page container -->
<div class="page-container">
    <!-- Page content -->
    <div class="page-content">
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
<div class="footer">
    <div class="container">
        <div class="col-md-4 col-sm-6 col-xs-12">
            @include('layouts._logo_block',['tagName' => 'div', 'withSpan' => true])
        </div>
        <div class="col-md-5 hidden-sm hidden-xs">
            @php $divider = ceil(count($mainMenu)/2); @endphp
            <ul class="menu">
                @include('layouts._menu_items_block',['menu' => $mainMenu, 'start' => 0, 'end' => $divider, 'break' => true])
            </ul>
            <ul class="menu">
                @include('layouts._menu_items_block',['menu' => $mainMenu, 'start' => $divider, 'end' => count($mainMenu), 'break' => true])
            </ul>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12">
            <img id="hooks-logo" src="{{ asset('images/hooks_logo.png') }}" />
            <div class="copyright">
                {!! trans('content.footer_text') !!}
                <div>@include('layouts._soc_nets_block')</div>
            </div>
        </div>
    </div>
</div>
<!-- /footer -->

</body>
</html>
