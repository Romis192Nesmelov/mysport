@php ob_start(); @endphp
<select name="{{ $name }}" class="form-control">
    @if (is_array($values))
        @foreach ($values as $value => $options)
            <option value="{{ $value }}" {{ (!count($errors) ? $value == $selected : $value == old($name)) ? 'selected' : '' }}>{{ $options }}</option>
        @endforeach
    @else
        @foreach ($values as $value)
            <option value="{{ $value->id }}" {{ (!count($errors) ? $value->id == $selected : $value->id == old($name)) ? 'selected' : '' }}>{{ $value[$optionName] }}</option>
        @endforeach
    @endif
</select>
@include('_input_cover_block',['content' => ob_get_clean()])