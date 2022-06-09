<div class="card">
    <div class="card-body">
        <div class="row align-items-center mb-3">
            <div class="col-9">
                <span class="h3 mb-0"><strong>Corte </strong></span>
                    <span class="text-center font-weight-bold">
                        {{ $payment_cut->created_at->format('M d, Y h:i a') }} </span>
                    <a class="btn btn-primary btn-sm" href="{{route('admin.export.paymentCut', $payment_cut->id)}}"
                        aria-expanded="false" aria-controls="contentId">
                        Exportar Corte
                    </a>
                    <a class="btn btn-primary btn-sm"
                        href="{{route('admin.export.paymentCutBankTransfers', $payment_cut->id)}}" aria-expanded="false"
                        aria-controls="contentId">
                        Exportar Transferencias
                    </a>
                    @if (!$payment_cut->is_aprobed)
                    <a class="btn btn-primary btn-sm" href="{{route('admin.recalculate.paymentCut', $payment_cut->id)}}"
                        aria-expanded="false" aria-controls="contentId">
                        Liquidar Corte Nuevamente
                    </a>
                    @endif
                    <a data-toggle="modal" data-target="#addPaymentRequestModal{{ $payment_cut->id }}"
                        class="btn btn-primary text-white btn-sm">Agregar pago</a>
            </div>
            @if (!$payment_cut->is_aprobed && auth()->guard('employee')->user()->hasRole('superadmin|admin|financial'))
            <div class="col-3 text-right">
                <a data-toggle="modal" data-target="#modal{{ $payment_cut->id }}"
                    class="btn btn-primary text-white btn-sm"><i class="fa fa-edit"></i> Aprobar</a>
            </div>
            @endif
        </div>
    </div>
    <div class="w-100">
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover text-center">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">Total Liquidado</th>
                        <th scope="col">Total Comisión USD</th>
                        <th scope="col">Ganancia Total</th>
                        <th scope="col">Total A Transferir</th>
                        <th scope="col">Aprobado por</th>
                    </tr>
                </thead>
                <tbody class="list">
                    <tr>
                        <td class="text-center">$ {{ number_format ($totalCutTransfer, 2) }}</td>
                        <td class="text-center">${{ number_format ($totalUSDCommission) }}</td>
                        <td class="text-center">${{ number_format ($totalCutGain) }}</td>
                        <td class="text-center">${{ number_format ($totalCutTransferPesos) }}</td>
                        <td class="text-center">
                            @include('generals::layouts.status',
                                ['status' => $payment_cut->is_aprobed]) 
                            @if ($payment_cut->user_approves != null)
                                {{ $payment_cut->user_approves }}
                            @else
                                Sin aprobar 
                            @endif
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
</div>
