@include('_input_block',['name' => 'email', 'type' => 'email', 'placeholder' => 'E-mail', 'icon' => 'icon-user', 'value' => $email])
@include('_input_block',['name' => 'password', 'type' => 'password', 'placeholder' => trans('auth.password'), 'icon' => 'icon-lock2'])
@include('_input_block',['name' => 'password_confirmation', 'type' => 'password', 'placeholder' => trans('auth.password_confirm'), 'icon' => 'icon-lock2'])
@include('auth._re_captcha_block')