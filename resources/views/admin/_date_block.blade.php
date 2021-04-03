<div class="{{ isset($addClass) ? $addClass : '' }} form-group has-feedback {{ $errors && $errors->has($name) ? 'has-error' : '' }}">
    @if (isset($label))
        <div class="description input-label">{{ $label }}</div>
    @endif
    <div class="input-group">
        <span class="input-group-addon"><i class="icon-calendar22"></i></span>
        <input type="text" name="{{ $name }}" class="form-control daterange-single" value="{{ (count($errors) ? old($name) : date('d.m.Y', $value)) }}">
    </div>
    @include('_input_error_block')
</div>