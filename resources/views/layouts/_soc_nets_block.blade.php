@foreach($socnets as $socnet)
    <div class="soc-net"><a href="{{ $socnet['href'] }}" target="_blank"><img src="{{ asset('images/soc_nets/'.$socnet['icon'].'.png') }}" /></a></div>
@endforeach