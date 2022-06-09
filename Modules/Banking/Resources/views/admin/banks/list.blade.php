@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.list_breadcrumb')
@section('content')
@include('generals::layouts.admin.pagination.pagination_style')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <div class="card-header border-0">
            @include('generals::layouts.searchNoDates', ['route' => route($optionsRoutes . '.index')])
            <div class="row">
                @include('generals::layouts.admin.module_name')
                @include('generals::layouts.admin.create-entity-buttom', [$optionsRoutes])
            </div>
        </div>
        @if(!$banks->isEmpty())
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover">
                @include('generals::layouts.admin.tables.table-headers', [$headers])
                <tbody>
                    @foreach($banks as $data)
                    <tr>
                        <td class="text-center">{{ $data->name }}</td>
                        <td class="text-center">{{ $data->transfer_rate }}</td>
                        <td class="text-center">{{ $data->draft_rate }}</td>
                        <td class="text-center">@include('generals::layouts.status', ['status' => $data->is_active])
                        </td>
                        <td class="text-center">
                            @include('generals::layouts.admin.tables.table_options', [$data, 'optionsRoutes' =>
                            $optionsRoutes])
                        </td>
                    </tr>
                    <div class="modal fade" id="modal{{$data->id}}" tabindex="-1" role="dialog"
                        aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Actualizar Banco <b>{{$data->name}}</b></h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route($optionsRoutes . '.update', $data->id) }}" method="post"
                                    class="form">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body py-0">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="name">Nombre</label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-font"></i></span>
                                                        </div>
                                                        <input type="text" value="{{ $data->name}}" class="form-control"
                                                            name="name" id="name">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="transer_rate">Tarifa de
                                                        transferencia</label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-dollar-sign"></i></span>
                                                        </div>
                                                        <input type="text" value="{{ $data->transfer_rate}}"
                                                            class="form-control" name="transfer_rate"
                                                            id="transfer_rate">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="transer_rate">Tarifa de
                                                        Giro</label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-dollar-sign"></i></span>
                                                        </div>
                                                        <input type="text" value="{{ $data->draft_rate}}"
                                                            class="form-control" name="draft_rate" id="draft_rate">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="is_active">Activo</label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-check"></i></span>
                                                        </div>
                                                        <select name="is_active" id="is_active" class="form-control">
                                                            @if( 0 == $data->is_active)
                                                            <option selected="selected" value="0">Inactivo</option>
                                                            <option value="1">Activo</option>
                                                            @elseif( 1 == $data->is_active)
                                                            <option selected="selected" value="1">Activo</option>
                                                            <option value="0">Inactivo</option>
                                                            @else
                                                            <option value="0">Inactivo</option>
                                                            <option value="1">Activo</option>
                                                            @endif
                                                        </select>
                                                    </div>
                                                </div>
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
                    @endforeach
                <tbody>
            </table>
        </div>
        <div class="card-footer py-2 text-center">
            {{ $banks->appends(request()->query())->links() }}
        </div>
    </div>
    @else
    @include('generals::layouts.admin.pagination.pagination_null')
    @endif
</section>
@endsection
