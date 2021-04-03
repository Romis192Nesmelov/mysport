@if (count($errors) && $errors->has($name))
    <div class="form-control-feedback">
        <i class="icon-cancel-circle2"></i>
    </div>
    <span class="error help-block">{{ $errors->first($name) }}</span>
@endif