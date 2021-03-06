<div class="col-md-8 col-sm-{{ $blindVer ? '12' : '8' }} col-xs-12">
    <div class="rounded-block gray right-block">{!! $content !!}</div>
    @if (isset($useMap) && $useMap)
        <div id="map" class="rounded-block" data-scroll-destination="map"></div>
    @endif
</div>