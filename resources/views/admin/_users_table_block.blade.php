<div class="panel panel-flat">
    @include('admin._panel_title_block',['title' => trans('admin.'.$objectName.'s')])
    <div class="panel-body">
        @if (count($users))
            {{ csrf_field() }}
            @include('_modal_delete_block',['modalId' => 'delete-'.$objectName.'-modal', 'function' => url('admin/delete-'.$objectName), 'head' => trans('admin.do_you_want_to_delete_'.$objectName)])
            <table class="table datatable-basic table-items">
                <tr>
                    <th class="text-center">{{ trans('auth.avatar') }}</th>
                    <th class="text-center">{{ trans('admin.'.$objectName) }}</th>
                    <th class="text-center">{{ isset($parent) && $parent ? trans('admin.parent') : trans('admin.user_type') }}</th>
                    <th class="text-center">{{ trans('auth.status') }}</th>
                    <th class="text-center">{{ trans('admin.edit') }}</th>
                    <th class="text-center">{{ trans('admin.del') }}</th>
                </tr>
                @foreach ($users as $user)
                    <tr class="data" role="row" id="{{ $objectName.'_'.$user->id }}">
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
                        @include('admin._edit_on_table_block',['method' => $objectName.'s', 'id' => $user->id, 'addVars' => isset($parent) && !is_bool($parent) ? ['user_id' => $user->id] : []])
                        @include('admin._delete_on_table_block',['method' => 'delete-'.$objectName.'-modal', 'id' => $user->id])
                    </tr>
                @endforeach
            </table>
        @else
            <h4 class="text-center">{{ trans('content.no_data') }}</h4>
        @endif
    </div>
    <div class="panel-body">
        @include('admin._add_button_block',['href' => 'users/add'.(isset($parent) ? (is_bool($parent) ? '' : '?user_id='.$parent) : ''), 'text' => trans('admin.add_'.$objectName)])
    </div>
</div>