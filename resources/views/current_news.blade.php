@extends('layouts.main')

@section('content')
    <div class="section current-news">
        <div class="container">
            <div class="col-md-8 col-sm-12 col-xs-12">
                <h1>{{ $data['news']['head_'.App::getLocale()] }}</h1>
                <div class="header">
                    <h3 class="text-left">
                        <img class="icon" src="{{ asset('images/icon_date.svg') }}">
                        {{ date('d.m.Y',$data['news']->date) }}
                    </h3>
                </div>
                {!! $data['news']['content_'.App::getLocale()] !!}
            </div>
            <div class="col-md-4 col-sm-12 col-xs-12">
                <div class="news">
                    <img src="{{ asset($data['news']->image) }}" />
                </div>
            </div>
        </div>
    </div>
@endsection