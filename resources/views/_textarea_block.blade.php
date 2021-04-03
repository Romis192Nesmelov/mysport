<div class="clearfix form-group textarea has-feedback {{ $errors && $errors->has($name) ? 'has-error' : '' }}">
    @if (isset($label) && $label)
        <div class="description input-label">
            {{ $label }}
            @if (isset($star) && $star)
                <span class="star">*</span>
            @endif
        </div>
    @endif
    <textarea class="{{ isset($simple) && $simple ? 'simple' : '' }} {{ count($errors) && $errors->has($name) ? 'has-error' : '' }}" name="{{ $name }}">{{ count($errors->getMessageBag()) ? old($name) : (isset($value) ? $value : '') }}</textarea>
    @include('_input_error_block')

    @if (!isset($simple) || !$simple)
        <script>
            var editor = CKEDITOR.replace('{{ $name }}', {
                height: '{{ isset($height) ? $height.'px' : '200px' }}'
            });
        </script>
    @endif
</div>
