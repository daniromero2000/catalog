<div class="modal fade" id="mastersmodal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Actualizar Plataforma</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.contract-request-stream-accounts.update', $data->id) }}" method="post" class="form">
                @csrf
                @method('PUT')
                <div class="modal-body py-0">
                    @if (!$data->set_up)
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="streaming_id">Streaming</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-video"></i></span>
                                    </div>
                                    <select name="streaming_id" id="streaming_id" class="form-control" enabled>
                                        @foreach($streamings as $streaming)
                                        <option value="{{ $streaming->id }}" @if($streaming->id ==
                                            $data->streaming_id)
                                            selected="selected" @endif>{{ $streaming->streaming }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="nickname">Nick Name</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-font"></i></span>
                                    </div>
                                    <input type="text" name="nickname" id="nickname" validation-pattern="nickname"
                                        placeholder="Nick Name" class="form-control" value="{{ $data->nickname }}" required>
                                </div>
                            </div>
                        </div>
                        @if (auth()->guard('employee')->user()->hasRole('superadmin|xisfopay_assistant'))    
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="contract_request_stream_account_commission_id">Comisión de streaming</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-video"></i></span>
                                    </div>
                                    <select name="contract_request_stream_account_commission_id" id="contract_request_stream_account_commission_id" class="form-control" enabled>
                                        <option value disabled selected>--select an option--</option>
                                        @foreach($streamAccountCommissions as $streamAccountCommission)
                                        <option value="{{ $streamAccountCommission->id }}" @if($streamAccountCommission->id ==
                                            $data->contract_request_stream_account_commission_id)
                                            selected="selected" @endif>
                                            {{ $streamAccountCommission->id }} {{ $streamAccountCommission->streaming->streaming }} /
                                            ${{ $streamAccountCommission->amount }} USD
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="set_up">Configurado</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-check"></i></span>
                                    </div>
                                    <select name="set_up" id="set_up" class="form-control">
                                        <option @if(0==$data->set_up)
                                            selected="selected" @endif
                                            value="0">No
                                        </option>
                                        <option @if(1==$data->set_up)
                                            selected="selected" @endif
                                            value="1">Si
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <h3 class="mb-0">Ya fue Configurada</h3>
                    @endif
                </div>
                <div class="card-footer text-right">
                    @if (!$data->set_up)
                    <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                    @endif
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
