<!-- Modal -->
<div class="modal fade" id="modalContract{{$contract_request->contract->id}}" tabindex="-1"
    role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Cargar contrato firmado</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body py-0">
                <form
                    action="{{ route('account.contract-renewals.update', $id) }}"
                    method="post" class="form" enctype="multipart/form-data"
                    id="form_{{$contract_request->contract->id}}">  
                    @csrf
                    @method('PUT')
                    <div id="size_overflow_{{$contract_request->contract->id}}" style="display: none">
                        <h3>TAMAÑO DE ARCHIVO EXCEDIDO<span style="color: #f5365c;">
                                <i class="fas fa-exclamation-circle"></i>
                            </span></h3>
                        <p>
                            El tamaño máximo de todos los archivos a subir debe ser menor o
                            igual a 10MB
                        </p>
                        <p>Los archivos que has seleccionado pesan <span
                                id="total_size_{{$contract_request->contract->id}}"></span>MB</p>
                    </div>
                    @if (!$contract_request->contract->is_aprobed)
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="account_number">Archivo</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i
                                                class="fa fa-file-alt"></i></span>
                                    </div>
                                    <input type="file" name="file"
                                        id="file_{{$contract_request->contract->id}}_1"
                                        placeholder="Archivo" class="form-control"
                                        value="{!! $contract_request->contract->file ?: old('file')  !!}"
                                        accept="image/*, .pdf"
                                        onchange="AcceptableFileUpload('form_{{$contract_request->contract->id}}', '0', '{{$contract_request->contract->id}}', 'file_{{$contract_request->contract->id}}_1')">
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="col-sm-12">
                        <div class="form-group">
                            <label class="form-control-label" for="account_number">Archivo</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fa fa-file-alt"></i></span>
                                </div>
                                <input type="file" name="file"
                                    id="file_{{$contract_request->contract->id}}_2"
                                    accept="image/*, .pdf" placeholder="Archivo" class="form-control"
                                    value="{!! $contract_request->contract->file ?: old('file')  !!}"
                                    onchange="AcceptableFileUpload('form_{{$contract_request->contract->id}}', '0', '{{$contract_request->contract->id}}', 'file_{{$contract_request->contract->id}}_2')">
                            </div>
                        </div>
                    </div>
                    <h3 class="mb-0">Ya fue aprobada!!!</h3>
                    @endif
                    <div class="card-footer text-right">
                        <button type="submit" id="create_button_{{$contract_request->contract->id}}"
                            class="btn btn-primary btn-sm">Actualizar</button>
                        <button type="button" class="btn btn-secondary btn-sm"
                            data-dismiss="modal">Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>