<div class="{{ isset($addClass) ? $addClass : '' }} form-group has-feedback {{ $errors && $errors->has($name) ? 'has-error' : '' }}">
    @if (isset($label))
        <label class="control-label col-md-12 text-semibold">{{ $label }}</label>
    @endif
    <div class="col-md-12">
        <select name="{{ $name }}" class="form-control">
            @if (is_array($values))
                @foreach ($values as $value => $options)
                    <option value="{{ $value }}" {{ (!count($errors) ? $value == $selected : $value == old($name)) ? 'selected' : '' }}>{{ $options }}</option>
                @endforeach
            @else
                @foreach ($values as $value)
                    <option value="{{ $value->id }}" {{ (!count($errors) ? $value->id == $selected : $value->id == old($name)) ? 'selected' : '' }}>{{ isset($value->name) ? $value->name : $value->email }}</option>
                @endforeach
            @endif
        </select>

        @if (count($errors) && $errors->has($name))
            <div class="form-control-feedback">
                <i class="icon-cancel-circle2"></i>
            </div>
            <span class="help-block">{{ $errors->first($name) }}</span>
        @endif

    </div>
</div>