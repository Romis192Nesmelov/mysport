@php $name = 'user_id'; @endphp
@if (isset($label) && $label)
    <div class="description input-label">{{ $label }}</div>
@endif
<div class="form-group has-feedback {{ $errors && $errors->has($name) ? 'has-error' : '' }}">
    <select name="{{ $name }}" class="form-control">
        @foreach ($users as $user)
            <option value="{{ $user->id }}" {{ (!count($errors) ? $user->id == $selected : $user->id == old($name)) ? 'selected' : '' }}>{{ Helper::userCreds($user, true) }}</option>
        @endforeach
    </select>
    @include('_input_error_block')
</div>