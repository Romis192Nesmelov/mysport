<div class="col-md-{{ $colMd }} col-sm-{{ $colSm }} col-xs-12" {{ isset($scroll) && $scroll ? 'data-scroll-destination='.$scroll : '' }}>
    <div class="description">{{ $description }}</div>
    <div class="credential">{!! $credential !!}</div>
</div>