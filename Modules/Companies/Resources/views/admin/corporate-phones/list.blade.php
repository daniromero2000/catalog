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
        @if(!$corporatePhones->isEmpty())
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover">
                @include('generals::layouts.admin.tables.table-headers')
                <tbody class="list">
                    @foreach($corporatePhones as $data)
                    <tr>
                        <td class="text-center">{{ $data->id }}</td>
                        <td class="text-center">{{ $data->simcard_number }}</td>
                        <td class="text-center">{{ $data->operator }}</td>
                        <td class="text-center">{{ $data->phone }}</td>
                        <td class="text-center">
                            @include('generals::layouts.admin.tables.table_options', [$data, 'optionsRoutes' =>
                            $optionsRoutes])
                        </td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="modal{{$data->id}}" tabindex="-1" role="dialog"
                        aria-labelledby="modelTitleId" aria-hidden="true">
                        <div class="modal-dialog modal-sm" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Actualizar Teléfono Corporativo</h5>
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
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="simcard_number">Número de
                                                        Simcard</label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-hashtag"></i></span>
                                                        </div>
                                                        <input type="text" name="simcard_number" id="simcard_number"
                                                            validation-pattern="simcard_number" class="form-control"
                                                            value="{{  $data->simcard_number }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="operator">Operador</label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-check"></i></span>
                                                        </div>
                                                        <select name="operator" id="operator" class="form-control">
                                                            <option @if('CLARO'==$data->operator)
                                                                selected="selected" @endif value="CLARO">
                                                                CLARO</option>
                                                            <option @if('TIGO'==$data->operator)
                                                                selected="selected" @endif value="TIGO">TIGO
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="phone">Número de
                                                        Teléfono<span class="text-danger">*</span></label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-hashtag"></i></span>
                                                        </div>
                                                        <input type="text" name="phone" id="phone"
                                                            validation-pattern="phone" class="form-control"
                                                            value="{{  $data->phone }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label class="form-control-label"
                                                        for="description">Descripción</label>
                                                    <div class="input-group input-group-merge">
                                                        <textarea class="form-control" name="description"
                                                            id="description">{{  $data->description }}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                        <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
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
        </div>
        <div class="card-footer py-2">
            @include('generals::layouts.admin.pagination.pagination', [$skip])
        </div>
    </div>
    @else
    @include('generals::layouts.admin.pagination.pagination_null', [$skip, $optionsRoutes])
    @endif
</section>
@endsection
