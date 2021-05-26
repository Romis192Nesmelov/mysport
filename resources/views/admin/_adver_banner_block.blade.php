<div class="col-md-{{ $col }} col-sm-12 col-xs-12 no-resize">
    <div class="panel panel-flat">
        <div class="panel-body">
            @include('_image_block', [
                'preview' => asset('images/banner'.$num.'.jpg'),
                'full' => asset('images/banner'.$num.'.jpg'),
                'name' => 'banner'.$num,
                'placeholder' => asset('images/placeholder.jpg')
            ])
        </div>
    </div>
</div>