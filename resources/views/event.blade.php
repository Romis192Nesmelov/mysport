@extends('layouts.main')

@section('content')
    <div class="section">
        <div class="container">
            @php ob_start(); @endphp
            @include('_cir_image_block', [
                'image' => $data['item']->trainer->image,
                'name' => $data['item']->trainer['name_'.App::getLocale()],
                'counter1' => Helper::haveJoinedCaseFormat(count($data['item']->eventsRecord))
            ])

            @include('_left_gray_block',['content' => ob_get_clean(),'buttons' => true])


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
                    'credential' => date('d.m.Y',$data['item']->start_time)
                ])

                @include('_credentials_block',[
                    'colMd' => 6,
                    'colSm' => 6,
                    'description' => trans('content.time'),
                    'credential' => date('H:i',$data['item']->start_time).' – '.date('H:i',$data['item']->end_time)
                ])
            </div>
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
                    'description' => trans('content.kind_of_sport_object'),
                    'credential' => $data['item']->trainer->sport['name_'.App::getLocale()],
                    'href' => '/kind-of-sport?id='.$data['item']->trainer->sport->id
                ])

                @include('_credentials_block',[
                    'colMd' => 12,
                    'colSm' => 12,
                    'description' => trans('content.trainer'),
                    'credential' => $data['item']->trainer['name_'.App::getLocale()],
                    'href' => '/trainers?id='.$data['item']->trainer->id
                ])

                @include('_credentials_block',[
                    'colMd' => 12,
                    'colSm' => 12,
                    'description' => trans('content.object_name'),
                    'credential' => $data['item']->trainer->sections[0]->organization['name_'.App::getLocale()],
                    'href' => '/organizations/'.$data['item']->trainer->sections[0]->organization->slug
                ])

                @include('_credentials_block',[
                    'colMd' => $blindVer ? 12 : 6,
                    'colSm' => $blindVer ? 12 : 6,
                    'description' => trans('content.contact_phone'),
                    'credential' => $data['item']->trainer->sections[0]->phone
                ])

                @include('_credentials_block',[
                    'colMd' => $blindVer ? 12 : 6,
                    'colSm' => $blindVer ? 12 : 6,
                    'description' => trans('content.contact_email'),
                    'credential' => $data['item']->trainer->sections[0]->email
                ])

                @include('_credentials_block',[
                    'colMd' => 12,
                    'colSm' => 12,
                    'description' => trans('content.age_group'),
                    'credential' => Helper::getAgeGroup($data['item']->age_group)
                ])
            </div>

            @include('_right_gray_block',['content' => ob_get_clean()])
        </div>
    </div>

    @include('_map_block',['useHeader' => false, 'addClass' => 'simplified'])
@endsection