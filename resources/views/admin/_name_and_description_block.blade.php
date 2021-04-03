@include('_input_block', [
    'star' => true,
    'label' => trans('content.name'),
    'name' => 'name_ru',
    'type' => 'text',
    'max' => 255,
    'placeholder' => trans('content.name'),
    'value' => isset($data['item']) ? $data['item']->name_ru : ''
])

@include('_textarea_block', [
    'star' => true,
    'label' => trans('content.description'),
    'name' => 'description_ru',
    'max' => 500,
    'simple' => isset($simple) ? $simple : false,
    'value' => isset($data['item']) ? $data['item']->description_ru : ''
])