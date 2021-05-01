<div class="kind-of-sport {{ isset($addClass) ? $addClass : '' }}">
    @if (isset($descrLength))
        <img src="{{ asset($sport->icon) }}" />
    @else
        <a href="{{ url('/kinds-of-sport?id='.$sport->id) }}"><img src="{{ asset($sport->icon) }}" /></a>
    @endif
    <div class="name">{{ $sport['name_'.App::getLocale()] }}</div>
    @if (isset($descrLength))
        <div class="description">{{ Helper::croppedContent($sport['description_'.App::getLocale()],$descrLength) }}</div>
        <a class="button red" href="{{ url('/kinds-of-sport?id='.$sport->id) }}">{{ trans('content.details') }}</a>
    @endif
</div>