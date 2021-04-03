@extends('layouts.admin')
@section('content')
    @include('admin._objects_table',['objects' => $data['items'], 'objectName' => 'organization'])
@endsection