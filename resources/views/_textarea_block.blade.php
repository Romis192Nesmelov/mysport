<div class="clearfix form-group textarea has-feedback {{ $errors && $errors->has($name) ? 'has-error' : '' }}">
    @if (isset($label) && $label)
        <div class="description input-label">{{ $label }}</div>
    @endif
    <textarea {{ isset($simple) && $simple ? 'class=simple' : '' }} name="{{ $name }}">{{ count($errors->getMessageBag()) ? old($name) : (isset($value) ? $value : '') }}</textarea>

    @if ($errors && $errors->has($name) || (isset($useAjax) && $useAjax))
        <div class="help-block error error-{{ $name }}">{{ $errors->first($name) }}</div>
    @endif
    @if (!isset($simple) || !$simple)
        <script>
            var editor = CKEDITOR.replace('{{ $name }}', {
                height: '{{ isset($height) ? $height.'px' : '200px' }}'
            });
        </script>
    @endif
</div>
