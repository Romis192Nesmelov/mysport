<div class="cir-image image"><img src="{{ asset($image ? $image : 'images/placeholder.jpg') }}" /></div>
<h2 class="name">{{ $name }}</h2>
@if ( (isset($counter1) && $counter1) || (isset($counter2) && $counter2) )
    <h2>
        @if (isset($counter1) && $counter1)
            <a data-scroll="{{ $scroll1 }}">{{ $counter1 }}</a><br>
        @endif
        @if (isset($counter2) && $counter2)
            <a data-scroll="{{ $scroll2 }}">{{ $counter2 }}</a>
        @endif
    </h2>
@endif