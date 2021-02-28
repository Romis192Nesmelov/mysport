<div class="header">
    <div>
        @if (isset($icon) && $icon)
            <img class="icon" src="{{ asset('images/'.$icon.'.svg') }}" />
        @endif
        {!! '<'.$tagName.'>'.$head.'</'.$tagName.'>' !!}
        @if (isset($image) && $image)
            <img class="header-image" src="{!! $image !!}" />
        @endif
    </div>
    @if (isset($button))
        <a class="button {{ $button['class'] }}" href="{{ url($button['href']) }}">{{ $button['text'] }}</a>
    @endif
</div>
