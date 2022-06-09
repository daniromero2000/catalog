<div class="card">
    <div class="card-body">
        <div class="row align-items-center mb-3">
            <div class="col">
                <h3 class="mb-0">Datos de identificación y RUT/NIT</h3>
            </div>
            <div class="col text-right">
                <a href="#" data-toggle="modal" data-target="#addCustomerIdentityModal" class="btn btn-primary btn-sm"><i
                        class="fa fa-edit"></i>
                    Agregar Identidad</a>
            </div>
        </div>
        <div class="w-100">
            <div class="table-responsive">
                @if($customer->customerIdentities->isNotEmpty())
                <table class="table-striped table align-items-center table-flush table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Documento / Número</th>
                            <th scope="col">Fecha y Ciudad de Expedición</th>
                            <th scope="col">Activo / Aprobado</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($customer->customerIdentities as $customer_identity)
                        <tr>
                            <td>{{ $customer_identity->identityType->initials }}
                                {{ $customer_identity->identity_number }}</td>
                            <td>{{ $customer_identity->expedition_date }} de {{ $customer_identity->city->city }}</td>
                            <td class="text-center">@include('generals::layouts.status', ['status' =>
                                $customer_identity->is_active]) @include('generals::layouts.status', ['status' =>
                                $customer_identity->is_aprobed])
                            </td>
                            <td class="text-center">
                                @if (!$customer_identity->is_aprobed)
                                <a href="#" data-toggle="modal"
                                    data-target="#identitymodal{{$customer_identity->id}}"><i
                                    style="color: #1c4393 !important;" class="fa fa-edit"></i></a>
                                @endif
                                <a href="#" data-toggle="modal" data-target="#modal-idImage{{$customer_identity->id}}">
                                    <i style="color: #1c4393 !important;" class="fas fa-file-alt"></i>
                                </a>
                            </td>
                        </tr>
                        @include('xisfopay::front.layouts.contract-requests.edit_identity', ['data' => $customer_identity])
                        @include('xisfopay::layouts.contract_requests.id_image')
                        @endforeach
                    </tbody>
                </table>
                @else
                <span class="text-sm"><strong>Aún no</strong> tiene Identificación</span>
                @endif
            </div>
        </div>
    </div>
</div>
