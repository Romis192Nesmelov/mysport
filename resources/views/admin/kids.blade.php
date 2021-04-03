@extends('layouts.admin')
@section('content')
    @include('admin._users_table_block',['users' => $data['kids'], 'objectName' => 'kid', 'parent' => true])
@endsection