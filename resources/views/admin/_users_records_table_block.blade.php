<div class="panel panel-flat">
    @include('admin._panel_title_block',['title' => trans('admin.'.$objectName.'s_hy_recorded')])
    <div class="panel-body">
        @if (count($data['item']->records) && $data['item']->records[0][$objectName])
            {{ csrf_field() }}
            <table class="table datatable-basic table-items">
                @include('admin._users_table_header_block', [
                                                                'nodel' => true,
                                                                'parent' => $objectName == 'kid'
                                                            ])
                @foreach ($data['item']->records as $record)
                    @include('admin._users_table_row_block', [
                                                                'nodel' => true,
                                                                 'user' => $record[$objectName],
                                                                 'parent' => $objectName == 'kid' ? $record[$objectName]->user_id : false
                                                             ])
                @endforeach
            </table>
        @else
            <h4 class="text-center">{{ trans('content.no_data') }}</h4>
        @endif
    </div>
</div>