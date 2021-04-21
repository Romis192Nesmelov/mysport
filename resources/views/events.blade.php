@extends('layouts.main')

@section('content')
    <div class="section">
        <div class="container">
            @include('_header_block', [
                'tagName' => 'h1',
                'icon' => 'icon_sports_events',
                'head' => trans('content.sports_events_poster')
            ])
            @include('_events_calendar_block')
            @foreach($data['events'] as $k => $event)
                @include('_event_block', [
                    'event' => $event,
                    'colMd' => 3,
                    'blindColMd' => 4,
                    'colSm' => 4,
                    'blindColSm' => 6
                ])
                @if ($k == 4)
                    @include('_events_banner_block')
                @endif
            @endforeach
            {{ $data['events']->render() }}
        </div>
    </div>
@endsection