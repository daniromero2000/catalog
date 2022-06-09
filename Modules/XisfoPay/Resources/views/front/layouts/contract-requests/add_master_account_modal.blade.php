<div class="modal fade" id="addmasteraccountmodal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Plataforma</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('account.contract-request-stream-accounts.store') }}" method="POST" class="form"
                enctype="multipart/form-data" onsubmit="disable_button('create_button_')">
                <div class="modal-body py-0">
                    @csrf
                    <input id="contract_request_id" name="contract_request_id" value="{{ $contract_request->id }}"
                        hidden>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="nickname">Nickname <span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-font"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="nickname" id="nickname"
                                        placeholder="Nickname" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="streaming_id">Streaming <span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-video"></i></span>
                                    </div>
                                    <select name="streaming_id" id="streaming_id" class="form-control" enabled required>
                                        <option disabled selected value> -- select an option -- </option>
                                        @foreach($streamings as $streaming)
                                        <option value="{{ $streaming->id }}">{{ $streaming->streaming }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-sm" id="create_button_">Agregar</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
