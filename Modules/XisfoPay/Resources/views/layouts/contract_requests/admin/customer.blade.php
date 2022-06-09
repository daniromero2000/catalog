<div class="card">
    <div class="card-body">
        <div class="row align-items-center mb-3">
            <div class="col">
                <h3 class="mb-0"> <strong>Datos Cliente <small>(Representante Legal)</small> </strong></h3>
            </div>
            <div class="col">
                <h3 class="mb-0"> <strong>Comercial: </strong>
                    @if ($contract_request->employee)
                    {{$contract_request->employee->name}}
                    {{$contract_request->employee->last_name}}
                    @else
                    <span>Sin Comercial</span>
                    @endif
                </h3>
            </div>
        </div>
        <div class="w-100">
            <div class="table-responsive">
                <table class="table-striped table align-items-center table-flush table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Nombre</th>
                            <th scope="col">Ubicado en</th>
                            <th scope="col">Fecha Nacimiento</th>
                            <th scope="col">Tipo Cliente</th>
                            <th scope="col">Genero</th>
                            <th scope="col">Estado Civil</th>
                            <th scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        <tr>
                            <td class="text-center"> {{$contract_request->customer->name}}
                                {{$contract_request->customer->last_name}}</td>
                            <td class="text-center"> {{$contract_request->customer->city->city}}</td>
                            <td class="text-center"> {{$contract_request->customer->birthday->format('M d, Y')}}</td>
                            <td class="text-center"> @if ($contract_request->contract_request_type == 3)
                            <span class="badge" style="background-color: #ffee00">
                                {{ $contract_request->customer->customerGroup->name }} Venta Tokens
                            </span>
                            @else
                            {{ $contract_request->customer->customerGroup->name }}
                            @endif</td>
                            <td class="text-center"> {{$contract_request->customer->genre->genre}}</td>
                            <td class="text-center"> {{$contract_request->customer->civilStatus->civil_status}}</td>
                            <td class="text-center">
                                <a href="#" data-toggle="modal"
                                    data-target="#editCustomerModal{{$contract_request->customer->id}}">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
