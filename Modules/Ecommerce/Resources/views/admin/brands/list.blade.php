@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.list_breadcrumb')
@section('content')
@include('generals::layouts.admin.pagination.pagination_style')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <div class="card-header border-0">
            @include('generals::layouts.search', ['route' => route($optionsRoutes . '.index')])
            <div class="row">
                @include('generals::layouts.admin.module_name')
                @include('generals::layouts.admin.create-entity-buttom', [$optionsRoutes])
            </div>
        </div>
        @if(Empty(!$brands))
        <table class="table-striped table align-items-center table-flush table-hover text-center">
            @include('generals::layouts.admin.tables.table-headers', [$headers])
            <tbody>
                @foreach ($brands as $data)
                <tr>
                    <td>
                        {{ $data->name }}
                    </td>
                    <td>@include('generals::layouts.status', ['status' => $data->is_active])</td>
                    <td>
                        <a data-toggle="modal" data-target="#covermodal{{ $data->id }}" data-original-title="Ver cover"
                            href="">
                            Ver Logo
                        </a>
                    </td>
                    <td class="text-center">
                        @include('generals::layouts.admin..tables.table_options', [$data, 'optionsRoutes' =>
                        $optionsRoutes])
                    </td>

                    <div class="modal fade" id="covermodal{{ $data->id }}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <div class="row w-100">
                                        <div class="col-12 text-center">
                                            <h2>Logo Marca {{$data->name}}</h2>
                                        </div>
                                    </div>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row text-center">
                                        <div class="col-12 col-md-12 col-sm-12">
                                            <img class="img-fluid lazy" src="{{ asset('storage/'.$data->logo) }}"
                                                alt="{{$data->name}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button aria-describedby="Visualizar cover"
                                        style="color: #fff !important; background-color: #ba3d6b !important"
                                        type="button" class="btn btn-sm" data-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </tr>
                <div class="modal fade" id="modal{{$data->id}}" tabindex="-1" role="dialog"
                    aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Actualizar Marca: <b>{{$data->name}}</b></h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form action="{{ route($optionsRoutes . '.update', $data->id) }}" method="post" class="form"
                                enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="modal-body py-0">
                                    <div class="row">
                                        @if ($data->is_active)
                                        <div class="col-12" id="size_overflow_{{$data->id}}" style="display: none">
                                            <h3>TAMAÑO DE ARCHIVO EXCEDIDO<span style="color: #f5365c;">
                                                    <i class="fas fa-exclamation-circle"></i>
                                                </span></h3>
                                            <p>
                                                El tamaño máximo de todos los archivos a subir debe ser menor o igual a
                                                10MB
                                            </p>
                                            <p>Los archivos que has seleccionado pesan <span
                                                    id="total_size_{{$data->id}}"></span>MB</p>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="color">Nombre</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i
                                                                class="fa fa-font"></i></span>
                                                    </div>
                                                    <input class="form-control" type="text" name="name" id="name"
                                                        value="{{ $data->name }}" required>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-control-label" for="icon{{ $data->id }}">Logo</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"><i
                                                                class="fa fa-file-image"></i></span>
                                                    </div>
                                                    <input type="file" name="logo" id="logo_{{$data->id}}"
                                                        style="color: gray" placeholder="Archivo" class="form-control"
                                                        value="{!! $data->file ?: old('file')  !!}" accept="image/*"
                                                        onchange="AcceptableFileUpload('form_inputs', '0', '{{$data->id}}', 'logo_{{$data->id}}')">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label class="form-control-label"
                                                    for="icon{{ $data->id }}">Activo</label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text"> <i
                                                                class="fa fa-check"></i></span>
                                                    </div>
                                                    @include('generals::layouts.admin.is_active_layout', ['status'
                                                    => $data->is_active])
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="card-footer text-right">
                                    <button type="submit" class="btn btn-primary btn-sm"
                                        id="create_button_{{$data->id}}">Actualizar</button>
                                    <button type="button" class="btn btn-secondary btn-sm"
                                        data-dismiss="modal">Cerrar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                @endforeach
            </tbody>
        </table>

        <div class="card-footer py-2">
            @include('generals::layouts.admin.pagination.pagination', [$skip])
        </div>
        @else
        <p class="alert alert-warning">Ninguna Marca Creada aún <a href="{{ route('admin.brands.create') }}">Crea
                una!</a>
        </p>
        @include('generals::layouts.admin.pagination.pagination_null', [$skip])
        @endif
    </div>
</section>
@include('generals::layouts.admin.files.size_calculatorJS')
@endsection
