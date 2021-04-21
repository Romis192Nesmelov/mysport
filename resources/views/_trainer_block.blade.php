@if ($trainer->sport->active)
    <div class="trainer">
        <a href="{{ url('/trainers/?id='.$trainer->id) }}">
            <div class="photo"><img src="{{ asset($trainer->user->avatar) }}" /></div>
            <div class="family">{{ App::getLocale() == 'en' ? str_slug($trainer->user->family) : $trainer->user->family }}</div>
            @if (App::getLocale() == 'en')
                {{ str_slug($trainer->user->name).' '.str_slug($trainer->user->surname) }}
            @else
                {{ $trainer->user->name.' '.$trainer->user->surname }}
            @endif
            <div class="section-name">{{ trans('content.trainer_section', ['section' => $trainer->sport['name_'.App::getLocale()]]) }}</div>
        </a>
    </div>
@endif