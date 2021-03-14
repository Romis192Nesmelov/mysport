@extends('layouts.admin')
@section('content')
    @include('_modal_delete_block',['modalId' => 'delete-user-modal', 'function' => url('admin/delete-user'), 'head' => trans('admin.do_you_want_to_delete_user')])
    {{ csrf_field() }}
    <div class="panel panel-flat">
        @include('_panel_title_block',['title' => trans('admin.users')])
        <div class="panel-body">
            @if (count($data['users']))
                <table class="table datatable-basic table-items">
                    <tr>
                        <th class="text-center">{{ trans('auth.avatar') }}</th>
                        <th class="text-center">{{ trans('auth.user') }}</th>
                        <th class="text-center">{{ trans('admin.user_type') }}</th>
                        <th class="text-center">{{ trans('auth.register_date') }}</th>
                        <th class="text-center">{{ trans('auth.status') }}</th>

                        <th class="text-center">{{ trans('auth.rating') }}</th>

                        <th class="text-center">{{ trans('content.edit') }}</th>
                        <th class="text-center">{{ trans('content.del') }}</th>
                    </tr>
                    @foreach ($data['users'] as $user)
                        <tr class="data" role="row" id="{{ 'user_'.$user->id }}">
                            <td class="image text-center">
                                <div class="avatar">
                                    @if ($user->avatar)
                                        <img src="{{ asset($user->avatar) }}" />
                                    @endif
                                </div>
                            </td>
                            <td class="text-center">@include('_user_creds_block',['user' => $user])</td>
                            <td class="text-center">@include('_status_multiply_block',['status' => $user->type-1, 'statuses' => [
                                    trans('auth.admin'),
                                    trans('auth.employee'),
                                    trans('auth.employer')
                                ]])
                            </td>
                            <td class="text-center">{{ $user->created_at->format('d.m.Y') }}</td>
                            <td class="text-center">@include('_status_simple_block',['status' => $user->active, 'trueLabel' => trans('content.active'), 'falseLabel' => trans('content.not_active')])</td>
                            <td class="text-center">{{ $user->rating }}</td>
                            <td class="edit"><a href="{{ url('/admin/users?id='.$user->id) }}"><i class="icon-pencil5"></i></a></td>
                            <td class="delete"><span del-data="{{ $user->id }}" modal-data="delete-user-modal" class="glyphicon glyphicon-remove-circle"></span></td>
                        </tr>
                    @endforeach
                </table>
            @else
                <h4 class="text-center">{{ trans('content.no_data') }}</h4>
            @endif

            @include('admin._add_button_block',['href' => 'users/add', 'text' => trans('admin.add_user')])
        </div>
    </div>
@endsection