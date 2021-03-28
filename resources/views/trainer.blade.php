@extends('layouts.main')

@section('content')
    <div class="section">
        <div class="container">
            @php ob_start(); @endphp
            @include('_cir_image_block', [
                'image' => $data['trainer']->user->avatar,
                'name' => Helper::simpleCreds($data['trainer']->user),
                'scroll1' => 'kind-of-sports',
                'counter1' => $data['trainer']->sport['name_'.App::getLocale()],
            ])

            @include('_left_gray_block',['content' => ob_get_clean(),'buttons' => false])

            @php ob_start(); @endphp
            @include('_header_block', [
                'tagName' => 'h1',
                'head' => trans('content.trainer_info')
            ])

            @include('_description_block',[
                'description' => trans('content.about_me'),
                'content' => $data['trainer']['about_'.App::getLocale()]
            ])

            @include('_description_block',[
                'description' => trans('content.education'),
                'content' => $data['trainer']['education_'.App::getLocale()],
                'useParagraph' => true
            ])

            @include('_description_block',[
                'description' => trans('content.add_education'),
                'content' => $data['trainer']['add_education_'.App::getLocale()],
                'useParagraph' => true
            ])

            @include('_description_block',[
                'description' => trans('content.achievements'),
                'content' => $data['trainer']['achievements_'.App::getLocale()],
                'useParagraph' => true
            ])

            @include('_description_block',[
                'description' => trans('content.experience_since'),
                'content' => $data['trainer']->since.' '.trans('content.year'),
                'useParagraph' => true
            ])

            @include('_header_block', [
                'tagName' => 'h1',
                'head' => trans('content.sport_organizations_and_sections'),
                'scroll' => 'kind-of-sports'
            ])
            @foreach ($data['trainer']->sections as $section)
                <div class="credentials-block">
                    @include('_credentials_block',[
                        'colMd' => 12,
                        'colSm' => 12,
                        'description' => trans('content.organization'),
                        'credential' => $section->organization['name_'.App::getLocale()],
                        'href' => '/organizations/'.$section->organization->slug,
                        'blank' => false
                    ])

                    @include('_credentials_block',[
                        'colMd' => 12,
                        'colSm' => 12,
                        'description' => trans('content.section'),
                        'credential' => $section['name_'.App::getLocale()],
                        'href' => '/sections/'.$section->slug,
                        'blank' => false
                    ])
                </div>
            @endforeach

            @include('_right_gray_block',['content' => ob_get_clean(), 'useMap' => false])
        </div>
    </div>
@endsection