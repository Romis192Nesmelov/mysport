<div class="col-md-4 col-sm-6 col-xs-12" {{ $gallery ? 'id=gallery_'.$gallery->id : '' }}>
    <div class="panel panel-flat gallery-photo">
        <div class="panel-body">
            @if ($gallery)
                <div class="icon-delete"><span del-data="{{ $gallery->id }}" modal-data="delete-gallery-modal" class="glyphicon glyphicon-remove-circle"></span></div>
            @endif
            @include('_image_block', [
                'col' => 12,
                'label' => trans('content.image'),
                'preview' => $gallery ? $gallery->photo : '',
                'full' => $gallery ? $gallery->photo : '',
                'name' => $gallery ? 'photo'.$gallery->id : 'add_photo',
                'placeholder' => asset('images/placeholder.jpg')
            ])
        </div>
    </div>
</div>