<div class="w-100 mt-3">
    <div class="card">
        <div class="card-body">
            <div class="my-auto">
                <h6>Metodos de pago</h6>
            </div>
            <div class="row w-100">
                <div class="col-sm-4 mt-4 px-0">
                    <div class="ml-2">
                        <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist"
                            aria-orientation="vertical">
                            @foreach ($paymentGateways as $paymentGateway)
                            @if ($paymentGateway == 'payu')
                            <a class="nav-link paymentMethods active" id="v-pills-creditCards" data-toggle="pill"
                                href="#creditCards" role="tab" aria-controls="creditCards" aria-selected="true">Tarjeta
                                de crédito</a>
                            <a class="nav-link paymentMethods" id="v-pills-pse" data-toggle="pill" href="#pse"
                                role="tab" aria-controls="pse" aria-selected="true">Pago PSE</a>
                            @elseif($paymentGateway == 'epayco')
                            <a class="nav-link paymentMethods active" id="v-pills-creditCards" data-toggle="pill" href="#creditCards" role="tab"
                                aria-controls="creditCards" aria-selected="true">Tarjeta
                                de crédito</a>
                            <a class="nav-link paymentMethods" id="v-pills-pse" data-toggle="pill" href="#pse"
                                role="tab" aria-controls="pse" aria-selected="true">Pago PSE</a>
                            @elseif($paymentGateway == 'baloto')
                            <a class="nav-link paymentMethods" id="baloto-tab" data-toggle="pill" href="#baloto"
                                role="tab" aria-controls="baloto" aria-selected="false">Baloto </a>
                            @elseif($paymentGateway == 'efecty')
                            <a class="nav-link paymentMethods" id="efecty-tab" data-toggle="pill" href="#efecty"
                                role="tab" aria-controls="efecty" aria-selected="false">Efecty o Gana</a>
                            @elseif($paymentGateway == 'bank-transfer')
                            <a class="nav-link paymentMethods" id="bancolombia-tab" data-toggle="pill"
                                href="#bancolombia" role="tab" aria-controls="bancolombia" aria-selected="false">QR
                                Bancolombia</a>
                            @else
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-sm-8 px-0 bg-paymentMethods">
                    <div class="mx-3">
                        <div class="tab-content" id="v-pills-tabContent">
                            @foreach ($paymentGateways as $paymentGateway)
                            @if ($paymentGateway == 'payu')
                            <div class="tab-pane fade show active" id="creditCards" role="tabpanel"
                                aria-labelledby="v-pills-creditCards">
                                @include('ecommerce::front.payments.credit-card')
                            </div>
                            <div class="tab-pane fade" id="pse" role="tabpanel" aria-labelledby="v-pills-pse">
                                @include('ecommerce::front.payments.pse', ['option' => 'pseCode', 'value' =>
                                'description'])
                            </div>
                            @elseif($paymentGateway == 'epayco')
                            <div class="tab-pane fade show active" id="creditCards" role="tabpanel"
                                aria-labelledby="v-pills-creditCards">
                                @include('ecommerce::front.payments.epayco-credit-card')
                            </div>
                            <div class="tab-pane fade" id="pse" role="tabpanel"
                                aria-labelledby="v-pills-pse">
                                @include('ecommerce::front.payments.pse-epayco', ['option' => 'bankCode', 'value' =>
                                'bankName'])
                            </div>
                            @elseif($paymentGateway == 'baloto')
                            <div class="tab-pane fade " id="baloto" role="tabpanel" aria-labelledby="baloto-tab">
                                @include('ecommerce::front.payments.baloto')
                            </div>
                            @elseif($paymentGateway == 'efecty')
                            <div class="tab-pane fade" id="efecty" role="tabpanel" aria-labelledby="efecty-tab">
                                @include('ecommerce::front.payments.efecty')
                            </div>
                            @elseif($paymentGateway == 'bank-transfer')
                            <div class="tab-pane fade" id="bancolombia" role="tabpanel"
                                aria-labelledby="bancolombia-tab">
                                @include('ecommerce::front.payments.bancolombia')
                            </div>
                            @else
                            @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
