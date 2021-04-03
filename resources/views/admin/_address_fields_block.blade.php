@include('_input_block',[
    'star' => true,
    'label' => trans('content.address'),
    'type' => 'text',
    'name' => 'address_ru',
    'placeholder' => trans('content.address'),
    'value' => isset($data['item']) ? $data['item']->address_ru : ''
])

@include('_input_block',[
    'star' => true,
    'label' => trans('content.latitude'),
    'type' => 'text',
    'name' => 'latitude',
    'placeholder' => trans('content.coords_placeholder'),
    'value' => isset($data['item']) ? Helper::addCoordinatesZero($data['item']->latitude) : ''
])

@include('_input_block',[
    'star' => true,
    'label' => trans('content.longitude'),
    'type' => 'text',
    'name' => 'longitude',
    'placeholder' => trans('content.coords_placeholder'),
    'value' => isset($data['item']) ? Helper::addCoordinatesZero($data['item']->longitude) : ''
])