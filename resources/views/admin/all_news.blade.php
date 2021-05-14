@extends('layouts.admin')
@section('content')
    @include('_modal_delete_block',['modalId' => 'delete-news-modal', 'function' => url('admin/delete-news'), 'head' => trans('admin.do_you_want_to_delete_news')])
    {{ csrf_field() }}
    <div class="panel panel-flat">
        @include('admin._panel_title_block',['title' => trans('admin.news')])
        <div class="panel-body">
            @if (count($data['all_news']))
                <table class="table datatable-basic table-items">
                    <tr>
                        <th class="text-center">{{ trans('content.image') }}</th>
                        <th class="text-center">{{ trans('content.head') }}</th>
                        <th class="text-center">{{ trans('admin.content') }}</th>
                        <th class="text-center">{{ trans('auth.status') }}</th>
                        <th class="text-center">{{ trans('admin.edit') }}</th>
                        <th class="text-center">{{ trans('admin.del') }}</th>
                    </tr>
                    @foreach ($data['all_news'] as $news)
                        <tr class="data" role="row" id="{{ 'news_'.$news->id }}">
                            @include('admin._image_on_table_block',['image' => $news->image])
                            <td class="text-left name">{{ $news['head_'.App::getLocale()] }}</td>
                            <td class="text-left">{!! $news['content_'.App::getLocale()] !!}</td>
                            <td class="text-center">
                                @include('admin._status_simple_block',[
                                    'status' => $news->active,
                                    'trueLabel' => trans('admin.news_active'),
                                    'falseLabel' => trans('admin.news_not_active')
                                ])
                            </td>
                            @include('admin._edit_on_table_block',['method' => 'news', 'id' => $news->id])
                            @include('admin._delete_on_table_block',['method' => 'delete-news-modal', 'id' => $news->id])
                        </tr>
                    @endforeach
                </table>
            @else
                <h4 class="text-center">{{ trans('content.no_data') }}</h4>
            @endif
        </div>
        <div class="panel-body">
            @include('admin._add_button_block',['href' => 'news/add', 'text' => trans('admin.add_news')])
        </div>
    </div>
@endsection