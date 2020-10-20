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
    {{--<script type="text/javascript" src="{{ asset('js/max_height.js') }}"></script>--}}
    <script type="text/javascript" src="{{ asset('js/main.js?').Helper::randHash() }}"></script>
</head>
<body>
@include('layouts._message_modal_block')

<!-- Main navbar -->
<div class="navbar navbar-inverse">
    <div class="navbar-header">
        <a class="navbar-brand" href="/">{{ $data['seo']['title'] }}</a>
    </div>

    <div class="navbar-collapse collapse" id="navbar-mobile">
        <div class="navbar-right">
            <ul class="nav navbar-nav">
                <li class="dropdown language-switch">
                    <a class="dropdown-toggle" data-toggle="dropdown">
                        <img src="{{ asset('images/'.(App::getLocale() == 'en' ? 'eng' : 'rus').'.png') }}" class="position-left">
                        {{ App::getLocale() == 'en' ? 'English' : 'Русский' }}
                        <span class="caret"></span>
                    </a>

                    <ul class="dropdown-menu">
                        <li><a href="{{ url('/change-lang?lang=en') }}" class="english"><img src="{{ asset('images/eng.png') }}" alt="{{ trans('content.en') }}"> {{ trans('content.en') }}</a></li>
                        <li><a href="{{ url('/change-lang?lang=ru') }}" class="russian"><img src="{{ asset('images/rus.png') }}" alt="{{ trans('content.ru') }}"> {{ trans('content.ru') }}</a></li>
                    </ul>
                </li>

                {{--<li class="dropdown dropdown-user">--}}
                    {{--<a class="dropdown-toggle" data-toggle="dropdown">--}}
                        {{--<span>{{ Auth::user()->email }}</span>--}}
                        {{--<i class="caret"></i>--}}
                    {{--</a>--}}
            {{----}}
                    {{--<ul class="dropdown-menu dropdown-menu-right">--}}
                        {{--<li><a href="{{ url('/logout') }}"><i class="icon-switch2"></i> {{ trans('auth.logout') }}</a></li>--}}
                    {{--</ul>--}}
                {{--</li>--}}
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
                <li><a href="{{ url('login') }}"><i class="icon-enter3 position-left"></i> {{ trans('auth.login').'/'.trans('auth.register') }}</a></li>
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
            <h4>
                <i class="icon-arrow-left52 position-left"></i>
                <span class="text-semibold">{{ $lastCrumb ? $lastCrumb : trans('content.home_page') }}</span>
                @if (!Auth::guest())
                    <small>{{  Auth::user()->name }}</small>
                @endif
            </h4>
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
                                    <li {{ preg_match('/^('.str_replace('/','\/',$menu['href']).')/', Request::path()) ? 'class=active' : '' }}>
                                        <a href="{{ url($menu['href']) }}"><i class="{{ $menu['icon'] }}"></i> <span>{{ str_limit($menu['name'], 20) }}</span></a>
                                        @if (isset($menu['submenu']) && count($menu['submenu']))
                                            <ul>
                                                @foreach ($menu['submenu'] as $submenu)
                                                    <?php
                                                    $addAttrStr = '';
                                                    if (isset($submenu['addAttr']) && count($submenu['addAttr']) ) {
                                                        foreach ($submenu['addAttr'] as $attr => $val) {
                                                            $addAttrStr .= $attr.'="'.$val.'"';
                                                        }
                                                    }
                                                    ?>
                                                    <li {{ (preg_match('/^(admin\/'.str_replace('/','\/',$menu['href'].'/'.$submenu['href']).')/', Request::path())) /*|| (Request::path() == 'admin/products' && Request::has('id') && Request::input('id') == (int)str_replace('?id=','',$submenu['href']))*/ ? 'class=active' : '' }}>
                                                        <a href="{{ url('/admin/'.$menu['href'].'/'.$submenu['href']) }}" {!! $addAttrStr !!}>{{ str_limit($submenu['name'], 20) }}</a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                </div>
                <!-- /main navigation -->
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

        <div class="navbar-right">
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
