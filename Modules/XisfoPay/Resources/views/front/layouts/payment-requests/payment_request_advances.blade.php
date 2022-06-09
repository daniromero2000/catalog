<div class="card">
    <div class="card-body">
        <div class="row align-items-center mb-3">
            <div class="col">
                @if($payment_request->payment_type == "2")
                <h3 class="mb-0"> <strong>Pago De Tokens </strong>
                </h3>
                @else
                <h3 class="mb-0"> <strong>Prestamos </strong>
                </h3>
                @endif
            </div>
        </div>
        <div class="w-100">
            <div class="table-responsive">
                @if(!$payment_request->paymentRequestAdvances->isEmpty())
                <table class="table-striped table align-items-center table-flush table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Fecha</th>
                            <th scope="col">Valor (COP)</th>
                            @if ( $payment_request->payment_type == "2")
                            <th scope="col">TRM de Negocio</th>
                            @endif
                            <th scope="col">Aprobado</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($payment_request->paymentRequestAdvances as $data)
                        <tr>
                            <td class="text-center">
                                {{$data->created_at->format('M d, Y h:i a')}}
                            </td>
                            @if ($data->is_aprobed==0)
                            <td class="text-center">En proceso de aprobación</td>
                            @else
                            <td class="text-center">${{ number_format($data->value)}}</td>
                            @endif
                            @if ( $payment_request->payment_type == "2")
                            <td class="text-center">${{ number_format($data->trm_tokens, 2)}}</td>
                            @endif
                            <td class="text-center">@include('generals::layouts.status', ['status' =>
                                $data->is_aprobed])
                            </td>
                            <td class="text-center"><a
                                    href="{{route('account.payment-request-advances.show', $data->id)}}"><i
                                        class="fas fa-eye text-primary"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <span class="text-sm">No tiene Avances o Pagos de Tokens</span><br>
                @endif
            </div>
        </div>
    </div>
</div>
