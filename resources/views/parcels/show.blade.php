@extends('layouts.master')

@section('title')
     Parcel
@endsection

@section('heading')
    <a href="{{ route('parcels.list') }}" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm"><i class="fa-thin fa-backward"></i>List</a>
    <h1 class="h5 mb-0 text-gray-800">Parcel {{$parcel->reference}}</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i
            class="fas fa-download fa-sm text-white-50"></i>Label</a>
@endsection

@section('content')
    <component-parcel-show :parcel="{{ $parcel->toJson() }}"></component-parcel-show>
@endsection
