@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.create_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <form action="{{ route('admin.contract-request-stream-accounts.store') }}" method="post" class="form"
            onsubmit="disable_button('create_button_')">
            <div class="card-body">
                @csrf
                <div class="col pl-0 mb-3">
                    <h2>Plataformas Clientes</h2>
                </div>
                <div class="row">
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-control-label" for="contract_request_id">Contrato <span
                                    class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-file-signature"></i></span>
                                </div>
                                <select name="contract_request_id" id="contract_request_id" class="form-control" enabled
                                    required>
                                    <option disabled selected value> -- select an option -- </option>
                                    @foreach($contract_request_id as $contract_request)
                                    <option value="{{ $contract_request->id }}">
                                        {{ $contract_request->client_identifier }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-control-label" for="streaming_id">Streaming <span
                                    class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-video"></i></span>
                                </div>
                                <select name="streaming_id" id="streaming_id" class="form-control" enabled required>
                                    <option disabled selected value> -- select an option -- </option>
                                    @foreach($streamings as $streaming)
                                    <option value="{{ $streaming->id }}">{{ $streaming->streaming }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-4">
                        <div class="form-group">
                            <label class="form-control-label" for="nickname">Nick Name <span
                                    class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-font"></i></span>
                                </div>
                                <input type="text" name="nickname" id="nickname" validation-pattern="nickname"
                                    placeholder="Nick Name" class="form-control" value="{{ old('nickname') }}" required>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-primary btn-sm" id="create_button_">Crear</button>
            </div>
        </form>
    </div>
</section>
@endsection
