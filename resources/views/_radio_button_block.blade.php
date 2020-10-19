@foreach ($values as $value)
    @if ($value)
        <div class="form-group {{ isset($addClass) ? $addClass : '' }} {{ $errors && $errors->has($name) ? 'has-error' : '' }}">
            <input class="radio-input" value="{{ $value['val'] }}" type="radio" name="{{ $name }}" {{ ($activeValue == $value['val'] && !count($errors)) || (Session::has($name) && $value['val'] == Session::get($name)) || ($value['val'] == old($name) && count($errors)) ? 'checked' : '' }}>
            <span class="control-label"><nobr>{!! $value['descript'] !!}</nobr></span>
            @if ($errors && $errors->has($name))
                <div class="form-control-feedback">
                    <i class="icon-cancel-circle2"></i>
                </div>
            @endif
        </div>
    @endif
@endforeach
@if (count($errors) && $errors->has($name))
    <div class="form-group has-feedback has-error">
        <span class="help-block">{{ $errors->first($name) }}</span>
    </div>
@endif