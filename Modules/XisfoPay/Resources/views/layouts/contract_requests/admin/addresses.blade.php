<div class="col-md-6">
    <div class="card mb-3">
        <div class="card-body">
            <div class="row align-items-center mb-3">
                <div class="col text-center">
                    <h3 class="mb-0" style="color: #1C4293"><i class="fas fa-map-marked-alt"></i> Datos de residencia
                    </h3>
                </div>
            </div>
            <div class="w-100">
                <div class="table-responsive">
                    @if($customer->customerAddresses->isNotEmpty())
                    <table class="table-striped table align-items-center table-flush table-hover text-center">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" scope="col">Dirección</th>
                                <th class="text-center" scope="col">Barrio</th>
                                <th class="text-center" scope="col">Ciudad/Departamento</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach ($customer->customerAddresses as $customer_address)
                            <tr>
                                <td class="text-center">{{ $customer_address->customer_address }}</td>
                                <td class="text-center">{{ $customer_address->neighborhood }}</td>
                                <td class="text-center">{{ $customer_address->city->city }} /
                                    {{ $customer_address->city->province->province }}</td>
                                @endforeach
                            </tr>
                        </tbody>
                    </table>
                    @else
                    <span class="text-sm"><strong>Aún no</strong> tiene direcciones</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
