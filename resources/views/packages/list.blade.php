@extends('layouts.master')

@section('title')
     Package list
@endsection

@section('heading')
    <h1 class="h3 mb-0 text-gray-800">List</h1>
{{--    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i--}}
{{--            class="fas fa-download fa-sm text-white-50"></i> Generate Report</a>--}}
    <a href="{{ route('packages.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
        <i class="fa-solid fa-plus text-white-50"></i> Create</a>
@endsection

@section('content')
    <packages-list
        :fetch-route="'{{ route('packages.list.fetch') }}'"
        :group-route="'{{ route('package_groups.create') }}'"
    ></packages-list>
@endsection
