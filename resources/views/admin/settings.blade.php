@extends('layouts.admin')

@section('content')
    <div class="panel panel-flat">
        @include('admin._panel_title_block',['title' => trans('admin.settings'), 'h' => 4])
        <div class="panel-body">
            <form class="form-horizontal" action="{{ url('/admin/settings') }}" method="post">
                {{ csrf_field() }}

                <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            <div class="panel-body">
                                @include('_input_block', [
                                    'label' => trans('admin.main_email'),
                                    'name' => 'email',
                                    'type' => 'email',
                                    'max' => 100,
                                    'placeholder' => trans('auth._email'),
                                    'value' => Settings::getSettings()->email
                                ])
                            </div>
                        </div>
                    </div>
                </div>
                @include('admin._save_button_block')
            </form>
        </div>
    </div>
@endsection