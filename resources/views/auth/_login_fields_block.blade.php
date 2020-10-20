@include('_input_block',['name' => 'email', 'type' => 'email', 'placeholder' => 'E-mail', 'icon' => 'icon-user'])
@include('_input_block',['name' => 'password', 'type' => 'password', 'placeholder' => trans('auth.password'), 'icon' => 'icon-lock2'])
@include('auth._re_captcha_block')
<div class="form-group login-options">
    <div class="row">
        <table>
            <tr>
                <td valign="middle" align="left">@include('_checkbox_block', ['name' => 'remember', 'checked' => true, 'label' => trans('auth.remember_me')])</td>
                <td valign="middle" align="right"><a href="{{ url('/password/reset') }}">{{ trans('auth.forgot_your_password') }}</a></td>
            </tr>
        </table>
        <div class="col-md-12 col-sm-12 col-xs-12 text-center" style="margin-top: 15px;">
            <a href="{{ url('/send-confirm') }}">{{ trans('auth.re_confirmation') }}</a>
        </div>
    </div>
</div>