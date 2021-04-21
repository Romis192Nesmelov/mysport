<div class="col-md-{{ $blindVer ? '4' : '3' }} col-sm-{{ $blindVer ? '6' : '4' }} col-xs-12 calendar-container">
    @include('_header_block', [
        'tagName' => 'h2',
        'icon' => 'icon_date',
        'head' => trans('content.the_calendar_of_sports_events')
    ])
    @include('_calendar_block',[
        'year' => $data['year'],
        'events' => $data['events_on_year']
    ])
</div>