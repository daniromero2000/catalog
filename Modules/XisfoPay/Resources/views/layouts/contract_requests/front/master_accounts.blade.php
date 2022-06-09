<div class="card">
    <div class="card-body">
        <div class="row align-items-center mb-3">
            <div class="col">
                <h3 class="mb-0" style="color: #1c4393 !important;"> <i class="fas fa-satellite-dish"></i> Cuentas master / Plataformas Streaming </h3>
            </div>
            <div class="col text-right">
                @if ($contract_request->contract_request_status_id == 7 || $contract_request->contract_request_status_id == 5 )
                <a href="#" data-toggle="modal" data-target="#addmasteraccountmodal" class="btn btn-primary btn-sm"><i
                        class="fa fa-edit"></i>
                    Agregar cuenta master</a>
                @endif
            </div>
        </div>
        <div class="w-100">
            <div class="table-responsive">
                @if($contract_request->contractRequestStreamAccount->isNotEmpty())
                <table class="table-striped table align-items-center table-flush table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th class="text-center" scope="col">Cuenta Master</th>
                            <th class="text-center" scope="col">Activo / Configurado</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach ($contract_request->contractRequestStreamAccount as $master)
                        <tr>
                            <td class="text-center">{{ $master->nickname }} {{ $master->streaming->streaming }}
                            </td>
                            <td class="text-center">@include('generals::layouts.status', ['status' =>
                                $master->is_active]) @include('generals::layouts.status', ['status' =>
                                $master->set_up])
                            </td>
                            {{-- <td class="text-center"><a href="#" data-toggle="modal"
                                    data-target="#mastersmodal{{$master->id}}"><i class="fa fa-edit"></i></a>
                            </td>
                            @include('xisfopay::layouts.contract_requests.front.edit_masters',
                            ['data' => $master]) --}}
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @else
                <span class="text-sm"><strong>Aún no</strong> tienes cuentas master registradas.</span>
                @endif
            </div>
        </div>
    </div>
</div>
