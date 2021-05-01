@if ($useLabel)
    <div class="description input-label">{{ trans('content.select_the_area') }}</div>
@endif
<select name="{{ isset($areaInputName) && $areaInputName ? $areaInputName : 'area' }}" class="type{{ $type }}">
    <option value="0">{{ trans('content.not_select_the_area') }}</option>
    @foreach($areas as $area)
        <option value="{{ $area->id }}" {{ isset($selected) && $selected && $area->id == $selected ? 'selected' : '' }}>{{ $area['name_'.App::getLocale()] }}</option>
    @endforeach
</select>