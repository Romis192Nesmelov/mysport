@extends('layouts.main')

@section('content')
    <div class="section">
        <div class="container">
            @foreach ($data['kinds_of_sport'] as $sport)
                @include('_sport_block',[
                    'sport' => $sport,
                    'addClass' => 'col-md-3 col-sm-3 col-xs-12',
                    'descrLength' => 300
                ])
            @endforeach
        </div>
    </div>
@endsection