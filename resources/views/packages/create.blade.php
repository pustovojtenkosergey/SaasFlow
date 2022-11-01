@extends('layouts.master')

@section('title')
    Create Package
@endsection


@section('heading')
    <a href="{{ route('packages.list') }}" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm">List</a>
@endsection

@section('content')
    <package-form
        :from="'{{ $from }}'"
        :to="'{{ $to }}'"
        :services="{{ $services->toJson() }}"
        :currencies="{{ $currencies->toJson() }}"
        :countries="{{ $countries->toJson() }}"
        :store-route="'{{ route('packages.store') }}'"
        :random-contact-route="'{{ route('contact.random') }}'"
    >
@endsection
