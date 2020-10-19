<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        {{ Settings::getSeoTags()['title'].'. ' }}
        <?php
        switch (Request::path()) {
            case 'login':
                echo trans('auth.login');
                break;

            case 'register':
                echo trans('auth.register');
                break;

            default:
                echo trans('auth.reset_password');
                break;
        }
        ?>
    </title>

    <!-- Global stylesheets -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700,900" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/icons/icomoon/styles.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/icons/fontawesome/styles.min.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/bootstrap.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/bootstrap-switch.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bootstrap-toggle.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/core.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/components.css') }}" rel="stylesheet" type="text/css">

    <link href="{{ asset('css/colors.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/main.css').Helper::randHash() }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/collage.css').Helper::randHash() }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('css/auth.css').Helper::randHash() }}" rel="stylesheet" type="text/css">
    <!-- /global stylesheets -->

    <script src="https://www.google.com/recaptcha/api.js?hl={{ App::getLocale() }}" async defer></script>

    <!-- Core JS files -->
    <script type="text/javascript" src="{{ asset('js/core/libraries/jquery.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/core/libraries/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/forms/styling/bootstrap-switch.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.maskedinput.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/plugins/loaders/blockui.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/core/main.controls.js') }}"></script>
{{--    <script type="text/javascript" src="{{ asset('js/core/app.js') }}"></script>--}}
    <!-- /core JS files -->

    <!-- Theme JS files -->
    <script type="text/javascript" src="{{ asset('js/plugins/forms/styling/uniform.min.js') }}"></script>
    {{--<script type="text/javascript" src="{{ asset('js/collage.js?').Helper::randHash() }}"></script>--}}
</head>

<body>
@include('layouts._message_modal_block')

<div id="main-image">
    @include('layouts._lang_container_block')
    @include('layouts._base_collage_layers_block')
    <div class="layer layer4">
        <h1>
            <?php
            switch (Request::path()) {
                case 'login':
                    echo trans('auth.login_in');
                    break;

                case 'register':
                    echo trans('auth.register');
                    break;

                default:
                    echo trans('auth.reset_password');
                    break;
            }
            ?>
        </h1>
    </div>
    @yield('content')
    <div class="shadow"></div>
</div>

<script> $('input[name=phone]').mask("+7(999)999-99-99");</script>

</body>
</html>