<div class="modal fade" id="modal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Actualizar Solicitud De Contrato</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.contract-requests.update', $data->id) }}" method="post" class="form"
                id="form_{{$data->id}}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body py-0">
                    <div id="size_overflow_{{$data->id}}" style="display: none">
                        <h3>TAMAÑO DE ARCHIVO EXCEDIDO<span style="color: #f5365c;">
                                <i class="fas fa-exclamation-circle"></i>
                            </span></h3>
                        <p>
                            El tamaño máximo de todos los archivos a subir debe ser menor o igual a 10MB
                        </p>
                        <p>Los archivos que has seleccionado pesan <span id="total_size_{{$data->id}}"></span>MB</p>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="color">Estado</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-check"></i></span>
                                    </div>
                                    <select name="contract_request_status_id" id="contract_request_status_id"
                                        class="form-control select2">
                                        <option value=""></option>
                                        @foreach($contract_request_statuses as
                                        $contract_request_status)
                                        <option @if($contract_request_status->id ==
                                            $data->contract_request_status_id)
                                            selected="selected" @endif
                                            value="{{ $contract_request_status->id }}">{{ $contract_request_status->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        @if (!auth()->guard('employee')->user()->hasRole('xisfopay_comercial'))
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="finantial_retention">Retención Financiera</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-check"></i></span>
                                    </div>
                                    @include('generals::layouts.admin.finantial_retention_layout', ['status'
                                    => $data->finantial_retention])
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="file">Archivo</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-file-alt"></i></span>
                                    </div>
                                    <input type="file" name="file" accept="image/*, .pdf" placeholder="Archivo"
                                        class="form-control" id="file_{{$data->id}}_2"
                                        value="{!! $data->file ?: old('file')  !!}"
                                        onchange="AcceptableFileUpload('form_{{$data->id}}', '0', '{{$data->id}}', 'file_{{$data->id}}_2')">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-sm"
                        id="create_button_{{$data->id}}">Actualizar</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@include('generals::layouts.admin.files.size_calculatorJS')
