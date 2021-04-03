@extends('layouts.admin')
@section('content')
    @include('admin._users_table_block',['users' => $data['users'], 'objectName' => 'user'])
@endsection