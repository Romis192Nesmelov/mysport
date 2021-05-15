<div class="edit-image-preview">
    <div class="cir-image image">
        @if (isset($preview))
            @if (isset($full) && $full)
                <a class="img-preview" href="{{ asset($full) }}">
            @endif
                <img src="{{ asset($preview ? $preview.'?'.Helper::randHash() : 'images/placeholder.jpg') }}" />
            @if (isset($full) && $full)
                </a>
            @endif
        @else
            <img src="{{ isset($placeholder) && $placeholder ? $placeholder : asset('images/placeholder.jpg') }}" />
        @endif
    </div>
    @include('_input_file_block', ['label' => '', 'name' =>  isset($name) && $name ? $name : 'image'])
</div>