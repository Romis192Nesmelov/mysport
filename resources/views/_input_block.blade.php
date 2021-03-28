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
        <span>*</span>
    @endif
    </div>
@endif
<div class="form-group has-feedback has-feedback-left {{ count($errors) && $errors->has($name) ? "class=has-error" : '' }} {{ isset($addClass) ? $addClass : '' }}" {!! isset($attrString) ? $attrString : '' !!}>
    <input {{ isset($disabled) && $disabled ? 'disabled=disabled' : '' }} {{ !isset($icon) || !$icon ? 'style=padding-left:10px' : '' }} {{ isset($min) && $min ? 'min='.$min : '' }} {{ isset($max) && $max ? 'max='.$max : '' }} name="{{ $name }}" type="{{ $type }}" class="form-control" placeholder="{{ isset($placeholder) && $placeholder ? $placeholder : '' }}" value="{{ isset($value) && !count($errors) ? $value : (Session::has($name) ? Session::get($name) : old($name)) }}">
    @if (isset($icon) && $icon)
        <div class="form-control-feedback">
            <i class="{{ $icon }} text-muted"></i>
        </div>
    @endif
    @if ( (count($errors) && $errors->has($name)) || (isset($useAjax) && $useAjax))
        <div class="help-block error error-{{ $name }}">{!! $errors->first($name) !!}</div>
    @endif
</div>