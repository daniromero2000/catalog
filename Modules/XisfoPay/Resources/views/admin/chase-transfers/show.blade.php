@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.list_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <div class="card card-header">
            <div class="row row-reset">
                <div class="col-12 col-md-6 text-left">
                    <h3 class="mb-0"><strong>GIRO CHASE {{ $chaseTransfer->id}} - {{ $chaseTransfer->created_at->format('M d, Y h:i a')}}</strong>
                </div>
                @if ($chaseTransfer->is_approved != 1)
                <div class="col-12 col-md-6 text-right">
                    <button type="button" class="btn btn-default btn-sm">
                        <a class="text-white" href="{{ asset('downloadables/plantilla_giros.xlsx') }}">
                            Descargar plantilla de cargue de giros <i class="fas fa-file-download"></i>
                        </a>
                    </button>
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-default btn-sm my-2" data-toggle="modal"
                        data-target="#uploadChaseTransferAmountsModal">
                        Importar giros plataforma <i class="fas fa-file-import"></i>
                    </button>
                    <!-- Modal -->
                    <div class="modal fade" id="uploadChaseTransferAmountsModal" tabindex="-1" role="dialog"
                        aria-labelledby="uploadChaseTransferAmountsModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="uploadChaseTransferAmountsModalLabel">Importar giros
                                        plataformas</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('admin.chase-transfer-amounts.store')}}" method="post" class="form" enctype="multipart/form-data">
                                    @csrf
                                    <div class="modal-body pt-0 text-center">
                                        @if ($chaseTransfer->chaseTransferAmounts->isNotEmpty())
                                        <div class="text-center mb-2">
                                            <span class="text-warning ">Ya hay transferencias cargadas, si vuelves a 
                                                cargar un archivo se borraran las transferencias actuales para este 
                                                giro
                                            </span>
                                        </div>
                                        @endif
                                        <input type="hidden" name="chase_transfer_id" value="{{$chaseTransfer->id}}">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="customFileLang"></label>
                                                <input type="file" name="file" required
                                                    id="customFileLang" lang="es"
                                                    accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal-footer pt-0">
                                        <button type="submit" class="btn btn-default btn-sm">Importar</button>
                                        <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal">Close</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @else
                @endif
            </div>
        </div>
        <div class="card-body py-0">
            <div class="card">
                <div class="w-100">
                    <div class="table-responsive">
                        <table class="table-striped table align-items-center table-flush table-hover text-center">
                            @include('generals::layouts.admin.tables.table-headers', [$headers])
                            <tbody class="list">
                                <tr>
                                    <td class="text-center">$ {{ number_format($chaseTransfer->transfer_amount, 2) }} USD /
                                        $ {{ number_format($chaseTransfer->chaseTransferAmounts->sum('amount'), 2) }} USD </td>
                                    <td class="text-center">$ {{ number_format($chaseTransfer->commission, 2) }}
                                    </td>    
                                    <td class="text-center">$ {{ number_format($chaseTransfer->chaseTransferTrm->trm, 2) }}
                                    </td>
                                    <td class="text-center">${{ number_format($chaseTransfer->paymentRequests->sum('commission'), 2) }} USD</td>
                                    <td class="text-center">${{ number_format($chaseTransfer->paymentRequests->sum('real_commission'), 2) }} USD</td>
                                    <td class="text-center">@include('generals::layouts.status', ['status' =>
                                        $chaseTransfer->is_active])
                                        @include('generals::layouts.status', ['status' => $chaseTransfer->is_approved])
                                    </td>
                                    <td class="text-center">
                                        <a data-toggle="modal" data-target="#modal{{ $chaseTransfer->id }}" href="" class="table-action table-action"
                                            data-toggle="tooltip" data-original-title="">
                                            <i class="fas fa-edit"></i></a>
                                    </td>
                                    @include('xisfopay::layouts.chase-transfers.edit_chase_transfer_modal')
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                    <span class="h3 mb-0">
                        Montos de Giro
                    </span> 
                </div>
                @if ($chaseTransfer->chaseTransferAmounts->isNotEmpty())
                <div class="w-100">
                    <div class="table-responsive">
                        <table class="table-striped table align-items-center table-flush table-hover text-center">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Fecha de creación</th>
                                    <th scope="col">Monto</th>
                                    <th scope="col">Plataforma</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach ($chaseTransfer->chaseTransferAmounts as $chaseTransferAmount)
                                <tr>
                                        <td class="text-center"> {{ $chaseTransferAmount->created_at->format('M d, Y h:i a')}}</td>
                                        <td class="text-center"> $ {{ $chaseTransferAmount->amount }} USD </td>
                                        <td class="text-center"> {{ $chaseTransferAmount->streaming->streaming }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @else
                    <span class="text-sm m-3">No hay montos de giro ingresados</span>
                @endif
            </div>
            <div class="card">
                <div class="card-header">
                    <span class="h3 mb-0">
                        Pagos del Giro
                    </span> 
                </div>
                @if ($chaseTransfer->paymentRequests->isNotEmpty())
                <div class="w-100">
                    <div class="table-responsive">
                        <table class="table-striped table align-items-center table-flush table-hover text-center">
                            <thead class="thead-light">
                                <tr>
                                    <th scope="col">Fecha de creación</th>
                                    <th scope="col">Cuenta Master</th>
                                    <th scope="col">Monto</th>
                                    <th scope="col">Comisión comercial</th>
                                    <th scope="col">Comisión real</th>
                                </tr>
                            </thead>
                            <tbody class="list">
                                @foreach ($chaseTransfer->paymentRequests as $paymentRequest)
                                <tr>
                                    <td class="text-center"> {{ $paymentRequest->created_at->format('M d, Y h:i a')}}</td>
                                    <td class="text-center">
                                        {{ $paymentRequest->contractRequestStreamAccount->contractRequest->customerCompany->company_legal_name }}
                                        - {{ $paymentRequest->contractRequestStreamAccount->nickname }} -
                                        {{ $paymentRequest->contractRequestStreamAccount->streaming->streaming }}
                                    </td>
                                    <td class="text-center"> $ {{ $paymentRequest->usd_amount }} USD </td>
                                    <td class="text-center"> $ {{ $paymentRequest->commission }} USD </td>
                                    <td class="text-center"> $ {{ $paymentRequest->real_commission }} USD </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @else
                    <span class="text-sm m-3">No hay solicitudes de pago asignadas</span>
                @endif
            </div>
        </div>
        <div class="card-footer">
            <div class="row ml-4 mb-0">
                <a href="{{ route($optionsRoutes . '.index') }}" class="btn btn-default btn-sm">Regresar</a>
            </div>
        </div>
    </div>
    @endsection
