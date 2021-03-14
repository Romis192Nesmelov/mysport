<div class="col-md-4 col-sm-{{ $blindVer ? '12' : '4' }} col-xs-12">
    <div class="rounded-block gray left-block">{!! $content !!}</div>

    @if (isset($buttons) && $buttons && !Auth::guest())
        <div class="sub-buttons-block">
            <div class="button gray1"><a href="#">{{ trans('menu.to_record') }}</a></div>
            @if (count(Auth::user()->kids))
                <div class="button"><a href="#">{{ trans('content.to_record_kid') }}</a></div>
            @endif
        </div>
    @elseif (isset($kidsMode) && $kidsMode)
        <div class="sub-buttons-block">
            <div class="button"><a href="{{ url('/profile/child') }}">{{ trans('content.add_kid_profile') }}</a></div>
        </div>
    @endif
</div>