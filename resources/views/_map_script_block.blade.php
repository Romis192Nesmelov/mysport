<script>
    window.points = {};
    window.nameScript = "{{ trans('content.name') }}:";
    window.addressScript = "{{ trans('content.address') }}";
    window.coordinatesScript = "{{ trans('content.coordinates') }}";
</script>
@foreach($data['points'] as $k => $pointsArr)
    <script>
        window.points["{{ $k }}"] = [];
        window.locale = "{{ App::getLocale() }}";
    </script>
    @if ($pointsArr && count($pointsArr))
        @foreach($pointsArr as $point)
            <script>
                window.points["{{ $k }}"].push({
                    'latitude'      :parseFloat("{{ $point->latitude }}"),
                    'longitude'     :parseFloat("{{ $point->longitude }}"),
                    'id'            :parseInt("{{ $point->id }}"),
                    'name_ru'       :"{{ $point->name_ru }}",
                    'address_ru'    :"{{ $point->address_ru }}",
                    'name_en'       :"{{ $point->name_en }}",
                    'address_en'    :"{{ $point->address_en }}"
                });
            </script>
        @endforeach
    @endif
@endforeach