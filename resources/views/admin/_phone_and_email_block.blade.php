@include('_input_block', [
    'star' => true,
    'label' => trans('content.phone'),
    'name' => 'phone',
    'type' => 'tel',
    'placeholder' => trans('content.phone'),
    'value' => isset($data['item']) ? $data['item']->phone : '',
 ])

@include('_input_block', [
    'star' => true,
    'label' => 'E-mail:',
    'name' => 'email',
    'type' => 'email',
    'max' => 100,
    'placeholder' => 'E-mail:',
    'value' => isset($data['item']) ? $data['item']->email : '',
])