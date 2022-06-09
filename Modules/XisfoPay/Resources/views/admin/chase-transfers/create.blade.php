@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.create_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card">
        <form action="{{ route($optionsRoutes .'.store') }}" method="post" class="form" onsubmit="disable_button('create_button_')">
            <div class="card-body">
                @csrf
                <div class="row">
                    <div class="col-6">
                        <span class="h2">Crear chase bank transfer</span>
                    </div>
                    <div class="col-6 text-right">
                            <script src="https://www.dolar-colombia.com/widget.js?t=2&c=1"></script>
                    </div>
                </div>
                <div class="row">
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="form-control-label" for="name">TRM <strong>APROBADA</strong> por el banco para
                                liquidar el corte <span class="text-danger">*</span></label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"><i class="fas fa-funnel-dollar"></i></span>
                                </div>
                                <select class="form-control" name="chase_transfer_trm_id" id="chase_transfer_trm_id">
                                    <option disabled selected value> -- select an option -- </option>
                                    @foreach ($chaseTransferTrms as $chaseTransferTrm)
                                    <option value="{{ $chaseTransferTrm->id }}">
                                        ${{ number_format( $chaseTransferTrm->trm, 2) }} / {{ $chaseTransferTrm->bank->name }}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <label class="form-control-label" for="transfer_amount">Monto</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-hashtag"></i></span>
                                </div>
                                <input class="form-control" type="text" id="transfer_amount" name="transfer_amount"
                                    value="">
                                <div class="input-group-append">
                                    <span class="input-group-text">COP</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-sm" id="create_button_">Crear</button>
                </div>
            </div>
        </form>
    </div>
</section>
@endsection
@section('scripts')
@endsection
