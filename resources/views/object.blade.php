@extends('layouts.main')

@section('content')
    <div class="section">
        <div class="container">
            @php ob_start(); @endphp
            @if (isset($data['item']->kindOfSport))
                @include('_cir_image_block', [
                    'image' => $data['item']->image,
                    'name' => $data['item']['name_'.App::getLocale()]
                ])
            @else
                @include('_cir_image_block', [
                    'image' => $data['item']->image,
                    'name' => $data['item']['name_'.App::getLocale()],
                    'scroll1' => 'kind-of-sports',
                    'counter1' => Helper::kindOfSportCaseFormat(count($data['item']->sections)),
                    'scroll2' => 'sections',
                    'counter2' => Helper::sectionsCaseFormat(count($data['item']->sections)),
                ])
            @endif

            @include('_left_gray_block',['content' => ob_get_clean(),'buttons' => true])

            {{--@if (isset($data['item']->kindOfSport))--}}

            {{--@endif--}}

            @php ob_start(); @endphp
            @include('_header_block', [
                'tagName' => 'h1',
                'head' => $data['item']['name_'.App::getLocale()]
            ])

            @include('_gallery_block',['galleries' => $data['item']->gallery])

            @include('_description_block',[
                'description' => trans('content.description'),
                'content' => $data['item']['description_'.App::getLocale()]
            ])

            <div class="credentials-block">
                @include('_credentials_block',[
                    'colMd' => 12,
                    'colSm' => 12,
                    'description' => trans('content.address'),
                    'credential' => $data['item']['address_'.App::getLocale()]
                ])

                @include('_credentials_block',[
                    'colMd' => 12,
                    'colSm' => 12,
                    'description' => trans('content._area'),
                    'credential' => $data['item']->area['name_'.App::getLocale()],
                    'href' => 'area/'.$data['item']->area->slug
                ])

                @if (isset($data['item']->kindOfSport))
                    @include('_credentials_block',[
                        'colMd' => 12,
                        'colSm' => 12,
                        'description' => trans('content.kind_of_sport_object'),
                        'credential' => $data['item']->kindOfSport['name_'.App::getLocale()]
                    ])

                    @include('_credentials_block',[
                        'colMd' => 12,
                        'colSm' => 12,
                        'description' => trans('content.organization'),
                        'credential' => $data['item']->organization['name_'.App::getLocale()],
                        'href' => 'organizations/'.$data['item']->organization->slug
                    ])

                    @include('_credentials_block',[
                        'colMd' => 12,
                        'colSm' => 12,
                        'description' => trans('content.main_trainer'),
                        'credential' => $data['item']->leader['name_'.App::getLocale()],
                        'href' => 'trainers/?id='.$data['item']->leader->id
                    ])
                @elseif (count($data['item']->sections))
                    @php
                        $kindsOfSport = '';
                        $sections = '';
                        foreach ($data['item']->sections as $section) {
                            $kindsOfSport .= '<a href="'.url('/kind-of-sport/?id='.$section->kindOfSport->id).'">'.$section->kindOfSport['name_'.App::getLocale()].'</a>, ';
                            $sections .= '<a href="'.url('/sections/'.$section->slug).'">'.$section['name_'.App::getLocale()].'</a>, ';
                        }
                    @endphp
                    @include('_credentials_block',[
                        'colMd' => 12,
                        'colSm' => 12,
                        'description' => trans('content.kind_of_sport_object'),
                        'credential' => $kindsOfSport,
                        'scroll' => 'kind-of-sports'
                    ])

                    @include('_credentials_block',[
                        'colMd' => 12,
                        'colSm' => 12,
                        'description' => trans('content.list_of_sections'),
                        'credential' => $sections,
                        'scroll' => 'sections'
                    ])

                    @include('_credentials_block',[
                        'colMd' => 12,
                        'colSm' => 12,
                        'description' => trans('content.leader'),
                        'credential' => $data['item']['leader_'.App::getLocale()]
                    ])
                @endif

                @if ($data['item']->site)
                    @include('_credentials_block',[
                        'colMd' => $blindVer ? 12 : 6,
                        'colSm' => $blindVer ? 12 : 6,
                        'description' => trans('content.site'),
                        'credential' => $data['item']->site,
                        'href' => $data['item']->site,
                        'blank' => true
                    ])
                @endif

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

                @if (isset($data['item']->schedule_ru) && $data['item']->schedule_ru)
                    @include('_credentials_block',[
                        'colMd' => $blindVer ? 12 : 6,
                        'colSm' => $blindVer ? 12 : 6,
                        'description' => trans('content.timetable'),
                        'credential' => $data['item']['schedule_'.App::getLocale()]
                    ])
                @endif
            </div>

            @include('_right_gray_block',['content' => ob_get_clean(), 'useMap' => true])
        </div>
    </div>

    @include('_map_script_block')
@endsection