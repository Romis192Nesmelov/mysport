<div class="radio-buttons type3">
    <input type="hidden" name="{{ $name }}" value="{{ $active }}">
    <div class="cir-block">
    @if (isset($label) && $label)
        <div class="description input-label">{{ $label }}</div>
    @endif
        @foreach($items as $item)
            <div class="cir-cell">
                <div class="cir {{ $item['value'] == $active ? 'active' : '' }}" data="{{ $item['value'] }}">
                    <i class="icon-check2 {{ $item['value'] != $active ? 'hidden' : '' }}"></i>
                </div>
                {{ $item['name'] }}
            </div>
        @endforeach
    </div>
</div>