@extends('layouts.main')

@section('content')
    <div class="section">
        <div class="container">
            @php ob_start(); @endphp
            @include('_cir_image_block', [
                'image' => $data['item']->user->avatar,
                'name' => Helper::simpleCreds($data['item']->user),
                'counter1' => Helper::haveJoinedCaseFormat(count($data['item']->records))
            ])

            @include('_left_gray_block', [
                'content' => ob_get_clean(),
                'buttons' => time() < $data['item']->start_time,
                'recordUserMessage' => trans('content.do_you_want_to_sign_up_for_this_event'),
                'recordKidMessage' => trans('content.do_you_want_to_sign_up_your_child_for_this_event'),
                'recordUserAction' => 'event-user-record',
                'recordKidAction' => 'event-kids-record',
            ])

            @php ob_start(); @endphp
            @include('_header_block', [
                'tagName' => 'h1',
                'head' => $data['item']['name_'.App::getLocale()]
            ])

            <div class="content-block">
                @include('_credentials_block',[
                    'colMd' => 6,
                    'colSm' => 6,
                    'description' => trans('content.date'),
                    'credential' => date('d.m.Y',Helper::setMoscowTimeZone($data['item']->start_time))
                ])

                @include('_credentials_block',[
                    'colMd' => 6,
                    'colSm' => 6,
                    'description' => trans('content.time'),
                    'credential' => date('H:i',Helper::setMoscowTimeZone($data['item']->start_time)).' – '.date('H:i',Helper::setMoscowTimeZone($data['item']->end_time))
                ])
            </div>
            <div class="credentials-block">
                @include('_credentials_block',[
                    'colMd' => 12,
                    'colSm' => 12,
                    'description' => trans('content.address'),
                    'credential' => $data['item']['address_'.App::getLocale()]
                ])

                @php
                    $kindsOfSport = '';
                    foreach ($data['item']->sports as $k => $sport) {
                        $comma = $k != count($data['item']->sports)-1 ? ', ' : '';
                        $kindsOfSport .= Helper::kindOfSportLink($sport->kindOfSport).$comma;
                    }
                @endphp
                @include('_credentials_block',[
                    'colMd' => 12,
                    'colSm' => 12,
                    'description' => trans('content.kind_of_sport_object'),
                    'credential' => $kindsOfSport,
                    'scroll' => 'kind-of-sports'
                ])

                @if (Gate::forUser($data['item']->user)->allows('trainer'))
                    @include('_credentials_block',[
                        'colMd' => 12,
                        'colSm' => 12,
                        'description' => trans('content.object_name'),
                        'credential' => $data['item']->user->trainer->sections[0]->organization['name_'.App::getLocale()],
                        'href' => '/organizations/'.$data['item']->user->trainer->sections[0]->organization->slug
                    ])

                    @include('_credentials_block',[
                        'colMd' => $blindVer ? 12 : 6,
                        'colSm' => $blindVer ? 12 : 6,
                        'description' => trans('content.contact_number'),
                        'credential' => $data['item']->user->trainer->sections[0]->phone
                    ])

                    @include('_credentials_block',[
                        'colMd' => $blindVer ? 12 : 6,
                        'colSm' => $blindVer ? 12 : 6,
                        'description' => trans('content.contact_email'),
                        'credential' => $data['item']->user->trainer->sections[0]->email
                    ])
                @endif

                @include('_credentials_block',[
                    'colMd' => 12,
                    'colSm' => 12,
                    'description' => trans('content.age_group'),
                    'credential' => Helper::getAgeGroup($data['item']->age_group)
                ])
            </div>

            @include('_right_gray_block',['content' => ob_get_clean(), 'useMap' => true])
        </div>
    </div>
    @include('_map_script_block')
@endsection