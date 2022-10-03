@extends('layouts.master')

@section('title')
    Parcel
@endsection


@section('heading')
    <a href="{{ route('parcels.list') }}" class="d-none d-sm-inline-block btn btn-sm btn-info shadow-sm"><i class="fa-thin fa-backward"></i>List</a>
@endsection

@section('content')
    <component-parcel-form
        :users="{{ $users->toJson() }}"
        :services="{{ $services->toJson() }}"
        :label-formats="{{ $labelFormats->toJson() }}"
        :currencies="{{ $currencies->toJson() }}"
        :countries="{{ $countries->toJson() }}"
        :store-route="'{{ route('parcels.store') }}'"
    >

    </component-parcel-form>
@endsection
