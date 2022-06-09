<div class="row w-100 align-items-center mb-3">
    @if (!$contract_request->contractRequestStreamAccount->isEmpty() &&
    $contract_request->customerCompany->is_aprobed )
  
    @if ($contract_request->is_aprobed == 1)
    
    @else
    <div class="col-6 text-center p-0">
        <div class="row row-reset w-100 text-center">
            <div class="col-6 text-center">
                <a href="{{ route('account.front.contract-request.generate', $contract_request->id) }}" id="dm"
                    class="btn btn-primary btn-sm" target="_blank"><i class="fa fa-print pr-2"></i>Imprimir solicitud</a>
            </div>
            <div class="col-6 text-center">
                <a data-toggle="modal" data-target="#modal{{ $contract_request->id }}" href=""
                    class="btn btn-primary btn-sm">
                    <i class="fas fa-upload"></i> Cargar solicitud firmada
                </a>
            </div>
        </div>
    </div>
    <div class="col-6 text-center p-0" style="border-left: 3px dotted #154293;">
        <div class="row row-reset w-100 text-center">
            <div class="col-6 text-center">
                @include('xisfopay::front.layouts.contracts.print_contract_button', ['id' => $contract_request->id])
            </div>
            <div class="col-6 text-center">
            <a type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#contractModal">
                <i class="fas fa-upload"></i> Cargar contrato firmado</a>
        </div>
    </div>
        <!-- Modal -->
        <div class="modal fade" id="modal{{$contract_request->id}}" tabindex="-1" role="dialog"
            aria-labelledby="modelTitleId" aria-hidden="true">
            <div class="modal-dialog modal-sm" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Renovación De Contrato</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body py-0">
                        <form action="{{ route('admin.contract-renewals.update', $contract_request->id) }}"
                            method="post" class="form" enctype="multipart/form-data"
                            id="form_{{$contract_request->id}}">
                            @csrf
                            @method('PUT')
                            <div id="size_overflow_{{$contract_request->id}}" style="display: none">
                                <h3>TAMAÑO DE ARCHIVO EXCEDIDO<span style="color: #f5365c;">
                                        <i class="fas fa-exclamation-circle"></i>
                                    </span></h3>
                                <p>
                                    El tamaño máximo de todos los archivos a subir debe ser menor o
                                    igual a 10MB
                                </p>
                                <p>Los archivos que has seleccionado pesan <span
                                        id="total_size_{{$contract_request->id}}"></span>MB</p>
                            </div>
                            @if (!$contract_request->is_aprobed)
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="starts">Fecha de
                                            inicio</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="fas fa-calendar-week"></i></span>
                                            </div>
                                            <input value="{{ $contract_request->starts }}"
                                                type="date" class="form-control" name="starts"
                                                id="starts" placeholder="00/00/0000">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="form-control-label" for="expires">Fecha de
                                            expiración</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="fas fa-calendar-week"></i></span>
                                            </div>
                                            <input type="date"
                                                value="{{ $contract_request->expires }}"
                                                class="form-control" name="expires" id="expires">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label class="form-control-label"
                                            for="account_number">Archivo</label>
                                        <div class="input-group input-group-merge">
                                            <div class="input-group-prepend">
                                                <span class="input-group-text"><i
                                                        class="fa fa-file-alt"></i></span>
                                            </div>
                                            <input type="file" name="file" id="file_{{$contract_request->id}}_1"
                                                placeholder="Archivo" class="form-control"
                                                value="{!! $contract_request->file ?: old('file')  !!}"
                                                accept="image/*, .pdf"
                                                onchange="AcceptableFileUpload('form_{{$contract_request->id}}', '0', '{{$contract_request->id}}', 'file_{{$contract_request->id}}_1')">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label class="form-control-label"
                                        for="account_number">Archivo</label>
                                    <div class="input-group input-group-merge">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i
                                                    class="fa fa-file-alt"></i></span>
                                        </div>
                                        <input type="file" name="file" id="file_{{$contract_request->id}}_2"
                                            accept="image/*, .pdf" placeholder="Archivo"
                                            class="form-control"
                                            value="{!! $contract_request->file ?: old('file')  !!}"
                                            onchange="AcceptableFileUpload('form_{{$contract_request->id}}', '0', '{{$contract_request->id}}', 'file_{{$contract_request->id}}_2')">
                                    </div>
                                </div>
                            </div>
                            <h3 class="mb-0">Ya fue aprobada!!!</h3>
                            @endif
                            <div class="card-footer text-right">
                                <button type="submit" id="create_button_{{$contract_request->id}}"
                                    class="btn btn-primary btn-sm">Actualizar</button>
                                <button type="button" class="btn btn-secondary btn-sm"
                                    data-dismiss="modal">Cerrar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
</div>
@endif
</div>
<div class="w-100">
    <div class="table-responsive">
        @include('xisfopay::front.layouts.contract-requests.customer')
    </div>
</div>
