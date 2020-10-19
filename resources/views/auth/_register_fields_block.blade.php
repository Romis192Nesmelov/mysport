@include('_input_block',['name' => 'phone', 'type' => 'tel', 'placeholder' => '+7(___)___-__-__', 'icon' => 'glyphicon glyphicon-phone'])
@include('_input_block',['name' => 'email', 'type' => 'email', 'placeholder' => 'E-mail', 'icon' => 'icon-user'])
@include('_input_block',['name' => 'password', 'type' => 'password', 'placeholder' => trans('auth.password'), 'icon' => 'icon-lock2'])
@include('_input_block',['name' => 'password_confirmation', 'type' => 'password', 'placeholder' => trans('auth.password_confirm'), 'icon' => 'icon-lock2'])
@include('_radio_simple_block',[
    'addClass' => 'user-type',
    'name' => 'type',
    'checked' => 2,
    'data' => [
        ['value' => 2, 'label' => trans('auth.i_employee')],
        ['value' => 3, 'label' => trans('auth.i_employer')],
    ]
])

@include('auth._re_capcha_block')