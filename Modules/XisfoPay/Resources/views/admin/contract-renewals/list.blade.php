@extends('generals::layouts.admin.app')
@section('styles')
<style>
    .contract-renewal-item {
        background-color: #144294;
        border-radius: 20px;
        color: white;
        padding: 5px 15px;
    }
</style>
@endsection
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
            </div>
        </div>
        @if(!$contractRenewals->isEmpty())
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover">
                <thead class="thead-light">
                    <tr>
                        @foreach ($headers as $header)
                        <th class="text-center">{{ $header }}</th>
                        @endforeach
                        <th class="text-center">Acciones</th>
                    </tr>
                </thead>
                <tbody class="list">
                    @foreach($contractRenewals as $data)
                    <tr>
                        <td class="text-center">@include('generals::layouts.status', ['status' => $data->is_active])
                        </td>
                        <td class="text-center">{{ $data->created_at->format('M d, Y h:i a') }}</td>
                        <td class="text-center">{{ $data->contract->contractRequests[0]->client_identifier }}</td>
                        <td class="text-center">
                            {{ $data->contract->contractRequests[0]->customerCompany->company_legal_name }}
                        </td>
                        <td class="text-center">{{ $data->starts->format('M d, Y') }}</td>
                        <td class="text-center">{{ $data->expires->format('M d, Y') }}</td>
                        <td class="text-center">{{ $data->ContractRate->percentage }}</td>
                        <td class="text-center">@include('generals::layouts.status', ['status' =>
                            $data->is_special_price]) @include('generals::layouts.status', ['status' =>
                            $data->is_aprobed])
                        </td>
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
                                    <h5 class="modal-title">Actualizar Renovación De Contrato - cliente # <br><br><span
                                            class="contract-renewal-item">{{$data->contract->contractRequests[0]->client_identifier}}</span>
                                    </h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route($optionsRoutes . '.update', $data->id) }}" method="post"
                                    class="form">
                                    @csrf
                                    @method('PUT')
                                    <div class="modal-body py-0">
                                        @if (!$data->is_aprobed)
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="starts">Fecha de
                                                        inicio</label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-calendar-week"></i>
                                                            </span>
                                                        </div>
                                                        <input value="{{ $data->starts->format('Y-m-d') }}" type="date"
                                                            class="form-control" name="starts" id="starts"
                                                            placeholder="00/00/0000" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="expires">
                                                        Fecha de expiración
                                                    </label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-calendar-week"></i>
                                                            </span>
                                                        </div>
                                                        <input type="date" value="{{ $data->expires->format('Y-m-d') }}"
                                                            class="form-control" name="expires" id="expires" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="is_aprobed">
                                                        Tarifa especial
                                                    </label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text">
                                                                <i class="fas fa-hand-holding-usd"></i>
                                                            </span>
                                                        </div>
                                                        <select name="is_special_price" id="is_special_price" required
                                                            class="form-control">
                                                            <option @if(0==$data->is_special_price)
                                                                selected="selected" @endif
                                                                value="0">Sin Precio Especial
                                                            </option>
                                                            <option @if(1==$data->is_special_price)
                                                                selected="selected" @endif
                                                                value="1">Con Precio Especial
                                                            </option>
                                                            <option @if(2==$data->is_special_price)
                                                                selected="selected" @endif
                                                                value="2">Tokens
                                                            </option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label class="form-control-label"
                                                            for="is_aprobed">Aprobación</label>
                                                        <div class="input-group input-group-merge">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text">
                                                                    <i class="fas fa-check-double"></i>
                                                                </span>
                                                            </div>
                                                            <select name="is_aprobed" id="is_aprobed"
                                                                class="form-control" required>
                                                                @if( 0 == $data->is_aprobed)
                                                                <option selected="selected" value="0">No Aprobado
                                                                </option>
                                                                <option value="1">Aprobado</option>
                                                                @elseif( 1 == $data->is_aprobed)
                                                                <option selected="selected" value="1">Aprobado</option>
                                                                <option value="0">No Aprobado</option>
                                                                @else
                                                                <option value="0">No Aprobado</option>
                                                                <option value="1">Aprobado</option>
                                                                @endif
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="form-control-label" for="is_aprobed">
                                                    Tarifa de contrato
                                                </label>
                                                <div class="input-group input-group-merge">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">
                                                            <i class="fas fa-tags"></i>
                                                        </span>
                                                    </div>
                                                    <select name="contract_rate_id" id="contract_rate_id"
                                                        class="form-control" required>
                                                        @foreach($contract_rates as $contract_rate)
                                                        <option @if($contract_rate->id ==
                                                            $data->contract_rate_id)
                                                            selected="selected" @endif
                                                            value="{{ $contract_rate->id }}">{{ $contract_rate->percentage }}
                                                        </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <h3 class="mb-0">Ya fue aprobada!!!</h3>
                                        @endif

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
            </table>
        </div>
        <div class="card-footer py-2 text-center">
            {{ $contractRenewals->appends(request()->query())->links() }}
        </div>
    </div>
    @else
    @include('generals::layouts.admin.pagination.pagination_null')
    @endif
</section>
@endsection
