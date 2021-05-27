<div class="content-block col-md-6 col-sm-12 col-xs-12">
    <div class="description input-label">{{ $description }}</div>
    @include('_image_block',[
        'name' => $name,
        'preview' => Auth::user()->trainer ? Auth::user()->trainer[$name] : ''
    ])
</div>