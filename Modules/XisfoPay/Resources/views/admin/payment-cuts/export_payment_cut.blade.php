<table class="table-striped table align-items-center table-flush table-hover text-center">
    <thead class="thead-light">
        <tr>
            <th scope="col">Plataforma Cliente</th>
            <th scope="col">Monto</th>
            <th scope="col">Tipo</th>
            <th scope="col">TRM</th>
            <th scope="col">Comisión USD</th>
            <th scope="col">Adelantos</th>
            <th scope="col">Subtotal USD</th>
            <th scope="col">Total COP</th>
            <th scope="col">4x1000</th>
            <th scope="col">Retención COP</th>
            <th scope="col">Ganancia COP</th>
            <th scope="col">Factura Xisfo</th>
            <th scope="col">Factura Cliente</th>
        </tr>
    </thead>
    <tbody class="list">
        @foreach ($paymentRequests as $data)
        <tr>
            <td class="text-center">
                {{$data->contractRequestStreamAccount->contractRequest->customerCompany->company_legal_name }}
                {{$data->contractRequestStreamAccount->nickname }}
                {{$data->contractRequestStreamAccount->streaming->streaming }}
            </td>
            <td class="text-center">{{ $data->usd_amount }}</td>
            @if ($data->payment_type == 2)
            <td class="text-center">TKS</td>
            @else
            <td class="text-center">USD</td>
            @endif
            <td class="text-center">{{ $data->trm}}</td>
            <td class="text-center">{{ $data->commission}}</td>
            @if ($data->advances > 0) <td class="text-center" style="color: orange;">
                {{ $data->advances }}</td>
            @else
            <td class="text-center">{{ $data->advances }}</td>
            @endif
            <td class="text-center">{{ $data->subtotal }}</td>
            @if ($data->grand_total < 0) <td class="text-center" style="color: red;">
                {{ $data->grand_total }}</td>
                @else
                <td class="text-center" style="color: green;">
                    {{ $data->grand_total }}</td>
                @endif
                <td class="text-center">{{ $data['4x1000'] }}</td>
                @if ($data->payment_type == 2)
                <td class="text-center">0</td>
                @else
                <td class="text-center">
                    @if ($data->contractRequestStreamAccount->contractRequest->finantial_retention)
                    {{ ($data->finantial_retention)}}</td>
                @else
                0
                @endif
                @endif
                <td class="text-center">{{ $data->real_gain }}</td>
                <td class="text-center">{{ $data->usd_gain }}</td>
               <td class="text-center">{{ $data->invoice + $data->commission}}</td>
        </tr>
        @endforeach
    </tbody>
</table>
