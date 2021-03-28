<div class="col-md-8 col-sm-{{ $blindVer ? '12' : '8' }} col-xs-12 pull-right">
    <div class="rounded-block gray right-block {{ isset($addClass) && $addClass ? $addClass : '' }}">{!! $content !!}</div>
    @if (isset($useMap) && $useMap)
        <div id="map" class="rounded-block" data-scroll-destination="map"></div>
    @endif
</div>