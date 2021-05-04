@php $name = 'trainer_id'; @endphp
<div class="description input-label">{{ trans('content.trainer') }}</div>
<div class="form-group has-feedback {{ $errors && $errors->has($name) ? 'has-error' : '' }}">
    <select name="{{ $name }}" class="form-control">
        <option value="0">{{ trans('content.trainer_is_not_defined') }}</option>
        @foreach ($trainers as $trainer)
            <option value="{{ $trainer->id }}" {{ (!count($errors) ? $trainer->id == $selected : $trainer->id == old($name)) ? 'selected' : '' }}>{{ Helper::userCreds($trainer->user, true) }}</option>
        @endforeach
    </select>
    @include('_input_error_block')
</div>