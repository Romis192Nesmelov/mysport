@if (isset($label) && $label)
    <p class="label">{{ $label }}</p>
@endif
<select name="{{ $name }}" class="type2">
    @if (isset($nullItem))
        <option value="0">{!! $nullItem !!}</option>
    @endif
    @foreach ($items as $item)
        <option value="{{ $item->id }}">{{ $item['name_'.App::getLocale()] }}</option>
    @endforeach
</select>