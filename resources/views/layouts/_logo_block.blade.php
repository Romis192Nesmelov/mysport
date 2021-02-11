<div class="main-logo-container">
    <img src="{{ asset('images/logo.png') }}" />
    {!! '<'.$tagName.'>' !!}
        @if ($withSpan)
            <span class="text-green">{{ trans('content.head_part1') }}</span>
            <span class="text-red">{{ trans('content.head_part2') }}</span>
            <span class="text-green">{{ trans('content.head_part3') }}</span>
        @else
            {{ trans('content.head_part1').trans('content.head_part2').trans('content.head_part3') }}
        @endif
    {!! '</'.$tagName.'>' !!}
</div>