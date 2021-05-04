@extends('layouts.admin')
@section('content')
    @include('_modal_delete_block',['modalId' => 'delete-message-modal', 'function' => url('admin/delete-message'), 'head' => trans('admin.do_you_want_to_delete_message')])
    {{ csrf_field() }}
    <div class="panel panel-flat">
        @include('admin._panel_title_block',['title' => trans('admin.messages')])
        <div class="panel-body">
            @if (count($data['messages']))
                <table class="table datatable-basic table-items">
                    <tr>
                        <th class="text-center">{{ trans('admin.content') }}</th>
                        <th class="text-center">{{ trans('auth.status') }}</th>
                        <th class="text-center">{{ trans('admin.link') }}</th>
                        <th class="text-center">{{ trans('admin.created_at') }}</th>
                        <th class="text-center">{{ trans('admin.read_at') }}</th>
                        <th class="text-center">{{ trans('admin.del') }}</th>
                    </tr>
                    @foreach ($data['messages'] as $message)
                        <tr class="data" role="row" id="{{ 'message_'.$message->id }}">
                            <td class="text-center name">{{ trans('mail.new_trainer_request') }}</td>
                            <td class="text-center">
                                @include('admin._status_simple_block',[
                                    'status' => $message->read,
                                    'trueLabel' => trans('admin.has_read'),
                                    'falseLabel' => trans('admin.has_not_read')
                                ])
                            </td>
                            <td class="edit"><a href="{{ url('/admin/users?id='.$message->trainer->user->id) }}"><i class="icon-link"></i></a></td>
                            <td class="text-center">{{ $message->created_at->format('d.m.Y') }}</td>
                            <td class="text-center">{{ $message->updated_at->format('d.m.Y') }}</td>
                            @include('admin._delete_on_table_block',['method' => 'delete-message-modal', 'id' => $message->id])
                        </tr>
                    @endforeach
                </table>
            @else
                <h4 class="text-center">{{ trans('content.no_data') }}</h4>
            @endif
        </div>
    </div>
@endsection