<tr class="data" role="row" id="{{ $objectName.'_'.(isset($deleteId) && $deleteId ? $deleteId : $user->id) }}">
    @include('admin._image_on_table_block',['image' => $user->avatar])
    <td class="text-center name">{!! Helper::userCreds($user) !!}</td>
    <td class="text-center">
        @if (isset($parent) && $parent)
            <a href="{{ url('admin/users?id='.$user->parent->id) }}">{!! Helper::userCreds($user->parent) !!}</a>
        @elseif (isset($user->trainer) && $user->trainer)
            <span class="label label-success">{{ trans('admin.trainer') }}</span>
        @elseif (isset($user->type))
            @include('admin._status_multiply_block',['status' => $user->type-1, 'statuses' => [
                trans('admin.admin'),
                trans('admin.organizer'),
                trans('admin.user'),
            ]])
        @endif
    </td>
    <td class="text-center">
        @include('admin._status_simple_block',[
            'status' => $user->active,
            'trueLabel' => trans('admin.'.$objectName.'_active'),
            'falseLabel' => trans('admin.'.$objectName.'_not_active')
        ])
    </td>
    @include('admin._edit_on_table_block',['method' => $objectName.'s', 'id' => $user->id, 'addVars' => isset($parent) && $parent && !is_bool($parent) ? ['user_id' => $user->id] : []])
    @include('admin._delete_on_table_block',['method' => 'delete-'.$objectName.'-modal', 'id' => isset($deleteId) && $deleteId ? $deleteId : $user->id])
</tr>