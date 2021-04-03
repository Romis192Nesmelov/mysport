<div class="panel panel-flat">
    @include('admin._panel_title_block',['title' => trans('admin.'.$objectName.'s')])
    <div class="panel-body">
        @if (count($users))
            {{ csrf_field() }}
            @include('_modal_delete_block',['modalId' => 'delete-'.$objectName.'-modal', 'function' => url('admin/delete-'.$objectName), 'head' => trans('admin.do_you_want_to_delete_'.$objectName)])
            <table class="table datatable-basic table-items">
                @include('admin._users_table_header_block')
                @foreach ($users as $user)
                    @include('admin._users_table_row_block')
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