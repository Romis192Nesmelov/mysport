@if ($content)
    <div class="content-block">
        <div class="description">{{ $description }}</div>
        @if (isset($useParagraph) && $useParagraph)
            <p>{{ $content }}</p>
        @else
            {!! $content !!}
        @endif
    </div>
@endif