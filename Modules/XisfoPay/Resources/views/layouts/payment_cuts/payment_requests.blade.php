<div class="card m-3">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col justify-content-right d-flex">
                <h3 class="mb-0"><strong>Pagos en el Giro </strong>
            </div>
        </div>
    </div>
    <div class="w-100">
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover text-center">
                <thead class="thead-light">
                    <tr>
                        <th>Acciones</th>
                        <th scope="col">Fecha Solicitud</th>
                        <th scope="col">Plataforma Cliente</th>
                        <th scope="col">Monto</th>
                        <th scope="col">Comisión USD</th>
                        <th scope="col">Prestamos</th>
                        <th scope="col">Subtotal USD</th>
                        <th scope="col">TRM</th>
                        <th scope="col">Total COP</th>
                        <th scope="col">4x1000</th>
                        <th scope="col">Retención COP</th>
                        <th scope="col">Ganancia COP</th>
                        <th scope="col">Factura Xisfo</th>
                        <th scope="col">Factura Cliente</th>
                        <th scope="col">Aprobado</th>
                    </tr>
                </thead>
                <tbody class="list">
                    @foreach ($chaseTransfer as $data)
                    <tr>
                        <td class="text-center">
                            <a href="{{ route('admin.payment-requests.show', $data->id) }}">
                                <i class="fas fa-eye">
                                </i></a>
                        </td>
                        <td class="text-center">{{$data->created_at->format('M d, Y h:i a')}}</td>
                        <td class="text-center">
                            {{$data->contractRequestStreamAccount->contractRequest->customerCompany->company_legal_name }}
                            {{$data->contractRequestStreamAccount->nickname }}
                            {{$data->contractRequestStreamAccount->streaming->streaming }}
                        </td>
                        @if ($data->payment_type == 2)
                        <td class="text-center">{{ number_format($data->usd_amount, 0) }} TKS</td>
                        @else
                        <td class="text-center">{{ number_format($data->usd_amount, 2) }} USD</td>
                        @endif
                        <td class="text-center">{{ number_format($data->commission, 2)}}</td>
                        @if ($data->advances > 0) <td class="text-center" style="color: orange;">
                            ${{ number_format($data->advances) }}</td>
                        @else
                        <td class="text-center">${{ number_format($data->advances) }}</td>
                        @endif
                        <td class="text-center">${{ number_format($data->subtotal, 2) }}</td>
                        <td class="text-center">${{ number_format($data->trm, 2) }}</td>
                        @if ($data->grand_total < 0) <td class="text-center" style="color: red;">
                            ${{ number_format(round($data->grand_total)) }}</td>
                            @else
                            <td class="text-center" style="color: green;">
                                ${{ number_format(round($data->grand_total)) }}</td>
                            @endif
                            <td class="text-center">${{ number_format($data['4x1000'], 2) }}</td>
                            @if ($data->payment_type == 2)
                            <td class="text-center">0</td>
                            @else
                            <td class="text-center">
                                @if ($data->contractRequestStreamAccount->contractRequest->finantial_retention)
                                ${{ number_format((($data->finantial_retention) ), 2) }}</td>
                            @else
                            $0
                            @endif
                            @endif
                            <td class="text-center">${{ number_format($data->real_gain, 2) }}</td>
                            <td class="text-center">${{ number_format($data->usd_gain, 2) }}</td>
                            <td class="text-center">${{ number_format($data->invoice + $data->commission, 2)}}</td>
                            <td class="text-center">@include('generals::layouts.status', ['status' =>
                                $data->is_aprobed])
                            </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
