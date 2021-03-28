@if (isset($inputName) && $inputName)
    @include('_image_block',[
        'name' => $inputName,
        'preview' => $image ? $image : 'images/placeholder.jpg'
    ])
@else
    <div class="cir-image image">
        <img src="{{ asset($image ? $image : 'images/placeholder.jpg') }}" />
    </div>
@endif

<h2 class="name">{!! $name !!}</h2>
@if ( (isset($counter1) && $counter1) || (isset($counter2) && $counter2) || (isset($counter3) && $counter3) )
    <h2>
        @if (isset($counter1) && $counter1)
            @include('_counter_block',[
                'counter' => $counter1,
                'scroll' => isset($scroll1) && $scroll1 ? $scroll1 : null,
                'href' => isset($href1) && $href1 ? $href1 : null
            ])
        @endif

        @if (isset($counter2) && $counter2)
            <br>
            @include('_counter_block',[
                'counter' => $counter2,
                'scroll' => isset($scroll2) && $scroll2 ? $scroll2 : null,
                'href' => isset($href2) && $href2 ? $href2 : null
            ])
        @endif

        @if (isset($counter3) && $counter3)
            <br>
            @include('_counter_block',[
                'counter' => $counter3,
                'scroll' => isset($scroll3) && $scroll3 ? $scroll3 : null,
                'href' => isset($href3) && $href3 ? $href3 : null
            ])
        @endif
    </h2>
@endif