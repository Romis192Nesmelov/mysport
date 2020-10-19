<div class="col-md-{{ isset($col) ? $col : '3' }} col-sm-{{ isset($col) ? $col : '3' }} col-xs-12">
    <div class="panel panel-flat {{ isset($addClass) ? $addClass : '' }}">
        @include('_panel_title_block',['title' => isset($label) ? $label : trans('content.image'),'h' => 6])
        <div class="panel-body edit-image-preview">
            @if (isset($preview) && $preview)
                @if (isset($full) && $full)
                    <a class="img-preview" href="{{ asset($full) }}">
                @endif
                    <img src="{{ asset($preview.'?'.Helper::randHash()) }} }}" />
                @if (isset($full) && $full)
                    </a>
                @endif
            @else
                <img src="{{ isset($placeholder) && $placeholder ? $placeholder : asset('images/placeholder.jpg') }}" />
            @endif
            @include('_input_file_block', ['label' => '', 'name' =>  isset($name) && $name ? $name : 'image'])
        </div>
    </div>
</div>