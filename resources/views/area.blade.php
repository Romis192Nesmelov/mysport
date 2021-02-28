@extends('layouts.main')

@section('content')
    <div class="section">
        <div class="container">
            <div class="col-md-4 col-sm-{{ $blindVer ? '12' : '4' }} col-xs-12">
                <div class="rounded-block gray left-block">
                    <div class="area-arms image"><img src="{{ asset($data['area']->arms ? $data['area']->arms : 'images/placeholder.jpg') }}" /></div>
                    <h2 class="name">{{ $data['area']['name_'.App::getLocale()] }} {{ trans('content.area') }}</h2>
                    <h2><a href="#">{{ count($data['area']->events).' '.trans('content.events') }}</a></h2>
                </div>
            </div>
            <div class="col-md-8 col-sm-{{ $blindVer ? '12' : '8' }} col-xs-12">
                <div class="rounded-block gray right-block">
                    @include('_header_block', [
                        'tagName' => 'h1',
                        'head' => $data['area']['name_'.App::getLocale()].' '.trans('content.area').'<br><span>'.trans('content.of_spb').'</span>'
                    ])

                    @if (count($data['area']->gallery))
                        <div class="owl-carousel gallery">
                            @foreach($data['area']->gallery as $gallery)
                                <div class="image"><a class="img-preview" href="{{ asset($gallery->photo) }}"><img src="{{ asset($gallery->photo) }}" /></a></div>
                            @endforeach
                        </div>
                    @endif

                    <div class="content-block">{!! $data['area']['description_'.App::getLocale()] !!}</div>
                    <div class="credentials-block">
                        @include('_credentials_block',[
                            'colMd' => 12,
                            'colSm' => 12,
                            'description' => trans('content.area_leader'),
                            'credential' => $data['area']['leader_'.App::getLocale()]
                        ])

                        @include('_credentials_block',[
                            'colMd' => $blindVer ? 12 : 6,
                            'colSm' => $blindVer ? 12 : 6,
                            'description' => trans('content.phone'),
                            'credential' => $data['area']->phone
                        ])

                        @include('_credentials_block',[
                            'colMd' => $blindVer ? 12 : 6,
                            'colSm' => $blindVer ? 12 : 6,
                            'description' => 'E-mail',
                            'credential' => $data['area']->email
                        ])
                    </div>

                    @if (count($data['area']->sections) || count($data['area']->places))
                        @include('_header_block', [
                            'tagName' => 'h1',
                            'head' => trans('content.sports_objects_in_area')
                        ])

                        <div class="content-block">
                            @foreach ($data['area']->sections as $section)
                                @include('_item_href_block',['item' => $section, 'prefix' => 'sections'])
                            @endforeach

                            @foreach ($data['area']->places as $place)
                                @include('_item_href_block',['item' => $place, 'prefix' => 'places'])
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    @include('_map_block',['useHeader' => false])
@endsection