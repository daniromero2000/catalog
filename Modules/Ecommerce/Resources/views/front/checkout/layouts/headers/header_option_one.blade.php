<nav class="nav justify-content-center">
    <li class="nav-item">
        <div class="row justify-content-center">
            <div class="d-flex">
                <a class="my-auto text-secondary">Tu pago es seguro con </a>
            </div>
            @foreach ($paymentGateways as $paymentGateway)
            @if ($paymentGateway == 'payu')
            <div style="max-width: 95px;margin: auto;">
                <img src="{{asset('img/cards/payu-logo.png')}}" class="img-fluid lazy" alt="payu-logo">
            </div>
            @elseif($paymentGateway == 'epayco')
            <div style="max-width: 95px;margin: auto;">
                <img src="{{asset('img/cards/epayco-logo.png')}}" class="img-fluid lazy" alt="payu-logo">
            </div>
            @else
            @endif
            @endforeach
        </div>
    </li>
</nav>
