<div class="card">
    <div class="card-body">
        <div class="row align-items-center mb-3">
            <div class="col">
                <h3 class="mb-0"><strong>Pago {{$payment_request->contractRequestStreamAccount->nickname }}
                        {{$payment_request->contractRequestStreamAccount->streaming->streaming }} </strong>
                    <span class="badge"
                        style="color: #ffffff; background-color: {{ $payment_request->paymentRequestStatus->color }}">
                        {{ $payment_request->paymentRequestStatus->name }}
                    </span></h3>
            </div>
            @if (!auth()->guard('employee')->user()->hasRole('xisfopay_comercial'))
                <div class="col text-right">
                    <a data-toggle="modal" data-target="#modal{{ $payment_request->id }}"
                        class="btn btn-primary text-white btn-sm"><i class="fa fa-edit"></i> Editar</a>
                </div>
            @endif
        </div>
        <div class="w-100">
            <div class="table-responsive">
                <table class="table-striped table align-items-center table-flush table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Fecha de Solicitud</th>
                            <th scope="col">Monto</th>
                            <th scope="col">Total en Pesos</th>
                            <th scope="col">TRM</th>
                            <th scope="col">Aprobado</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <tr>
                            <td class="text-center">{{ $payment_request->created_at->format('M d, Y h:i a') }}</td>
                            @if ($payment_request->payment_type == "2")
                            <td class="text-center">{{ number_format($payment_request->usd_amount, 0) }} TKS</td>
                            @else
                            <td class="text-center">{{ number_format($payment_request->usd_amount, 2) }} USD</td>
                            @endif
                            @if ($payment_request->grand_total < 0) <td class="text-center" style="color: red;">
                                $ {{ number_format(round($payment_request->grand_total)) }}
                                @else
                                <td class="text-center">$ {{ number_format(round($payment_request->grand_total)) }}</td>
                                @endif
                                <td class="text-center">
                                   $ {{ number_format($payment_request->trm, 2) }}
                                </td>
                                <td class="text-center">@include('generals::layouts.status', ['status' =>
                                    $payment_request->is_aprobed])
                                </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
