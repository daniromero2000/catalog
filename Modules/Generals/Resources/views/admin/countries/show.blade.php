@extends('generals::layouts.admin.app')
@section('header')
<div class="header pb-2">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" active aria-current="page">Países</li>
                            <li class="breadcrumb-item active">{{ $country->name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')

<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <div class="card-header">
            <h2>{{ $country->name }}</h2>
            <a href="{{ route('admin.countries.index') }}" class="btn btn-default btn-sm mb-2">Regresar</a>
        </div>
        <table class="table-striped table">
            @include('generals::layouts.admin.tables.table-headers', [$headers])
            <tbody>
                <tr>
                    <td class="text-center">{{ $country->iso }}</td>
                    <td class="text-center">{{ $country->iso3 }}</td>
                    <td class="text-center">{{ $country->numcode }}</td>
                    <td class="text-center">{{ $country->phonecode }}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="card">
        <div class="card-header">
            <h2>Departamentos</h2>
        </div>
        @if($provinces)
        @include('generals::admin.shared.provinces', ['country' => $country->id])

        <div class="card-footer py-2">
            @include('generals::layouts.admin.pagination.pagination_provinces', [$skip])
        </div>
        @else
        @include('generals::layouts.admin.pagination.pagination_null', [$skip])
        @endif
    </div>
</section>
@endsection
