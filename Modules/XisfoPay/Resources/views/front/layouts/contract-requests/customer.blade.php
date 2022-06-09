<div class="card">
    <div class="card-body">
        <div class="row align-items-center mb-3">
            <div class="col text-center">
                <h3 class="mb-0"> <strong style="color: #1C4293"><i class="far fa-address-card"></i> Datos de cliente <small>(representante legal)</small> </strong></h3>
            </div>
            <div class="col text-center">
                <h3 style="color: #666666" class="mb-0"> <strong style="color: #1C4293"> <i class="fas fa-user-tie"></i> Asesor comercial: </strong>
                    @if ($contract_request->employee)
                    {{$contract_request->employee->name}}
                    {{$contract_request->employee->last_name}}
                    @else
                    <span>No tienes comercial asignado</span>
                    @endif
                </h3>
            </div>
        </div>
        <div class="w-100">
            <div class="table-responsive">
                <table class="table-striped table align-items-center table-flush table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">Nombres / Apellidos</th>
                            <th scope="col">Ciuda de residencia</th>
                            <th scope="col">Fecha Nacimiento</th>
                            <th scope="col">Genero</th>
                            <th scope="col">Estado Civil</th>
                            @if ($contract_request->is_aprobed == 0)
                            <th scope="col">Opciones</th>       
                            @else
                                
                            @endif
                        </tr>
                    </thead>
                    <tbody class="list">
                        <tr>
                            <td class="text-center"> {{$contract_request->customer->name}}
                                {{$contract_request->customer->last_name}}</td>
                            <td class="text-center"> {{$contract_request->customer->city->city}}</td>
                            <td class="text-center"> {{$contract_request->customer->birthday->format('M d, Y')}}</td>
                            <td class="text-center"> {{$contract_request->customer->genre->genre}}</td>
                            <td class="text-center"> {{$contract_request->customer->civilStatus->civil_status}}</td>
                            @if ($contract_request->is_aprobed == 0)
                            <td class="text-center">
                                <a href="#" data-toggle="modal"
                                    data-target="#editCustomerModal{{$contract_request->customer->id}}">
                                    <i class="fas fa-edit"></i>
                                </a>
                            </td>
                            @else

                            @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
