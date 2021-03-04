<div class="col-md-4 col-sm-{{ $blindVer ? '12' : '4' }} col-xs-12">
    <div class="rounded-block gray left-block">{!! $content !!}</div>

    @if (isset($buttons) && $buttons)
        <div class="record-block">
            <div class="button gray1"><a href="#">{{ trans('menu.to_record') }}</a></div>
            <div class="button "><a href="#">{{ trans('content.to_record_kid') }}</a></div>
        </div>
    @endif
</div>