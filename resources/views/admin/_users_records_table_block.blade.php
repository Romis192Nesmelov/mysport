@php $exceptIds = []; @endphp
<div class="panel panel-flat">
    @include('admin._panel_title_block',['title' => trans('admin.'.$objectName.'s_hy_recorded')])
    <div class="panel-body">
        @if (count($data['item']->records))
            {{ csrf_field() }}
            @include('_modal_delete_block',['modalId' => 'delete-record-'.$objectName.'-modal', 'function' => url('admin/delete-record-'.$recordName), 'head' => trans('content.confirm_delete_record')])
            <table class="table datatable-basic table-items">
                @include('admin._users_table_header_block', ['parent' => $objectName == 'kid','deleteName' => trans('admin.delete_record')])
                @foreach ($data['item']->records as $record)
                    @if (isset($record[$objectName.'_id']))
                        @php $exceptIds[] = $record[$objectName.'_id']; @endphp
                        @include('admin._users_table_row_block', [
                                                                     'user' => $record[$objectName],
                                                                     'objectName' => 'record-'.$objectName,
                                                                     'parent' => $objectName == 'kid' ? $record[$objectName]->user_id : false,
                                                                     'deleteId' => $record->id
                                                                 ])
                    @endif
                @endforeach
            </table>
        @else
            <h4 class="text-center">{{ trans('content.no_data') }}</h4>
        @endif
    </div>
    <div class="panel-body">
        @if (count($data['collections'][$objectName.'s']) > count($exceptIds))
            @php
                $modalId = 'add-record-'.$recordName.'-'.$objectName;
                $users = $data['collections'][$objectName.'s'];
                for ($u=0;$u<count($users);$u++) {
                    if (in_array($users[$u]->id,$exceptIds)) unset($users[$u]);
                }
            @endphp
            @include('admin._record_user_modal_block',[
                'action' => 'record-'.$recordName.'-'.$objectName,
                'users' => $users,
                'id' => $modalId
            ])
            @include('admin._add_button_block',['href' => $modalId, 'btnModalType' => true, 'text' => trans('admin.add_record_'.$objectName)])
        @endif
    </div>
</div>