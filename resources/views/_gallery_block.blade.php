@if (count($galleries))
    <div class="owl-carousel gallery">
        @foreach($galleries as $gallery)
            <div class="image"><a class="img-preview" href="{{ asset($gallery->photo) }}"><img src="{{ asset($gallery->photo) }}" /></a></div>
        @endforeach
    </div>
@endif