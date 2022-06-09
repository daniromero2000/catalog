<div class="card">
    <div class="card-body">
        <div class="row align-items-center mb-3">
            <div class="col">
                <h3 class="mb-0"> <strong>Transferencias Bancarias del Pago</strong>
                </h3>
            </div>
        </div>
        <div class="w-100">
            @if(!$payment_request->bankTransfers->isEmpty())
            <div class="table-responsive">
                <table class="table-striped table align-items-center table-flush table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Fecha</th>
                            <th scope="col">ID Transferencia</th>
                            <th scope="col">Valor en Pesos</th>
                            <th scope="col">Aprobado / Transferido</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($payment_request->bankTransfers as $data)
                        <tr>
                            <td class="text-center">
                                {{$data->created_at->format('M d, Y h:i a')}}</td>
                            <td class="text-center">
                                {{$data->id}}</td>
                            @if ($data->value < 0) <td class="text-center" style="color: red;">
                                $ {{ number_format(round($data->value)) }}
                                @else
                                <td class="text-center">$ {{ number_format(round($data->value)) }}</td>
                                @endif
                                <td class="text-center">@include('generals::layouts.status', ['status' =>
                                    $data->is_aprobed]) @include('generals::layouts.status', ['status' =>
                                    $data->is_transfered])
                                </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="card-footer text-right mt-2">
                <span class="btn btn-primary btn-sm">
                    Total transferido: ${{ number_format($payment_request->bankTransfers->sum('value')) }} </span>
                {{-- @if ($payment_request->payment_cut_id != null && ($payment_request->bankTransfers->sum('value') -
                $payment_request->grand_total) > 0)
                <span class="btn btn-danger btn-sm">
                    Debe:
                    ${{ number_format($payment_request->bankTransfers->sum('value') - $payment_request->grand_total ) }}
                </span>
                @endif --}}
            </div>
            @else
            <span class="text-sm">No tiene Transferencias Bancarias aún.</span><br>
            @endif
        </div>
    </div>
</div>
