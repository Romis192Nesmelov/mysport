@include('_header_block', [
    'tagName' => 'h1',
    'head' => trans('content.information'),
    'addClass' => isset($secondHead) && $secondHead ? 'second' : ''
])

@include('_input_block',[
    'label' => trans('content.user_name'),
    'type' => 'text',
    'name' => 'name',
    'value' => $user ? $user->name : ''
])

@include('_input_block',[
    'label' => trans('content.surname'),
    'type' => 'text',
    'name' => 'surname',
    'value' => $user ? $user->surname : ''
])

@include('_input_block',[
    'label' => trans('content.family'),
    'type' => 'text',
    'name' => 'family',
    'value' => $user ? $user->family : ''
])

@include('_input_block',[
    'label' => trans('content.born_date'),
    'type' => 'text',
    'name' => 'born',
    'placeholder' => trans('content.date_placeholder'),
    'value' => $user && $user->born ? date('d.m.Y',$user->born) : ''
])