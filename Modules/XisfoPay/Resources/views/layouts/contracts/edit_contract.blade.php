<div class="modal fade" id="editContract{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Actualizar Contrato</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.contracts.update', $data->id) }}" method="post" class="form">
                @csrf
                @method('PUT')
                <div class="modal-body py-0">
                    <div class="row">
                        @if (!Empty($data->contractRenewals->where('is_active', 1)->first()) && $data->contractRenewals->where('is_active', 1)->first()->is_active)
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="color">Estado</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-check"></i></span>
                                    </div>
                                    <select name="contract_status_id" id="contract_status_id"
                                        class="form-control select2">
                                        <option value=""></option>
                                        @foreach($contract_statuses as $contract_status)
                                        <option @if($contract_status->id ==
                                            $data->contract_status_id)
                                            selected="selected" @endif
                                            value="{{ $contract_status->id }}">{{ $contract_status->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="icon{{ $data->id }}">Activo</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-check"></i></span>
                                    </div>
                                    @include('generals::layouts.admin.is_active_layout', ['status'
                                    => $data->is_active])
                                </div>
                            </div>
                        </div>
                        @else
                        <h5 class="modal-title ml-2">El contrato debe tener vigencia y estar activo para poder editar</b></h5>
                        @endif
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
