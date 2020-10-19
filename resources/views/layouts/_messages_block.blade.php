<div class="icon-bell3">
    <div class="counter">{{ count($messages) }}</div>
    <ul class="dropdown-menu messages">
        <li class="drop-messages"><a href="#">{{ trans('content.mark_all_as_read') }}</a></li>
        @foreach($messages as $message)
            <li>
                <a href="{{ $message['href'] }}">{{ $message['head_'.App::getLocale()] }}</a>
                @if ($message['content_'.App::getLocale()])
                    <p>{{ $message['content_'.App::getLocale()] }}</p>
                @endif
            </li>
        @endforeach
    </ul>
</div>