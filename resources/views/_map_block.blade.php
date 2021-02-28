<div class="section" data-scroll-destination="map">
    <a name="map"></a>
    <div class="container">
        @if ($useHeader)
            @include('_header_block', [
                'tagName' => 'h1',
                'icon' => 'icon_map',
                'head' => trans('content.sport_map')
            ])
        @endif

        <div class="col-md-{{ $blindVer ? '12' : '8' }} col-sm-{{ $blindVer ? '12' : '12' }} col-xs-12">
            <div id="map" class="rounded-block"></div>
        </div>
        <div class="col-md-{{ $blindVer ? '12' : '4' }} col-sm-{{ $blindVer ? '12' : '12' }} col-xs-12">
            <div class="rounded-block gray">
                {!! csrf_field() !!}

                <h1>{{ trans('content.find') }}</h1>
                @include('layouts._areas_select_block',[
                    'type' => 2,
                    'useLabel' => true,
                    'selected' => isset($data['area']) ? $data['area']->id : null
                ])

                @include('_select_type2_block',[
                    'name' => 'kind_of_sport',
                    'items' => $sports,
                    'nullItem' => trans('content.not_select_the_kind_of_sport'),
                    'label' => trans('content.select_the_kind_of_sport')
                ])

                {{--@include('_radio_buttons_type2_block',[--}}
                {{--'name' => 'test1',--}}
                {{--'label' => 'Укажите ваш пол',--}}
                {{--'items' => ['М','Ж'],--}}
                {{--'active' => 'М'--}}
                {{--])--}}

                {{--@include('_radio_buttons_type1_block',[--}}
                {{--'name' => 'test2',--}}
                {{--'items' => [--}}
                {{--'text1' => 'Тестовый<br>текст о чем-то1',--}}
                {{--'text2' => 'Тестовый<br>текст о чем-то2'--}}
                {{--],--}}
                {{--'active' => 'text2'--}}
                {{--])--}}

                @include('_checkbox_type1_block',[
                    'name' => 'events',
                    'label' => trans('content.sports_events'),
                    'active' => 1
                ])

                @include('_checkbox_type1_block',[
                    'name' => 'organizations',
                    'label' => trans('content.organizations'),
                    'active' => 1
                ])

                @include('_checkbox_type1_block',[
                    'name' => 'sections',
                    'label' => trans('content.sections'),
                    'active' => 1
                ])

                @include('_checkbox_type1_block',[
                    'name' => 'places',
                    'label' => trans('content.sports_grounds'),
                    'active' => 1
                ])

                <div id="exec-find" class="button green">{{ trans('content.execute_find') }}</div>
            </div>
        </div>
    </div>
</div>

<script>window.points = {};</script>
@foreach($data['points'] as $k => $pointsArr)
    <script>window.points["{{ $k }}"] = [];</script>
    @if ($pointsArr && count($pointsArr))
        @foreach($pointsArr as $point)
            <script>
                window.points["{{ $k }}"].push({
                    'latitude':parseFloat("{{ $point->latitude }}"),
                    'longitude':parseFloat("{{ $point->longitude }}"),
                    'id' : parseInt("{{ $point->id }}")
                });
            </script>
        @endforeach
    @endif
@endforeach