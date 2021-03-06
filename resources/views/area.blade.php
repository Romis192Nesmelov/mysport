@extends('layouts.main')

@section('content')
    <div class="section">
        <div class="container">
            @php ob_start(); @endphp
            @include('_cir_image_block', [
                'image' => $data['item']->image,
                'name' => $data['item']['name_'.App::getLocale()].' '.trans('content.area'),
                'scroll1' => 'area-events',
                'counter1' => Helper::eventsCaseFormat(count($data['item']->events)),
                'scroll2' => 'area-objects',
                'counter2' => Helper::objectsCaseFormat(count($data['item']->organizations)+count($data['item']->sections)+count($data['item']->places)),
            ])
            @include('_left_gray_block',['content' => ob_get_clean()])

            @php ob_start(); @endphp
            @include('_header_block', [
                'tagName' => 'h1',
                'head' => $data['item']['name_'.App::getLocale()].' '.trans('content.area').'<br><span>'.trans('content.of_spb').'</span>'
            ])

            @include('_gallery_block',['galleries' => $data['item']->gallery])

            <div class="content-block">{!! $data['item']['description_'.App::getLocale()] !!}</div>
            <div class="credentials-block">
                @include('_credentials_block',[
                    'colMd' => 12,
                    'colSm' => 12,
                    'description' => trans('content.area_leader'),
                    'credential' => $data['item']['leader_'.App::getLocale()]
                ])

                @if ($data['item']->phone)
                    @include('_credentials_block',[
                        'colMd' => $blindVer ? 12 : 6,
                        'colSm' => $blindVer ? 12 : 6,
                        'description' => trans('content.phone'),
                        'credential' => $data['item']->phone
                    ])
                @endif

                @if ($data['item']->email)
                    @include('_credentials_block',[
                        'colMd' => $blindVer ? 12 : 6,
                        'colSm' => $blindVer ? 12 : 6,
                        'description' => 'E-mail:',
                        'credential' => $data['item']->email,
                        'href' => 'mailto:'.$data['item']->email,
                        'blank' => true
                    ])
                @endif
            </div>

            @if (count($data['item']->organizations) || count($data['item']->sections) || count($data['item']->places))
                @include('_header_block', [
                    'tagName' => 'h1',
                    'head' => trans('content.sports_events_in_area'),
                    'scroll' => 'area-events'
                ])

                <div class="content-block">
                    @foreach ($data['item']->events as $event)
                        @include('_item_href_block',['item' => $event, 'prefix' => 'events'])
                    @endforeach
                </div>

                @include('_header_block', [
                    'tagName' => 'h1',
                    'head' => trans('content.sports_objects_in_area'),
                    'scroll' => 'area-objects'
                ])

                <div class="content-block">
                    @foreach ($data['item']->organizations as $organization)
                        @include('_item_href_block',['item' => $organization, 'prefix' => 'organizations'])
                    @endforeach

                    @foreach ($data['item']->sections as $section)
                        @include('_item_href_block',['item' => $section, 'prefix' => 'sections'])
                    @endforeach

                    @foreach ($data['item']->places as $place)
                        @include('_item_href_block',['item' => $place, 'prefix' => 'places'])
                    @endforeach
                </div>
            @endif
            @include('_right_gray_block',['content' => ob_get_clean(), 'useMap' => true])
        </div>
    </div>

    @include('_map_script_block')
@endsection