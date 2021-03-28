<div class="col-md-{{ $blindVer ? $blindColMd : $colMd }} col-sm-{{ $blindVer ? $blindColSm : $colSm }} col-xs-12 event">
    <a href="{{ url((isset($prefix) ? '/'.$prefix : '').'/events/'.$event->slug) }}">
        <div class="button green">{{ date('j',Helper::setMoscowTimeZone($event->start_time)).' '.trans('months.'.date('m',$event->start_time)).' '.date('Y',$event->start_time).' '.date('G:i',Helper::setMoscowTimeZone($event->start_time)) }}</div>
        <h3>{{ $event['name_'.App::getLocale()] }}</h3>
        <p>{{ $event['description_'.App::getLocale()] }}</p>
    </a>
</div>