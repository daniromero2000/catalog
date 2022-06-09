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
            @if (!auth()->guard('employee')->user()->hasRole('xisfopay_comercial'))
                @if (($payment_request->payment_request_status_id != 5 && $payment_request->payment_request_status_id != 9)
                && $payment_request->payment_cut_id == null && $payment_request->payment_type != "2")
                    <div class="col text-right">
                        <a href="#" data-toggle="modal" data-target="#advancemodal" class="btn btn-primary btn-sm"><i
                                class="fa fa-edit"></i>
                            Agregar Avance </a>
                    </div>
                @endif
            @endif
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
                            <th scope="col">Aprobado / Transferencia</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($payment_request->paymentRequestAdvances as $data)
                        <tr>
                            <td class="text-center">
                                {{$data->created_at->format('M d, Y h:i a')}}</td>
                            <td class="text-center">${{ number_format($data->value)}}</td>
                            @if ( $payment_request->payment_type == "2")
                            <td class="text-center">${{ number_format($data->trm_tokens, 2)}}</td>
                            @endif
                            <td class="text-center">@include('generals::layouts.status', ['status' =>
                                $data->is_aprobed]) @include('generals::layouts.status', ['status' =>
                                $data->transfer])
                            </td>
                            <td class="text-center"><a
                                    href="{{route('admin.payment-request-advances.show', $data->id)}}"><i
                                        class="fa fa-search"></i></a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <span class="text-sm">No tiene Avances o Pagos de Tokens</span><br>
                @endif
                <div class="row mt-3 mx-0">
                    <div class="col text-right">
                        <form action="{{ route('admin.payment-request-advances.destroy', $payment_request['id']) }}"
                            method="post" class="form-horizontal">
                            @csrf
                            <input type="hidden" name="_method" value="delete">
                            <div class="btn-group">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
