@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.create_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <form action="{{ route('admin.chase-transfer-trms.store') }}" method="post" class="form" onsubmit="disable_button('create_button_')">
            <div class="card-body">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <h2>Crear TRM</h2>
                    </div>
                    <div class="col-6 text-right">
                        <script src="https://www.dolar-colombia.com/widget.js?t=2&c=1"></script>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="trm">Factor de TRM<span
                                class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-search-dollar"></i></span>
                                </div>
                                <input type="text" name="trm" id="trm" validation-pattern="name" placeholder="TRM"
                                    class="form-control" value="{{ old('trm') }}" required>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div id="cities" class="form-group">
                            <label class="form-control-label" for="bank_id">Banco<span
                                class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-university"></i></span>
                                </div>
                                <select name="bank_id" id="bank_id" class="form-control">
                                    <option disabled selected value> -- select an option -- </option>
                                    @foreach($banks as $bank)
                                    <option value="{{ $bank->id }}">{{ $bank->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                    data-target="#modalConfirmCreate">
                    Crear TRM
                </button>
                <a href="{{ route('admin.chase-transfer-trms.index') }}" class="btn btn-default btn-sm">Regresar</a>
            </div>
            <!-- Modal -->
            <div class="modal fade" id="modalConfirmCreate" tabindex="-1" role="dialog"
                aria-labelledby="modalConfirmCreateLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header m-auto">
                            <h1 class="modal-title mt-2" id="modalConfirmCreateLabel">AVISO DE SEGURIDAD<span
                                    style="color: #f5365c;"> <i class="fas fa-exclamation-circle"></i></span></h1>
                        </div>
                        <div class="modal-body text-center" style="padding:0px !important;">
                            <p>
                                ¿está seguro que quiere agregar esta TRM?
                            </p>
                            <p>Esto afectará todos los procesos de pagos, transferencias y formulación ejecutados.</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Volver</button>
                            <button type="submit" class="btn btn-primary btn-sm" id="create_button_">Crear</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
