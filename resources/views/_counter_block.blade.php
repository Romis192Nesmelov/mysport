@if ($counter)
    @if ($scroll)
        <a data-scroll="{{ $scroll }}">{{ $counter }}</a>
    @elseif ($href)
        <a href="{{ url($href) }}">{{ $counter }}</a>
    @else
        {{ $counter }}
    @endif
@endif