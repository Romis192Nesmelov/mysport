@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin._panel_title_block',['title' => trans('admin.advertising_banners'), 'h' => 2])
        <div class="panel-body">
            <form class="form-horizontal" enctype="multipart/form-data" action="{{ url('/admin/banners') }}" method="post">
                {{ csrf_field() }}
                @include('admin._adver_banner_block',['col' => 4, 'num' => 3])
                @include('admin._adver_banner_block',['col' => 8, 'num' => 1])
                @include('admin._adver_banner_block',['col' => 8, 'num' => 2])
                @include('admin._save_button_block')
            </form>
        </div>
    </div>
@endsection