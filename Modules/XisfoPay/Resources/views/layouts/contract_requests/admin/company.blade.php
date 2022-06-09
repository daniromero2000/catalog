<div class="card">
    <div class="card-body">
        <div class="row align-items-center mb-3">
            <div class="col">
                <h3 class="mb-0">Empresa (Camara De Comercio)</h3>
            </div>
        </div>
        <div class="w-100">
            <div class="table-responsive">
                <table class="table-striped table align-items-center table-flush table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Tipo de Constitución</th>
                            <th scope="col">Nombre Legal</th>
                            <th scope="col">Nombre Comercial</th>
                            <th scope="col">Ciudad</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <tr>
                            <td>{{ $customer_company->constitution_type }}</td>
                            <td>{{ $customer_company->company_legal_name }}</td>
                            <td>{{ $customer_company->company_commercial_name }}</td>
                            <td>{{ $customer_company->city->city }}</td>
                        </tr>
                    </tbody>
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Dirección</th>
                            <th scope="col">Barrio</th>
                            <th scope="col">Teléfono</th>
                            <th scope="col">Número Sedes</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <tr>
                            <td>{{ $customer_company->company_address }}</td>
                            <td>{{ $customer_company->neighborhood }}</td>
                            <td>+{{ $customer_company->prefix }} {{ $customer_company->company_phone }}</td>
                            <td>{{ $customer_company->subsidiaries }}</td>
                        </tr>
                    </tbody>
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">NIT/RUT</th>
                            <th scope="col">Activo</th>
                            <th scope="col">Aprobado</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <tr>
                            <td>{{ $customer_company->company_id_number }}</td>
                            <td class="text-center">@include('generals::layouts.status', ['status' =>
                                $customer_company->is_active])
                            </td>
                            <td class="text-center">@include('generals::layouts.status', ['status' =>
                                $customer_company->is_aprobed])
                            </td>
                            <td class="text-center">
                                <a href="#" data-toggle="modal" data-target="#companymodal{{$customer_company->id}}">
                                    <i class="fa fa-edit"></i>
                                </a>
                                <a href="#" data-toggle="modal"
                                    data-target="#modal-companyImage{{$customer_company->id}}">
                                    <i class="fas fa-file-alt"></i>
                                </a>
                            </td>
                            @include('xisfopay::layouts.contract_requests.admin.edit_company', ['data' => $customer_company])
                            @include('xisfopay::layouts.contract_requests.admin.company_image')
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
