@extends('generals::layouts.admin.app')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="row">
        <div class="col-12 col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12">
            <ol class="breadcrumb">
                <li><a href="{{ route('admin.dashboard') }}"> <i class="fa fa-home"></i> Dashboard</a><span
                        class="divider"></span>
                </li>
                <li><a href="{{ route('admin.pqrs.index') }}">Pqrs</a><span class="divider"></span>
            </ol>
        </div>
    </div>
    <div class="box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
        <div class="box-body">
            <h2>{{ $pqr->name }} ({{ $pqr->pqr }}) <p class="text-center label"
                    style="color: #ffffff; background-color: {{ $currentStatus->color }}"
                    class="btn btn-info btn-block">{{ $currentStatus->name }}</p>
            </h2>
            <table class="table-striped table">
                <thead>
                    <tr>
                        <th class="text-center" scope="col">Documento Identificación</th>
                        <th class="text-center" scope="col">Email</th>
                        <th class="text-center" scope="col">Teléfono</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">{{ $pqr->cedula }}</td>
                        <td class="text-center">{{ $pqr->email }}</td>
                        <td class="text-center">{{ $pqr->phone }}</td>
                    </tr>
                </tbody>
                <thead>
                    <tr>
                        <th class="text-center" scope="col">Ciudad</th>
                        <th class="text-center" scope="col">Asunto</th>
                        <th class="text-center" scope="col">Mensaje</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="text-center">{{ $city->name }}</td>
                        <td class="text-center">{{ $pqr->asunto }}</td>
                        <td class="text-center">{{ $pqr->mensaje }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="row">
                <div class="col">
                    <form action="{{ route('admin.pqrs.destroy', $pqr['id']) }}" method="post" class="form-horizontal">
                        @csrf
                        <input type="hidden" name="_method" value="delete">
                        <div class="btn-group">
                            <a href="{{ route('admin.pqrs.edit', $pqr['id']) }}" class="btn btn-primary btn-sm"><i
                                    class="fa fa-edit"></i> Editar</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        @include('generals::layouts.admin.commentaries', ['datas' => $pqrcommentaries])
        @include('layouts.admin.statusesLog', ['datas' => $pqrsStatusesLogs])
    </div>
    <div id="commentmodal" class="modal fade modalAuth">
        <div class="modal-dialog modal-sm  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Ingresa el comentario</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <div class="box">
                        <form action="{{ route('admin.pqrCommentaries.store') }}" method="post" class="form"
                            enctype="multipart/form-data" onsubmit="disable_button('create_button_')">
                            <div class="box-body">
                                @csrf
                                <div class="form-group hidden">
                                    <input type="text" name="pqr_id" id="pqr_id" placeholder="Comentario"
                                        class="form-control" value="{{ $pqr->id }}">
                                </div>
                                <div class="form-group">
                                    <label for="commentary">Comentario <span class="text-danger">*</span></label>
                                    <input type="text" name="commentary" id="commentary" placeholder="Comentario"
                                        class="form-control" value="{{ old('commentary') }}" required>
                                </div>
                                <div class="form-group hidden">
                                    <label for="user">Auth<span class="text-danger"></span></label>
                                    <input type="text" name="user" id="user" placeholder="commentauth"
                                        class="form-control" value=" {{ $user->name }}">
                                </div>
                            </div>
                            <div class="box-footer">
                                <div class="btn-group">
                                    <button type="submit" class="btn btn-primary" id="create_button_">Crear</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
    </div>
</section>
@endsection