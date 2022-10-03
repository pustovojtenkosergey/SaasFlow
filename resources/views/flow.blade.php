@extends('layouts.master')

@section('title')
     Flow
@endsection

@section('heading')
    <h1 class="h3 mb-0 text-gray-800">All flow</h1>
@endsection

@section('content')
    <component-flow-list :json-list="'{{ json_encode($list) }}'"></component-flow-list>
@endsection
