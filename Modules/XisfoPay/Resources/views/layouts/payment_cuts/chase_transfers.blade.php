<div class="card">
    <div class="card-header">
        <div class="row align-items-center">
            <div class="col justify-content-right d-flex">
                <span class="h3 m-0 mr-2">
                    <strong>Giro {{ $key }}</strong>
                </span>
                <span class="text-center font-weight-bold">
                    {{ $chaseTransfer[0]->chaseTransfer->created_at->format('M d, Y h:i a') }} </span>
            </div>
        </div>
    </div>
    <div class="table">
        <table class="table-striped table align-items-center table-flush table-hover text-center">
            <thead class="thead-light">
                <tr>
                    <th>Monto total</th>
                    <th>Restante de Giro</th>
                    <th>TRM / Banco</th>
                    <th>Comisión Comercial</th>
                    <th>Comisión Real</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>${{ number_format($chaseTransfer[0]->chaseTransfer->transfer_amount, 2) }}  USD</td>
                    <td>${{ number_format($chaseTransfer[0]->chaseTransfer->transfer_amount - 
                        $chaseTransfer->sum('usd_amount'), 2) }}  USD</td>
                    <td>${{ number_format($chaseTransfer[0]->chaseTransfer->chaseTransferTrm->trm, 2) }} /
                        {{ $chaseTransfer[0]->chaseTransfer->chaseTransferTrm->bank->name }}</td>
                    <td>${{ number_format($chaseTransfer->sum('commission'), 2) }} USD</td>
                    <td>${{ number_format($chaseTransfer->sum('real_commission'), 2) }} USD / 
                        ${{ number_format($chaseTransfer[0]->chaseTransfer->commission, 2) }} USD</td>
                </tr>
            </tbody>
        </table>
    </div>
    @include('xisfopay::layouts.payment_cuts.payment_requests')
</div>
