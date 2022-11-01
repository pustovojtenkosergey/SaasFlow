@extends('layouts.master')

@section('title')
    Create Package Group
@endsection


@section('heading')
{{--    <a href="{{ route('packages.list') }}" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm">List</a>--}}
@endsection

@section('content')

    @foreach($packages as $package)
        <p>
            {{ $package->reference }}
        </p>
    @endforeach

@endsection
