<div class="row m-0 p-0 py-3 justify-content-center align-items-center bg-secondary">
    <div class="col-lg-4 p-lg-0 m-lg-0 mt-sm-0 order-lg-2 order-1">
        <div class="card">
            <div class="card-header bg-warning text-center font-weight-bold">
                Tarificador XisfoPay
            </div>
            <div class="card-body">
                <input type="hidden" id="chaturbate_commission" value="{{ $chaturbateCommission->streaming->usd_token_rate }}">
                <div class="row">
                    <div class="col-4">
                        <label id="tokens_label" for="tokens_amount">Tokens</label>
                    </div>
                    <div class="col-8 mb-2">
                        <input placeholder="Ingrese los tokens" type="text" id="tokens_amount"
                            class="form-control">
                    </div>
                    <div class="col-4">
                        <label id="total_usd_amount_label" for="total_usd_amount">Total USD a recibir</label>
                    </div>
                    <div class="col-8 mb-2">
                        <input type="text" id="t_total_usd_amount" class="form-control" disabled>
                    </div>
                    <div class="col-4">
                        <label id="trm_label" for="trm">TRM Hoy</label>
                    </div>
                    <div class="col-8 mb-2">
                        <input type="hidden" id="t_trm" class="form-control" value="{{ $trm - $trmReduction->value }}" disabled>
                        <input type="text" id="t_show_trm" class="form-control" value="{{ number_format($trm - $trmReduction->value, 2) }}" disabled>
                    </div>
                    <div class="col-4">
                        <label id="total_cop_amount_label" for="total_cop_amount">Total COP a recibir</label>
                    </div>
                    <div class="col-8 mb-2">
                        <input type="text" id="t_total_cop_amount" class="form-control" disabled>
                    </div>
                </div>
            </div>
        </div>    
    </div>
</div>