<div class="card">
    <div class="card-body">
        <div class="row align-items-center mb-3">
            <div class="col">
                <h3 class="mb-0"><strong>Pago: </strong> {{$payment_request_advance->paymentRequest->contractRequestStreamAccount->nickname }} 
                    {{$payment_request_advance->paymentRequest->contractRequestStreamAccount->streaming->streaming }}
                    <span class="badge"
                        style="color: #ffffff; background-color: {{ $payment_request_advance->paymentRequest->paymentRequestStatus->color }}">
                        {{ $payment_request_advance->paymentRequest->paymentRequestStatus->name }}
                    </span></h3>
            </div>
        </div>
        <div class="w-100">
            <div class="table-responsive">
                <table class="table-striped table align-items-center table-flush table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Fecha</th>
                            <th scope="col">Monto</th>
                            <th scope="col">Total en Pesos</th>
                            <th scope="col">Aprobado</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <tr>
                            <td class="text-center">{{ $payment_request_advance->paymentRequest->created_at->format('M d, Y h:i a') }}</td>
                            @if ($payment_request_advance->paymentRequest->payment_type == "2")
                            <td class="text-center">{{ number_format($payment_request_advance->paymentRequest->usd_amount, 0) }} TKS</td>
                            @else
                            <td class="text-center">{{ number_format($payment_request_advance->paymentRequest->usd_amount, 2) }} USD</td>
                            @endif
                            @if ($payment_request_advance->paymentRequest->grand_total < 0) <td class="text-center" style="color: red;">
                                $ {{ number_format(round($payment_request_advance->paymentRequest->grand_total)) }} </td>
                            @else
                            <td class="text-center">$ {{ number_format(round($payment_request_advance->paymentRequest->grand_total)) }}</td>
                            @endif
                            <td class="text-center">
                                @include('generals::layouts.status', ['status' =>
                                $payment_request_advance->paymentRequest->is_aprobed])
                            </td>
                            <td class="text-center"><a
                                href="{{route('account.payment-requests.show', $payment_request_advance->paymentRequest->id)}}"><i
                                    class="fas fa-eye text-primary"></i></a></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
