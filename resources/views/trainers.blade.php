@extends('layouts.main')

@section('content')
    <div class="section">
        <div class="container">
            @include('_header_block', [
                'tagName' => 'h1',
                'icon' => 'icons_trainer',
                'head' => trans('content.all_trainers')
            ])

            <div class="col-md-4 col-sm-{{ $blindVer ? '12' : '4' }} col-xs-12">
                <div class="rounded-block gray left-block scroll-block trainers-block">
                    <div class="sports-glossary">
                        <div class="head"><a href="{{ url('/trainers') }}">{{ trans('content.show_all_trainers') }}</a></div>
                        @foreach($data['glossary'] as $letter => $sports)
                            <div class="letter">{{ $letter }}</div>
                            <table>
                                @foreach($sports as $sport)
                                    <tr {{ isset($data['slug']) && $data['slug'] == $sport->slug ? 'class=selected' : '' }}>
                                        <td><a href="{{ url('/trainers/'.$sport->slug) }}">{{ $sport['name_'.App::getLocale()] }}</a></td>
                                        <td class="counter">{{ count($sport->trainers) }}</td>
                                    </tr>
                                @endforeach
                            </table>
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-md-8 col-sm-{{ $blindVer ? '12' : '8' }} col-xs-12 trainers-block">
                @foreach($data['trainers'] as $trainer)
                    <div class="col-md-{{ $blindVer ? '4' : '3' }} col-sm-{{ $blindVer ? '12' : '6' }} col-xs-12">
                        @include('_trainer_block', ['trainer' => $trainer])
                    </div>
                @endforeach
                {{ $data['trainers']->render() }}
            </div>
        </div>
    </div>
@endsection