<div class="col-md-6 col-sm-12 col-xs-12">
    <div class="description input-label">{{ $description }}</div>
    @include('_image_block',[
        'name' => $name,
        'preview' => isset($data['user']) && $data['user']->trainer ? $data['user']->trainer[$name] : '',
        'full' => isset($data['user']) && $data['user']->trainer ? $data['user']->trainer[$name] : null,
    ])
</div>