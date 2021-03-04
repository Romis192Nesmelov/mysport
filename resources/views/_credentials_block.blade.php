<div class="col-md-{{ $colMd }} col-sm-{{ $colSm }} col-xs-12" {{ isset($scroll) && $scroll ? 'data-scroll-destination='.$scroll : '' }}>
    <div class="description">{{ $description }}</div>
    <div class="credential">
        @if (isset($href))
            <a href="{{ isset($blank) && $blank ? $href : url($href) }}" {{ isset($blank) && $blank ? 'target=_blank' : '' }}>{{ $credential }}</a>
        @else
            {!! $credential !!}
        @endif
    </div>
</div>