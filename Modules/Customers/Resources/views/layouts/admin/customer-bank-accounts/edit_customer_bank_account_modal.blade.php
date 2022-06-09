<div class="modal fade" id="modal{{$data->id}}" tabindex="-1" role="dialog"
    aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Actualizar Cuenta Bancaria</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route($optionsRoutes . '.update', $data->id) }}" method="post"
                class="form">
                @csrf
                @method('PUT')
                <div class="modal-body py-0">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="customer_id">Cliente</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-user"></i></span>
                                    </div>
                                    <select name="customer_id" id="customer_id"
                                        class="form-control">
                                        @foreach($customers as $customer)
                                        <option value="{{ $customer->id }}" @if($customer->id ==
                                            $data->customer_id)
                                            selected="selected" @endif >{{ $customer->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="bank_id">Banco</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-university"></i></span>
                                    </div>
                                    <select name="bank_id" id="bank_id" class="form-control"
                                        enabled>
                                        @foreach($banks as $bank)
                                        <option @if($bank->id ==
                                            $data->bank_id)
                                            selected="selected" @endif
                                            value="{{ $bank->id }}">{{ $bank->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="account_type">Tipo de
                                    cuenta</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-piggy-bank"></i></span>
                                    </div>
                                    <select name="account_type" id="account_type"
                                        class="form-control">
                                        <option @if(0==$data->account_type)
                                            selected="selected" @endif value="Ahorros">
                                            Ahorros</option>
                                        <option @if(1==$data->account_type)
                                            selected="selected" @endif value="Corriente">Corriente
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="account_number">Número de
                                    Cuenta</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-hashtag"></i></span>
                                    </div>
                                    <input type="text" name="account_number" id="account_number"
                                        validation-pattern="account_number"
                                        placeholder="Número de Cuenta" class="form-control"
                                        value="{{ $data->account_number }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="customer_identity_id">Identidad Asociada</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-hashtag"></i></span>
                                    </div>
                                    <select class="form-control" name="customer_identity_id" id="customer_identity_id">
                                        <option value selected disabled>--Select an option--</option>
                                        @foreach ($data->customer->customerIdentities as $customer_identity)
                                        <option value="{{ $customer_identity->id }}" 
                                            @if ($customer_identity->id == $data->customer_identity_id) 
                                            selected 
                                            @endif>
                                            {{$customer_identity->identityType->initials}}
                                            {{ $customer_identity->identity_number }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label"
                                    for="is_aprobed">Aprobación</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-check-double"></i></span>
                                    </div>
                                    <select name="is_aprobed" id="is_aprobed" class="form-control">
                                        <option @if(0==$data->is_aprobed)
                                            selected="selected" @endif value="0">
                                            No Aprobado</option>
                                        <option @if(1==$data->is_aprobed)
                                            selected="selected" @endif value="1">Aprobado
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="is_active">Estado</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fas fa-check"></i></span>
                                    </div>
                                    <select name="is_active" id="is_active" class="form-control">
                                        <option @if(0==$data->is_active)
                                            selected="selected" @endif value="0">
                                            Inactivo</option>
                                        <option @if(1==$data->is_active)
                                            selected="selected" @endif value="1">Activo
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                    <button type="button" class="btn btn-secondary btn-sm"
                        data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>