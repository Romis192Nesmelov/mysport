<div class="col-md-{{ isset($col) ? $col : '3' }} col-sm-{{ isset($col) ? $col : '3' }} col-xs-12">
    @include('_image_block', [
        'label' => trans('content.image'),
        'preview' => $item ? (isset($imageName) ? $item[$imageName] : $item->image) : '',
        'name' => isset($imageName) ? $imageName : 'image',
        'placeholder' => asset('images/placeholder.jpg')
    ])

    @include('_checkbox_block',[
        'col' => 12,
        'label' => trans('admin.'.$objectName.'_active'),
        'name' => 'active',
        'checked' => $item ? $item->active : true
    ])
</div>