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
                            <li class="breadcrumb-item active" active aria-current="page">Atributo</li>
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
        <div class="card-header d-flex justify-content-between">
            <h2>Atributo {{ $attribute->name }}</h2>
            <div class=" text-right">
                <div class="btn-group">
                    <button data-toggle="modal" data-target="#create{{$attribute->id}}"
                        class="btn btn-primary btn-sm"><i class="fa fa-plus"></i> Agregar Valores</button>
                </div>
            </div>
        </div>

        @if(Empty(!$values))
        <table class="table-striped table align-items-center table-flush table-hover text-center">
            <thead class="thead-light">
                <tr>
                    <th>Valores de Atributo</th>
                    @if ($attribute->name == 'Color' )
                    <th>Color</th>
                    @endif
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach($values as $item)
                <tr>
                    <td>{{ $item->value }}</td>
                    @if ($attribute->name == 'Color')
                    <td><span class="badge"
                            style="border: solid 1px #0f0f0f; color: #ffffff; background-color: {{ $item->description }};">
                            {{ $item->description }}
                        </span></td>
                    @endif
                    <td>
                        <div class="btn-group">
                            <button data-toggle="modal" data-target="#update{{$item->id}}"
                                class="table-action button-reset"><i class="fas fa-user-edit"></i></button>
                            <form action="{{ route('admin.attributes-values.destroy',  $item->id) }}"
                                class="form-horizontal" method="post">
                                @csrf
                                <input type="hidden" name="_method" value="delete">
                                <button onclick="return confirm('¿Estás Seguro?')" type="submit"
                                    class="table-action button-reset"><i class="fa fa-trash"></i>
                                </button>
                            </form>
                            <div id="update{{$item->id}}" class="modal fade" tabindex="-1" role="dialog"
                                aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <form action="{{ route('admin.attributesValues', $item->id) }}" method="post"
                                            enctype="multipart/form-data" class="form">
                                            <div class="modal-body">
                                                <div class="row">
                                                    @csrf
                                                    <input type="hidden" name="_method" value="put">
                                                    <div class="col-md-12 text-left">
                                                        <label class="form-control-label" for="value">Valor
                                                            de Atributo<span class="text-danger">*</span></label>
                                                        <div class="input-group input-group-merge">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"> <i
                                                                        class="fa fa-pen"></i></span>
                                                            </div>
                                                            <input type="text" name="value" id="value"
                                                                placeholder="Valor Atributo" class="form-control"
                                                                value="{{ $item->value}}" required>
                                                        </div>
                                                        @if ($attribute->name == 'Color')
                                                        <label class="form-control-label mt-2"
                                                            for="description">Color<span
                                                                class="text-danger">*</span></label>
                                                        <div class="input-group input-group-merge">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"> <i
                                                                        class="fa fa-palette"></i></span>
                                                            </div>
                                                            <input type="color" name="description" class="form-control"
                                                                value="{{ $item->description}}">
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer text-right">
                                                <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                                                <button type="button" class="btn btn-secondary btn-sm"
                                                    data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="card-footer py-2">
            @include('generals::layouts.admin.pagination.pagination_attribute_values', [$skip])
        </div>
        @else
        <p class="alert alert-warning">No hay atributos aún <a href="{{ route('admin.attributes.create') }}">Crear
                uno</a></p>
        @include('generals::layouts.admin.pagination.pagination_null', [$skip])
        @endif
        <div id="create{{$attribute->id}}" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <form action="{{ route('admin.attributes-values.store' ) }}" method="post" class="form">
                        <div class="modal-body">
                            <div class="row">
                                @csrf
                                <input type="hidden" name="attribute_id" value=" {{$attribute->id}} ">
                                <div class="col-md-12">
                                    <h3>Configura un valor para: <strong>{{ $attribute->name }}</strong></h3>
                                    <div>
                                        <label class="form-control-label" for="value">Valor de Atributo<span
                                                class="text-danger">*</span></label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"> <i class="fa fa-pen"></i></span>
                                            </div>
                                            <input type="text" name="value" id="value" placeholder="Valor Atributo"
                                                class="form-control" value="{!! old('value')  !!}" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <button type="submit" class="btn btn-primary btn-sm">Crear</button>
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="card-footer text-right">
            <a href="{{ route('admin.attributes.index') }}" class="btn btn-default btn-sm">Regresar</a>
        </div>
    </div>
</section>
@endsection
