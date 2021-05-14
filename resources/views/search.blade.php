@extends('layouts.main')

@section('content')
    <div class="section">
        <div class="container">
            @php ob_start(); @endphp
            @include('_cir_image_block', [
                'image' => asset('images/icons_search.svg'),
                'name' => trans('content.on_request',['request' => $data['search']]),
                'counter1' => count($data['found']) ? trans('content.found',['coincidences' => count($data['found'])]) : trans('content.nothing_found')
            ])

            @include('_left_gray_block',[
                'content' => ob_get_clean(),
                'buttons' => false
            ])

            @php ob_start(); @endphp

            @if (count($data['found']))
                @foreach($data['found'] as $found)
                    @php
                        $locale = App::getLocale();
                        $head = isset($found['item']['name_'.$locale]) ? $found['item']['name_'.$locale] : $found['item']['head_'.$locale];
                    @endphp
                    <a href="{{ url($found['href']) }}">
                        <h3>{!! Helper::markFound($head,$data['words']) !!}</h3>
                        @if (count($found['fields']))
                            @foreach($found['fields'] as $field => $content)
                                <p>{!! Helper::markFound($content,$data['words']) !!}</p>
                            @endforeach
                        @else
                            <p>{!! Helper::croppedContent((isset($found['item']['content_'.$locale]) ? $found['item']['content_'.$locale] : $found['item']['description_'.$locale]),100) !!}</p>
                        @endif
                    </a>
                @endforeach

                {{ $data['found']->render() }}
            @else
                <h1 class="text-center">{{ trans('content.found_zero_coincidences',['request' => $data['search']]) }}</h1>
            @endif

            @include('_right_gray_block',[
                'addClass' => 'search-results',
                'content' => ob_get_clean(),
                'useMap' => false
            ])
        </div>
    </div>
@endsection