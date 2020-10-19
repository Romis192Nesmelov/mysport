@component('mail::message')
{{-- Greeting --}}
@if (! empty($greeting))
# {{ $greeting }}
@else
@if ($level === 'error')
# @lang('Whoops!')
@else
# @lang(trans('auth.hello'))
@endif
@endif

{{-- Intro Lines --}}
@foreach ($introLines as $line)
{{ $line }}

@endforeach

{{-- Action Button --}}
@isset($actionText)
<?php
    switch ($level) {
        case 'success':
        case 'error':
            $color = $level;
            break;
        default:
            $color = 'primary';
    }
?>
@component('mail::button', ['url' => $actionUrl, 'color' => $color])
{{ $actionText }}
@endcomponent
@endisset

{{-- Outro Lines --}}
@foreach ($outroLines as $line)
{{ $line }}

@endforeach

{{-- Salutation --}}
@if (! empty($salutation))
{{ $salutation }}
@else
@lang(trans('auth.regards')), {{ config('app.name') }}
@endif

{{-- Subcopy --}}
@isset($actionText)
@slot('subcopy')
{!! trans('auth.trouble_with_url_button', ['actionText' => $actionText, 'actionURL' => $actionUrl]) !!}
{{--@lang(--}}
    {{--'into your web browser: [:actionURL](:actionURL)',--}}
    {{--[--}}
        {{--'actionText' => $actionText,--}}
        {{--'actionURL' => $actionUrl,--}}
    {{--]--}}
{{--)--}}
@endslot
@endisset
@endcomponent
