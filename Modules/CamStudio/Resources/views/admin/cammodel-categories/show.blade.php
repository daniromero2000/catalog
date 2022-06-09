@extends('generals::layouts.admin.app')
@section('styles')
<script src="{{ asset('js/ecommerce.js') }}" defer></script>
@endsection
@section('header')
<div class="header pb-2">
    <div class="container-fluid">
        <div class="header-body">
            <div class="row align-items-center py-4">
                <div class="col-lg-6 col-7">
                    <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                        <ol class="breadcrumb breadcrumb-links">
                            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" active aria-current="page">Categoría</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('content')
<section class="content" id="app">
    @include('generals::layouts.errors-and-messages')
    @if($category)
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-6">
                    <h4> Categoría: {{ $category->name }}</h4> <a
                        href="{{route('admin.cammodel-categories.edit', $category->id)}}" class="btn btn-primary btn-sm"
                        data-toggle="tooltip" data-original-title="">
                        <i class="fas fa-user-edit"></i> Editar
                    </a>
                </div>
                <div class="col-6 text-right">
                    <a href="{{ route('admin.categories.index') }}" class="btn btn-default btn-sm">Regresar</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-xl-4 col-lg-4">
                    <p class="text-sm">
                        <b>Descripción: </b>{{ $category->description }}
                    </p>
                </div>
                <div class="col-xl-8 col-lg-8 text-center">
                    @if(isset($category->cover))
                    <img src="{{asset("storage/$category->cover")}}" style="max-height: 300px" alt="category image"
                        class="img-thumbnail">
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if(!$categories->isEmpty())
    <hr>
    <div class="card">
        <div class="card-body">
            <div class="box-body">
                <h2>Sub Categories</h2>
                <div class="table-responsive">
                    <table class="table-striped table">
                        <thead>
                            <tr>
                                <td class="col-md-3">Nombre</td>
                                <td class="col-md-3">Descripción</td>
                                <td class="col-md-3">Cover</td>
                                <td class="col-md-3">Acciones</td>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($categories as $cat)
                            <tr>
                                <td><a href="{{route('admin.categories.show', $cat->id)}}">{{ $cat->name }}</a></td>
                                <td>{{ $cat->description }}</td>
                                <td>@if(isset($cat->cover))<img src="{{asset("storage/$cat->cover")}}"
                                        alt="category image" class="img-thumbnail">@endif</td>
                                <td><a class="btn btn-primary" href="{{route('admin.categories.edit', $cat->id)}}"><i
                                            class="fa fa-edit"></i> Editar</a></td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

            </div>
        </div>
    </div>
    @endif
    @if(!$models->isEmpty())
    <div class="card">
        <div class="card-header">
            <h4>Modelos de esta categoría</h4>
        </div>
        <div class="table-responsive">
            <table class="table-striped table text-center">
                <thead class="thead-light">
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Estado</th>
                    <th>Opciones</th>
                </thead>
                <tbody>
                    @foreach ($models as $cammodel)
                    <tr>
                        <td class="text-center">{{ $cammodel->id }}</td>
                        <td class="text-center">{{ $cammodel->nickname }}</td>
                        <td class="text-center">
                            @include('generals::layouts.status', ['status' => $cammodel->is_active])</td>
                        <td class="text-center">
                            <div class="d-flex justify-content-center">
                                <a href="{{route('admin.cammodels.show', $cammodel->id)}}" class=" table-action table-action"
                                    data-toggle="tooltip" data-original-title="Editar Empleado">
                                    <i class="fas fa-search"></i>
                                </a>
                            </div>
                            {{-- @include('generals::layouts.admin.tables.table_options', [$data, 'optionsRoutes' => $optionsRoutes]) --}}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    {{-- <div class="box-body">
        <div class="card-body">
            <div class="box-body">
                <h2>Productos</h2>
                @include('ecommerce::admin.shared.models', ['models' => $models])
            </div>
        </div>
    </div> --}}
    @endif

    @endif
</section>
@endsection
