@extends('layouts.main')

@section('content')
    <div class="section">
        <div class="container kind-of-sport-page">
            @php ob_start(); @endphp
            @include('_cir_image_block', [
                'image' => $data['sport']->icon,
                'name' => $data['sport']['name_'.App::getLocale()],
                'counter1' => count($data['sport']->trainers).' '.trans('content.trainers'),
                'href1' => '/trainers',
                'counter2' => $data['counters']['events'].' '.trans('content.events'),
                'href2' => '/events'
            ])

            @include('_left_gray_block',['content' => ob_get_clean(),'buttons' => false])

            @php ob_start(); @endphp
            @include('_header_block', [
                'tagName' => 'h1',
                'head' => $data['sport']['name_'.App::getLocale()].' <span>'.trans('content.in_spb').'</span>'
            ])

            @include('_gallery_block',['galleries' => $data['gallery']])

            <div class="content-block">
                <div class="description">{{ trans('content.description') }}</div>
                <p>{{ $data['sport']['description_'.App::getLocale()] }}</p>

                <div class="description">{{ trans('content.sports_recommendations') }}</div>
                <p>{{ $data['sport']['recommendation_'.App::getLocale()] }}</p>

                <div class="description">{{ trans('content.what_needed') }}</div>
                <p>{{ $data['sport']['needed_'.App::getLocale()] }}</p>
            </div>

            @include('_right_gray_block',['content' => ob_get_clean(), 'useMap' => false])
        </div>
    </div>
@endsection