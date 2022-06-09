<div class="row mb-3 justify-content-center">
    <div class="p-3 text-center">
        <div style="max-width: 135px;margin: auto;">
            <img src="{{ asset('img/cards/logo-bancolombia.png') }}" class="img-fluid lazy"
                alt="logo-bancolombia">
        </div>
        Pago a través de transferencia electrónica directa a una cuenta de
        ahorros o a través de código QR
        <br>
        <br>
        <form action="{{ route('bank-transfer.store') }}" class="form-horizontal"
            method="post">
            @csrf
            <div class="btn-group">
                <button onclick="return confirm('¿Estás Seguro?')"
                    class="btn btn-primary btn-sm mx-auto">Continuar con
                    este
                    método de pago</button>
                <input type="hidden" name="billing_address"
                    value="{{ $billingAddress->id }}">
                @if (request()->has('courier'))
                    <input type="hidden" name="courier"
                        value="{{ request()->input('courier') }}">
                @endif
            </div>
        </form>
    </div>
</div>
