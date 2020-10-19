<div class="{{ isset($addClass) ? $addClass : '' }} form-group has-feedback {{ $errors && $errors->has($name) ? 'has-error' : '' }}">
    @if (isset($label) && $label)
        <label class="control-label col-md-12 text-semibold">{{ $label }}</label>
    @endif
    <div class="col-md-12 col-sm-12 col-xs-12">
        <select name="{{ $name }}" class="form-control">
            @foreach ($users as $user)
                <option value="{{ $user->id }}" {{ $user->id == $selected ? 'selected' : '' }}>
                    @include('_user_creds_block',['user' => $user])
                </option>
            @endforeach
        </select>

        @if (count($errors) && $errors->has($name))
            <div class="form-control-feedback">
                <i class="icon-cancel-circle2"></i>
            </div>
            <span class="help-block error">{{ $errors->first($name) }}</span>
        @endif
    </div>
</div>