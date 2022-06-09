@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.list_breadcrumb')
@section('content')
@include('generals::layouts.admin.pagination.pagination_style')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <div class="card-header border-0">
            <div class="row">
                <div class="col-12">
                    @include('generals::layouts.searchStatus', ['route' => route($optionsRoutes . '.index')])
                </div>
            </div>
            <div class="row">
                @include('generals::layouts.admin.module_name')
                @include('generals::layouts.admin.create-entity-buttom', [$optionsRoutes])
            </div>
        </div>
        @if(!$chaseTransferTrms->isEmpty())
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover">
                @include('generals::layouts.admin.tables.table-headers', [$headers])
                <tbody>
                    @foreach($chaseTransferTrms as $data)
                    <tr>
                        <td class="text-center">$ {{ number_format($data->trm, 2) }}</td>
                        <td class="text-center">{{ $data->bank->name }}</td>
                        <td class="text-center">{{ $data->user }}</td>
                        <td class="text-center">@include('generals::layouts.status', ['status' => $data->is_active])
                        <td class="text-center">{{ $data->updated_at->format('M d, Y h:i a') }}</td>
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
                                    <h5 class="modal-title">Actualizar <b>TRM</b></h5>
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
                                                    <label class="form-control-label" for="trm">Factor de TRM</label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-search-dollar"></i></span>
                                                        </div>
                                                        <input type="text" name="trm" id="trm" validation-pattern="name"
                                                            placeholder="TRM" class="form-control"
                                                            value="{{ old('trm') }}" required>
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
        <div class="card-footer py-2">
            {{ $chaseTransferTrms->appends(request()->query())->links() }}
        </div>
    </div>
    @else
    @include('generals::layouts.admin.pagination.pagination_null')
    @endif
</section>
@endsection
