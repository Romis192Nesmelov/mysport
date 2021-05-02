{{ csrf_field() }}
@include('_modal_delete_block',['modalId' => 'delete-record-'.$objectName.'-modal', 'function' => url('admin/delete-record-event'), 'head' => trans('content.confirm_delete_record')])

@php ob_start(); @endphp

<table class="table datatable-basic users-list">
    <tr>
        <th></th>
        <th>{{ trans('content.user') }}</th>
        <th>{{ trans('content.born_date') }}</th>
        <th>{{ trans('content.delete_participant') }}</th>
    </tr>
    @foreach ($records as $record)
        @php $user = $record->user_id ? $record->user : $record->kid; @endphp
        <tr id="{{ $objectName.'_'.$record->id }}">
            <td>@include('layouts._avatar_block',['avatar' => $user->avatar, 'usePreview' => true])</td>
            <td>{{ Helper::userCreds($user, true) }}</td>
            <td class="born-date">{{ date('d.m.Y',$user->born) }}</td>
            <td class="delete">
                @if ( !($record instanceof App\EventsRecord) || ($record->event->start_time > time()) )
                    <span del-data="{{ $record->id }}" modal-data="delete-record-{{ $objectName }}-modal" class="glyphicon glyphicon-remove-circle"></span>
                @endif
            </td>
        </tr>
    @endforeach
</table>

@include('_credentials_block',[
    'colMd' => 12,
    'colSm' => 12,
    'description' => trans('content.participants'),
    'credential' => ob_get_clean()
])

<script>window.dtColumns = 3;</script>