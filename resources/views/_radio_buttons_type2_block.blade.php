<div class="radio-buttons type2">
    <input type="hidden" name="{{ $name }}" value="{{ $active }}">
    <div class="cir-block">
    <div class="label-block">{{ $label }}</div>
        @foreach($items as $k => $value)
            <div class="cir-cell">
                <div class="cir {{ $value == $active ? 'active' : '' }} {{ $k ? 'second' : '' }}" data="{{ $value }}">{{ $value }}</div>
            </div>
        @endforeach
    </div>
</div>