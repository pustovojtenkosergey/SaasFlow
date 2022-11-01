@php
    /**
     * @var \App\Models\Package $package
     */
@endphp
@extends('layouts.master')

@section('title')
     Package {{$package->track_number}}
@endsection

@section('heading')
    <a href="{{ route('packages.list') }}" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm"><i class="fa-thin fa-backward"></i>List</a>
    <h1 class="h5 mb-0 text-gray-800">{{$package->track_number}}</h1>
    <a href="{{ route('package.label.download', ['trackNumber' => $package->track_number]) }}"
       class="d-none d-sm-inline-block btn btn-sm btn-success shadow-sm">
        <i class="fas fa-download fa-sm text-white-50"></i>Download label</a>
@endsection

@section('content')
    <package-show
        :package="{{ $package->toJson() }}" label-url="{{ route('package.label.get', ['trackNumber' => $package->track_number]) }}"
    >
    </package-show>
@endsection
