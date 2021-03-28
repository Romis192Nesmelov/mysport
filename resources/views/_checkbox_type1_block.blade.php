<div class="radio-buttons checkbox type1">
    <input type="hidden" name="{{ $name }}" value="{{ $active }}">
    <div class="cir-block">
        <div class="cir-cell">
            <div class="cir {{ $active ? 'active' : '' }}">
                <i class="icon-check2 {{ !$active ? 'hidden' : '' }}"></i>
            </div>
        </div>
        @if (isset($label) && $label)
            <div class="label-block">{!! $label !!}</div>
        @endif
    </div>
</div>