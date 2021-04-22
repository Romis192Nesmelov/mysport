@php ob_start(); @endphp
<select name="{{ $name }}" class="type2">
    @if (isset($nullItem))
        <option value="0">{!! $nullItem !!}</option>
    @endif
    @foreach ($items as $item)
        <option value="{{ $item->id }}">{{ $item['name_'.App::getLocale()] }}</option>
    @endforeach
</select>
@include('_input_cover_block',['content' => ob_get_clean()])