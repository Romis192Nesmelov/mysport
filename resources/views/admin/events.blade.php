@extends('layouts.admin')
@section('content')
    <div class="panel panel-flat">
        @include('admin._panel_title_block',['title' => trans('admin.events')])
        <div class="panel-body">
            @if (count($data['items']))
                {{ csrf_field() }}
                @include('_modal_delete_block',['modalId' => 'delete-event-modal', 'function' => url('admin/delete-event'), 'head' => trans('admin.do_you_want_to_delete_event')])
                <table class="table datatable-basic table-items">
                    <tr>
                        <th class="text-center">{{ trans('content.name') }}</th>
                        <th class="text-center">{{ trans('content.description') }}</th>
                        <th class="text-center">{{ trans('admin.start_end') }}</th>
                        <th class="text-center">{{ trans('auth.status') }}</th>
                        <th class="text-center">{{ trans('admin.edit') }}</th>
                        <th class="text-center">{{ trans('admin.del') }}</th>
                    </tr>
                    @foreach ($data['items'] as $event)
                        <tr class="data" role="row" id="{{ 'event_'.$event->id }}">
                            <td class="text-center name">{{ $event['name_'.App::getLocale()] }}</td>
                            <td class="text-left">{!! $event['description_'.App::getLocale()] !!}</td>
                            <td class="text-center"><nobr>{{ date('d.m.Y',$event->start_time).' - '.date('d.m.Y',$event->end_time) }}</nobr></td>
                            <td class="text-center">
                                @include('admin._status_simple_block',[
                                    'status' => $event->active,
                                    'trueLabel' => trans('admin.event_active'),
                                    'falseLabel' => trans('admin.event_not_active')
                                ])
                            </td>
                            @include('admin._edit_on_table_block',['method' => 'events', 'slug' => $event->slug])
                            <td class="delete"><span del-data="{{ $event->id }}" modal-data="delete-event-modal" class="glyphicon glyphicon-remove-circle"></span></td>
                        </tr>
                    @endforeach
                </table>
            @else
                <h4 class="text-center">{{ trans('content.no_data') }}</h4>
            @endif
        </div>
        <div class="panel-body">
            @include('admin._add_button_block',['href' => 'events/add', 'text' => trans('admin.add_event')])
        </div>
    </div>
@endsection