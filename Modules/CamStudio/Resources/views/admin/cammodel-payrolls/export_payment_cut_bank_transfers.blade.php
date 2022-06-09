<table class="table-striped table align-items-center table-flush table-hover text-center">
    <thead class="thead-light">
        <tr>
            <th scope="col">Plataforma Cliente</th>
            <th scope="col">CC o Rut</th>
            <th scope="col">Banco</th>
            <th scope="col">Tipo Cuenta</th>
            <th scope="col">Cuenta</th>
            <th scope="col">Total COP</th>
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
            <td class="text-center">
                {{ $data->customerBankAccount->bankAccountCustomerIdentity->identity_number}}
            </td>
            <td class="text-center">
                {{ $data->customerBankAccount->bankNames->name}}
            </td>
            <td class="text-center">
                {{ $data->customerBankAccount->account_type}}
            </td>
            <td class="text-center">
                {{ $data->customerBankAccount->account_number}}
            </td>
            @if ($data->grand_total < 0) <td class="text-center" style="color: red;">
                {{ $data->grand_total }}</td>
                @else
                <td class="text-center" style="color: green;">
                    {{ $data->grand_total }}</td>
                @endif
        </tr>
        @endforeach
    </tbody>
</table>
