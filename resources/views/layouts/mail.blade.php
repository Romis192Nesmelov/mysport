{{--<!DOCTYPE html>--}}
{{--<html>--}}
{{--<head>--}}
    {{--<meta charset="utf-8">--}}
    {{--<meta http-equiv="x-ua-compatible" content="ie=edge">--}}
    {{--<meta name="viewport" content="width=device-width, initial-scale=1.0">--}}
{{--</head>--}}
{{--<body>--}}
<div style="background-color:#f8fafc; box-sizing:border-box; color:#74787e; height:100%; line-height:1.4; margin:0; width:100% !important; word-break:break-word;">
    <table class="wrapper" cellpadding="0" cellspacing="0" width="100%" style="background-color:#f8fafc;box-sizing:border-box;margin:0;padding:0;width:100%">
        <tr>
            <td align="center" style="box-sizing:border-box">
                <table class="econtent" cellpadding="0" cellspacing="0" width="100%" style="box-sizing:border-box;margin:0;padding:0;width:100%">
                    <tr>
                        <td class="header" style="box-sizing: border-box; padding:25px 0 25px 0; text-align:center">
                            <a href="{{ url('/') }}" style="box-sizing:border-box; color:#bbbfc3; font-size:19px; font-weight:bold; text-decoration:none" target="_blank" rel="noopener noreferrer">{{ Config::get('app.name') }}</a>
                        </td>

                    </tr>
                    <tr>
                        <td class="body" width="100%" style="background-color:#ffffff; border-bottom-color:#edeff2; border-bottom-style:solid; border-bottom-width:1px; border-top-color:#edeff2; border-top-style:solid; border-top-width:1px; box-sizing:border-box; margin:0; padding:0; width:100%">
                            <table class="b7e28580226b0b79d1a0efe9e9476c6finner-body" align="center" cellpadding="0" cellspacing="0" style="background-color:#ffffff;box-sizing:border-box; margin:0 auto 0 auto;padding:0; width:570px;">
                                <tr>
                                    <td class="content-cell" style="box-sizing:border-box;padding:35px;">
                                        @yield('content')
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="box-sizing:border-box">
                            <table class="footer" align="center" cellpadding="0" cellspacing="0" style="box-sizing:border-box;margin:0 auto 0 auto; padding:0; text-align:center; width:570px;">
                                <tr>
                                    <td class="content-cell" align="center" style="box-sizing:border-box;padding:35px">
                                        <p style="box-sizing:border-box; color:#aeaeae;font-size:12px; line-height:1.5em; margin-top:0; text-align:center;">© @lang('All Rights Reserved Retimo d.o.o.') {{ date('Y') }}.</p>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</div>
{{--</body>--}}
{{--</html>--}}