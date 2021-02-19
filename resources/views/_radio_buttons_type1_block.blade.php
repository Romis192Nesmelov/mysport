<div class="radio-buttons type1">
    <input type="hidden" name="{{ $name }}" value="{{ $active }}">
    @foreach($items as $value => $text)
        <div class="cir-block">
            <div class="cir-cell">
                <div class="cir {{ $value == $active ? 'active' : '' }}" data="{{ $value }}">
                    <i class="icon-check2 {{ $value != $active ? 'hidden' : '' }}"></i>
                </div>
            </div>
            <div class="label-block">{!! $text !!}</div>
        </div>
    @endforeach
</div>