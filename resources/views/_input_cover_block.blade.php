<?php
if (isset($addAttr) && count($addAttr)) {
    $attrString = '';
    foreach ($addAttr as $attrName => $attrValue) {
        $attrString .= $attrName.'="'.$attrValue.'" ';
    }
}
?>

@if (isset($label) && $label)
    <div class="description input-label">
        {{ $label }}
        @if (isset($star) && $star)
            <span class="star">*</span>
        @endif
    </div>
@endif
<div class="form-group has-feedback has-feedback-left {{ count($errors) && $errors->has($name) ? "has-error" : '' }} {{ isset($addClass) ? $addClass : '' }}" {!! isset($attrString) ? $attrString : '' !!}>
    {!! $content !!}
    @if (isset($icon) && $icon && !count($errors))
        <div class="form-control-feedback">
            <i class="{{ $icon }} text-muted"></i>
        </div>
    @endif
    @include('_input_error_block')
</div>