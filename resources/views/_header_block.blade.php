<div class="header">
    <div>
        <img class="icon" src="{{ asset('images/'.$icon.'.svg') }}" />
        {!! '<'.$tagName.'>'.$head.'</'.$tagName.'>' !!}
        @if (isset($image) && $image)
            <img class="header-image" src="{!! $image !!}" />
        @endif
    </div>
    @if (isset($button))
        <a class="button {{ $button['class'] }}" href="{{ url($button['href']) }}">{{ $button['text'] }}</a>
    @endif
</div>
