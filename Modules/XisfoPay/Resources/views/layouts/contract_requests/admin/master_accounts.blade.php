<div class="card">
    <div class="card-body">
        <div class="row align-items-center mb-3">
            <div class="col">
                <h3 class="mb-0">Plataformas</h3>
            </div>
            <div class="col text-right">
                <a href="#" data-toggle="modal" data-target="#addmasteraccountmodal" class="btn btn-primary btn-sm"><i
                        class="fa fa-edit"></i>
                    Agregar Plataforma</a>
            </div>
        </div>
        <div class="w-100">
            <div class="table-responsive">
                @if($contract_request->contractRequestStreamAccount->isNotEmpty())
                <table class="table-striped table align-items-center table-flush table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center" scope="col">Master</th>
                            <th class="text-center" scope="col">Comisión</th>
                            <th class="text-center" scope="col">Activo / Configurado</th>
                            <th class="text-center" scope="col">Opciones</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($contract_request->contractRequestStreamAccount as $master)
                        <tr>
                            <td class="text-center">{{ $master->nickname }} {{ $master->streaming->streaming }}
                            </td>
                            <td class="text-center">
                                @if ($master->contractRequestStreamAccountCommission != null)    
                                    {{ $master->contractRequestStreamAccountCommission->streaming->streaming }} / 
                                    ${{ $master->contractRequestStreamAccountCommission->amount }} USD
                                @else
                                    Sin Asignar
                                @endif
                            </td>
                            <td class="text-center">@include('generals::layouts.status', ['status' =>
                                $master->is_active]) @include('generals::layouts.status', ['status' =>
                                $master->set_up])
                            </td>
                            <td class="text-center"><a href="#" data-toggle="modal"
                                    data-target="#mastersmodal{{$master->id}}"><i class="fa fa-edit"></i></a>
                            </td>
                            @include('xisfopay::layouts.contract_requests.admin.edit_masters',
                            ['data' => $master])
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <span class="text-sm"><strong>Aún no</strong> tiene Plataformas registradas.</span>
                @endif
            </div>
        </div>
    </div>
</div>
