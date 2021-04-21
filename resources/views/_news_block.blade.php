<div class="col-md-{{ $col }} col-sm-12 col-xs-12">
    <a href="{{ url('news/'.$news->slug) }}">
        <div class="news">
            <img src="{{ asset($news->image) }}" />
            <div class="grad"></div>
            <div class="text">
                <div class="head">{{ $news['head_'.App::getLocale()] }}</div>
                @if (!$k)
                    <div class="content hidden-sm hidden-xs">{{ Helper::croppedContent($news['content_'.App::getLocale()],250) }}</div>
                @endif
            </div>
        </div>
    </a>
</div>