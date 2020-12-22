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
    <link href="{{ asset('css/icons/fontawesome/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/core.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/components.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/colors.css') }}" rel="stylesheet" type="text/css">
{{--    <link href="{{ asset('css/bootstrap-switch.css') }}" rel="stylesheet">--}}
    {{--<link href="{{ asset('css/bootstrap-toggle.min.css') }}" rel="stylesheet">--}}

    <link href="{{ asset('css/loader.css') }}" rel="stylesheet" type="text/css">
    {{--<link href="{{ asset('css/owl.carousel.min.css') }}" rel="stylesheet" type="text/css">--}}
    {{--<link href="{{ asset('css/owl.theme.default.min.css') }}" rel="stylesheet" type="text/css">--}}
    <link href="{{ asset('css/calendar.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/main.css') }}" rel="stylesheet" type="text/css">

    <!-- Core JS files -->
    <script type="text/javascript" src="{{ asset('js/core/libraries/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/core/libraries/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/loaders/blockui.min.js') }}"></script>
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
    <script type="text/javascript" src="{{ asset('js/plugins/forms/selects/select2.min.js') }}"></script>
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
{{--    <script type="text/javascript" src="{{ asset('js/core/app.js') }}"></script>--}}
    <script type="text/javascript" src="{{ asset('js/core/main.controls.js') }}"></script>

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

<!-- Second navbar -->
<div class="navbar navbar-default" id="navbar-second">
    <ul class="nav navbar-nav no-border visible-xs-block">
        <li><a class="text-center collapsed" data-toggle="collapse" data-target="#navbar-second-toggle"><i class="icon-menu7"></i></a></li>
    </ul>

    <div class="navbar-collapse collapse" id="navbar-second-toggle">
        <ul class="nav navbar-nav">
            <li {{ Request::path() == '/' ? 'class=active' : '' }}><a href="{{ url('/') }}"><i class="icon-home2 position-left"></i>{{ trans('content.home_page') }}</a></li>
            @foreach ($mainMenu as $menu)
                @include('layouts._menu_item_block', ['menu' => $menu, 'prefix' => null])
            @endforeach
        </ul>
        <ul class="nav navbar-nav navbar-right">
            @if (Auth::guest())
                <li><a href="{{ url('login') }}"><i class="icon-enter3 position-left"></i> {{ trans('auth.login') }}</a></li>
                <li><a href="{{ url('register') }}"><i class="icon-user-plus position-left"></i> {{ trans('auth.register') }}</a></li>
            @endif
        </ul>
    </div>
</div>
<!-- /second navbar -->

<!-- Page header -->
<div class="page-header">
    <div class="page-header-content">
        <div class="page-title table">
            <div class="table-cell"><img width="90" src="{{ asset('images/logo.png') }}" /></div>
            <div class="table-cell">
                <h1><span class="my">{{ trans('content.head_part1') }}</span>{{ trans('content.head_part2') }}<span class="sptb">{{ trans('content.head_part3') }}</span></h1>
                <ul class="breadcrumb breadcrumb-caret">
                    <li><a href="{{ url('/') }}"><i class="icon-home2 position-left"></i>{{ trans('content.home_page') }}</a></li>
                    @php
                    $bcCounter = 0;
                    $lastCrumb = '';
                    @endphp
                    @foreach ($breadcrumbs as $href => $crumb)
                        <?php
                        $bcCounter++;
                        $lastCrumb = $crumb;
                        ?>
                        <li {{ $bcCounter == count($breadcrumbs)-1 ? 'class=active' : '' }}><a href="{{ url('/'.$href) }}">{{ strip_tags($crumb) }}</a></li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="heading-elements">
            <div class="heading-btn-group">
                <a href="#" class="btn btn-link btn-float has-text"><i class="icon-hammer-wrench text-primary"></i><span>{{ trans('menu.tech_support') }}</span></a>
                <a href="#" class="btn btn-link btn-float has-text"><i class="icon-calendar2 text-primary"></i> <span>{{ trans('menu.my_scheduler') }}</span></a>
                <a href="#" class="btn btn-link btn-float has-text"><i class="icon-cogs text-primary"></i> <span>{{ trans('menu.my_setting') }}</span></a>
            </div>
        </div>
    </div>
</div>
<!-- /page header -->

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
<div class="navbar navbar-default navbar-fixed-bottom footer">
    <ul class="nav navbar-nav visible-xs-block">
        <li><a class="text-center collapsed" data-toggle="collapse" data-target="#footer"><i class="icon-circle-up2"></i></a></li>
    </ul>

    <div class="navbar-collapse collapse" id="footer">
        <div class="navbar-text">&copy; 2020. <a href="#" class="navbar-link" target="_blank">{{ trans('content.official_support') }}</a></div>
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
