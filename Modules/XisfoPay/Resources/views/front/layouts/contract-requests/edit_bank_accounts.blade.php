<div class="modal fade" id="accountsmodal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Actualizar Cuenta Bancaria<b>{{$data->name}}</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('account.customer-bank-accounts.update', $data->id) }}" method="post" class="form"
                enctype="multipart/form-data" id="form_{{$data->id}}">
                @csrf
                @method('PUT')
                <div class="modal-body py-0">
                    <div id="size_overflow_{{$data->id}}" style="display: none">
                        <h3>TAMAÑO DE ARCHIVO EXCEDIDO<span
                            style="color: #f5365c;">
                            <i class="fas fa-exclamation-circle"></i>
                        </span></h3>
                        <p>
                            El tamaño máximo de todos los archivos a subir debe ser menor o igual a 10MB
                        </p>
                        <p>Los archivos que has seleccionado pesan <span id="total_size_{{$data->id}}"></span>MB</p>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div id="cities" class="form-group">
                                <label class="form-control-label" for="bank_id">Banco</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-university"></i></span>
                                    </div>
                                    <select name="bank_id" id="bank_id" class="form-control">
                                        @foreach($banks as $bank)
                                        @if($bank->id == $data->bank->id)
                                        <option selected="selected" value="{{ $bank->id }}">
                                            {{ $bank->name }}</option>
                                        @else
                                        <option value="{{ $bank->id }}">{{ $bank->name }}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="account_type">Tipo de Cuenta</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-piggy-bank"></i></span>
                                    </div>
                                    <select name="account_type" id="account_type" class="form-control">
                                        @if( 'Corriente' == $data->account_type)
                                        <option selected="selected" value="Corriente">Corriente</option>
                                        <option value="Ahorros">Ahorros</option>
                                        @elseif( 'Ahorros' == $data->account_type)
                                        <option selected="selected" value="Ahorros">Ahorros</option>
                                        <option value="Corriente">Corriente</option>
                                        @else
                                        <option value="Corriente">Corriente</option>
                                        <option value="Ahorros">Ahorros</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="account_number">Número</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-hashtag"></i></span>
                                    </div>
                                    <input type="text" name="account_number" id="account_number"
                                        validation-pattern="name" placeholder="Número" class="form-control"
                                        value="{!! $data->account_number ?: old('account_number')  !!}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="account_number">Archivo</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-file-alt"></i></span>
                                    </div>
                                    <input type="file" name="account_certificate" id="file_{{$data->id}}_1"
                                        placeholder="Archivo" class="form-control"
                                        value="{!! $data->account_certificate ?: old('account_certificate')  !!}"
                                        accept="image/*, .pdf" 
                                        onchange="AcceptableFileUpload('form_{{$data->id}}', '0', '{{$data->id}}', 'file_{{$data->id}}_1')">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-sm" id="create_button_{{$data->id}}">Actualizar</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
