<div class="owl-carousel sports">
    @foreach($sports as $sport)
        <div class="kind-of-sport">
            <a href="{{ url('/kinds-of-sport?id='.$sport->id) }}"><img src="{{ asset($sport->icon) }}" /></a>
            {{ $sport['name_'.App::getLocale()] }}
        </div>
    @endforeach
</div>