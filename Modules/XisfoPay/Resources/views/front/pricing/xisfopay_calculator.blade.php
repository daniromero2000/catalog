    <div class="card">
        <div class="card-header bg-warning text-center font-weight-bold">
            Tarificador XisfoPay
        </div>
        <div class="card-body">
            <input type="hidden" id="chase_bank_processing_commision" value="{{ $chaseCommission->bank_processing_commission }}">
            <input type="hidden" id="epay_commision" value="{{ $epayCommission->streaming->usd_token_rate }}">
            <div class="row">
                <div class="col-4">
                    <label id="usd_amount_label" for="usd_amount">Dolares</label>
                </div>
                <div class="col-8 mb-2">
                    <input placeholder="Ingrese los dolares" type="text" id="usd_amount"
                        class="form-control">
                </div>
                <div class="col-12 mt-2 mb-3 d-flex justify-content-between">
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="streaming_commission"
                            id="streamate_commission" value="{{ $streamateCommission->amount }}">
                        <label class="form-check-label" for="inlineRadio1">Streamate</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="streaming_commission"
                            id="epay_base_commission" value="{{ $epayCommission->amount }}">
                        <label class="form-check-label" for="inlineRadio2">EpayService</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="streaming_commission" id="no_commission"
                            value="0" checked>
                        <label class="form-check-label" for="inlineRadio3">Otro</label>
                    </div>
                </div>
                <div class="col-4">
                    <label id="platform_commission_label" for="platform_commission">Comisión Plataforma</label>
                </div>
                <div class="col-8 mb-2">
                    <input type="text" id="platform_commission" class="form-control" disabled>
                </div>
                <div class="col-4">
                    <label id="xisfo_commission_label" for="xisfo_commission">Comisión XisfoPay</label>
                </div>
                <div class="col-8 mb-2">
                    <input type="text" id="xisfo_commission" class="form-control" disabled>
                </div>
                <div class="col-4">
                    <label id="chase_commission_label" for="chase_commission">Procesamiento Bancario</label>
                </div>
                <div class="col-8 mb-2">
                    <input type="text" id="chase_commission" class="form-control" disabled>
                </div>
                <div class="col-4">
                    <label id="total_usd_amount_label" for="total_usd_amount">Total USD a recibir</label>
                </div>
                <div class="col-8 mb-2">
                    <input type="text" id="total_usd_amount" class="form-control" disabled>
                </div>
                <div class="col-4">
                    <label id="trm_label" for="trm">TRM Hoy</label>
                </div>
                <div class="col-8 mb-2">
                    <input type="hidden" id="trm" class="form-control" value="{{ $trm }}" disabled>
                    <input type="text" id="show_trm" class="form-control" value="{{ number_format($trm, 2) }}" disabled>
                </div>
                <div class="col-4">
                    <label id="total_cop_amount_label" for="total_cop_amount">Total COP a recibir</label>
                </div>
                <div class="col-8 mb-2">
                    <input type="text" id="total_cop_amount" class="form-control" disabled>
                </div>
            </div>
        </div>
    </div>
