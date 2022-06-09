@extends('layouts.front.app')
@section('styles')
<style>
    .nav-link {
        padding-left: 11px;
    }

    .paymentMethods {
        background-color: #ffffff !important;
        color: #3c3a3a !important;
    }

    .paymentMethods.active {
        background-color: #f7f7f7 !important;
        color: #2c2828 !important;
    }

    .paymentMethods:hover {
        background-color: #f7f7f7 !important;
        color: #2c2828 !important;
    }

    .bg-paymentMethods {
        background: #f7f7f7;
    }

    .tab-pane {
        background: #f7f7f7;
    }

    .container-card {
        width: 60px;
        padding: 0px;
        margin: auto;
        text-align: center;
    }

    .breadcrumb {
        display: flex;
        margin-bottom: 1rem;
        padding: .5rem 1rem;
        list-style: none;
        border-radius: .375rem;
        background-color: #f6f9fc;
        flex-wrap: wrap;
    }

    .breadcrumb-item {
        font-size: .875rem;
    }

    .breadcrumb-item+.breadcrumb-item {
        padding-left: .5rem;
    }

</style>
@endsection
@section('content')
<div class="container-reset content-empty mb-2">
    @if(!$products->isEmpty())
    <div class="row mx-0">
        <div class="col-12">
            <ol class="breadcrumb-reset mb-0">
                <li><a href="{{ route('/') }}"> Home </a> <span> /</span></li>
                <li><a href="/cart">Carrito de Compras</a> <span>
                        /</span> </li>
                <li class="active"> Checkout</li>
            </ol>
        </div>
        <div class="col-12">
            <nav class="nav justify-content-center">
                <li class="nav-item">
                    <div class="row justify-content-center">
                        <div class="d-flex">
                            <a class="my-auto text-secondary">Tu pago es seguro con </a>
                        </div>
                        <div style="max-width: 95px;margin: auto;">
                            <img src="{{asset('img/cards/payu-logo.png')}}" class="img-fluid lazy" alt="payu-logo">
                        </div>
                    </div>
                </li>
            </nav>
        </div>
        @if($errors->all() || session()->has('error') || session()->has('message'))
        <div class="col-12  content">
            <div class="card-body">
                @include('generals::layouts.errors-and-messages')
            </div>
        </div>
        @endif
        <div class="col-md-7 my-2 p-0 p-sm-3">
            @if(isset($addresses))
            <div class="w-100">
                <div class="card">
                    <div class="card-body">
                        <div class="w-100 d-flex justify-content-between">
                            <div class="my-auto">
                                <h6>Direcciones</h6>
                            </div>
                            <div class="my-auto">
                                <button type="submit" class="btn btn-sm btn-primary" data-toggle="modal"
                                    data-target="#exampleModal">Agregar Dirección</button>
                            </div>
                        </div>
                        @if(!empty($addresses->toArray()))
                        <div class="table-responsive">
                            <table class="table-striped table  mt-3 text-center">
                                <thead class="text-sm">
                                    <th>Dirección</th>
                                    <th>Dirección de facturación</th>
                                    <th>Dirección de entrega</th>
                                </thead>
                                <tbody class="text-sm">
                                    @foreach($addresses as $key => $address)
                                    <tr>
                                        <td><span id="address{{$address->id}}">
                                                {{ $address->customer_address }}
                                            </span>
                                            <br />
                                            @if(!is_null($address->province))
                                            {{ $address->city->city }} {{ $address->province->name }} <br />
                                            @endif
                                            <span id="city{{$address->id}}">{{ $address->city->city }}
                                                {{ $address->state_code }}</span>
                                            <br>
                                            {{ $address->zip }}
                                        </td>
                                        <td>
                                            <label class="col-md-6 col-md-offset-3">
                                                <input type="radio" value="{{ $address->id }}" name="billingAddress"
                                                    @if($billingAddress->id ==
                                                $address->id) checked="checked" @endif>
                                            </label>
                                        </td>
                                        <td>
                                            @if($billingAddress->id == $address->id)
                                            <label for="sameDeliveryAddress">
                                                <input type="checkbox" id="sameDeliveryAddress" checked="checked"> Igual
                                                que
                                                la facturación
                                            </label>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tbody style="display: none" id="sameDeliveryAddressRow">
                                    @foreach($addresses as $key => $address)
                                    <tr>
                                        <td>{{ $address->alias }}</td>
                                        <td>
                                            {{ $address->customer_address }} <br />
                                            @if(!is_null($address->province))
                                            {{ $address->city->city }} {{ $address->province->name }} <br />
                                            @endif
                                            {{ $address->city->city }} {{ $address->state_code }} <br>
                                            {{ $address->zip }}
                                        </td>
                                        <td></td>
                                        <td>
                                            <label class="col-md-6 col-md-offset-3">
                                                <input type="radio" value="{{ $address->id }}" name="delivery_address"
                                                    @if(old('')==$address->id)
                                                checked="checked" @endif>
                                            </label>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        @else
                        <div class="alert alert-info py-2 px-3 mt-2" role="alert">
                            ¡No tienes direcciones registradas!. Por favor selecciona la opción "Agregar Dirección" para
                            registrar la dirección de envío y poder continuar con el proceso de compra.
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endif
            @if(!is_null($rates))
            <div class="w-100">
                <div class="card">
                    <div class="card-body">
                        <legend><i class="fa fa-truck"></i> Courier</legend>
                        <ul class="list-unstyled">
                            @foreach($rates as $rate)
                            <li class="col-md-4">
                                <label class="radio">
                                    <input type="radio" name="rate" data-fee="{{ $rate->amount }}"
                                        value="{{ $rate->object_id }}">
                                </label>
                                <img src="{{ $rate->provider_image_75 }}" alt="courier" class="img-thumbnail" />
                                {{ $rate->currency }} {{ $rate->amount }}<br />
                                {{ $rate->servicelevel->name }}
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
            @endif
            @php
            @endphp
            @if(!empty($addresses->toArray()))
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
                                        <a class="nav-link paymentMethods active" id="v-pills-creditCards"
                                            data-toggle="pill" href="#creditCards" role="tab"
                                            aria-controls="creditCards" aria-selected="true">Tarjeta de crédito</a>
                                        <a class="nav-link paymentMethods" id="v-pills-pse" data-toggle="pill"
                                            href="#pse" role="tab" aria-controls="pse" aria-selected="true">Pago PSE</a>
                                        <a class="nav-link paymentMethods" id="v-pills-profile-tab" data-toggle="pill"
                                            href="#v-pills-profile" role="tab" aria-controls="v-pills-profile"
                                            aria-selected="false">Baloto </a>
                                        <a class="nav-link paymentMethods" id="v-pills-messages-tab" data-toggle="pill"
                                            href="#v-pills-messages" role="tab" aria-controls="v-pills-messages"
                                            aria-selected="false">Efecty o Gana</a>
                                        <a class="nav-link paymentMethods" id="v-pills-settings-tab" data-toggle="pill"
                                            href="#v-pills-settings" role="tab" aria-controls="v-pills-settings"
                                            aria-selected="false">QR Bancolombia</a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-8 px-0 bg-paymentMethods">
                                <div class="mx-3">
                                    <div class="tab-content" id="v-pills-tabContent">
                                        <div class="tab-pane fade show active" id="creditCards" role="tabpanel"
                                            aria-labelledby="v-pills-creditCards">
                                            @include('ecommerce::front.payments.credit-card')
                                        </div>
                                        <div class="tab-pane fade" id="pse" role="tabpanel"
                                            aria-labelledby="v-pills-pse">
                                            @include('ecommerce::front.payments.pse')
                                        </div>
                                        <div class="tab-pane fade " id="v-pills-profile" role="tabpanel"
                                            aria-labelledby="v-pills-profile-tab">
                                            <div class="row mb-3 justify-content-center">
                                                <div class="p-3 text-center">
                                                    <div style="max-width: 135px;margin: auto;">
                                                        <img src="{{asset('img/cards/baloto.png')}}" class="img-fluid lazy"
                                                            alt="baloto">
                                                    </div>
                                                    Consignación vía Baloto
                                                    <br>
                                                    <br>
                                                    <form action="{{ route('baloto.store') }}" class="form-horizontal"
                                                        method="post">
                                                        @csrf
                                                        <div class="btn-group">
                                                            <button onclick="return confirm('¿Estás Seguro?')"
                                                                class="btn btn-primary btn-sm mx-auto">Continuar con
                                                                este
                                                                método de pago</button>
                                                            <input type="hidden" name="billingAddress"
                                                                value="{{ $billingAddress->id }}">
                                                            @if(request()->has('courier'))
                                                            <input type="hidden" name="courier"
                                                                value="{{ request()->input('courier') }}">
                                                            @endif
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-messages" role="tabpanel"
                                            aria-labelledby="v-pills-messages-tab">
                                            <div class="row mb-3 justify-content-center">
                                                <div class="p-3 text-center">
                                                    Giro a cuenta
                                                    <br>
                                                    <br>
                                                    <div style="max-width: 135px;margin: auto;">
                                                        <img src="{{asset('img/cards/efecty.png')}}" class="img-fluid lazy"
                                                            alt="logo-efecty">
                                                        <img src="{{asset('img/cards/gana.png')}}" class="img-fluid lazy"
                                                            alt="logo-gana">
                                                    </div>
                                                    <br>
                                                    <form action="{{ route('efecty.store') }}" class="form-horizontal"
                                                        method="post">
                                                        @csrf
                                                        <div class="btn-group">
                                                            <button onclick="return confirm('¿Estás Seguro?')"
                                                                class="btn btn-primary btn-sm mx-auto">Continuar con
                                                                este
                                                                método de pago</button>
                                                            <input type="hidden" name="billingAddress"
                                                                value="{{ $billingAddress->id }}">
                                                            @if(request()->has('courier'))
                                                            <input type="hidden" name="courier"
                                                                value="{{ request()->input('courier') }}">
                                                            @endif
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="v-pills-settings" role="tabpanel"
                                            aria-labelledby="v-pills-settings-tab">
                                            <div class="row mb-3 justify-content-center">
                                                <div class="p-3 text-center">
                                                    <div style="max-width: 135px;margin: auto;">
                                                        <img src="{{asset('img/cards/logo-bancolombia.png')}}"
                                                            class="img-fluid lazy" alt="logo-bancolombia">
                                                    </div>
                                                    Pago a través de transferencia electrónica directa a una cuenta de
                                                    ahorros o a través de código QR
                                                    <br>
                                                    <br>
                                                    <form action="{{ route('bank-transfer.store') }}"
                                                        class="form-horizontal" method="post">
                                                        @csrf
                                                        <div class="btn-group">
                                                            <button onclick="return confirm('¿Estás Seguro?')"
                                                                class="btn btn-primary btn-sm mx-auto">Continuar con
                                                                este
                                                                método de pago</button>
                                                            <input type="hidden" name="billingAddress"
                                                                value="{{ $billingAddress->id }}">
                                                            @if(request()->has('courier'))
                                                            <input type="hidden" name="courier"
                                                                value="{{ request()->input('courier') }}">
                                                            @endif
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
        </div>
        <div class="col-md-5 my-2 p-0 p-sm-3 order-md-last">
            <div class="card" id="register">
            </div>
        </div>
    </div>
    @else
    <div class="row">
        <div class="col-12 mb-2 mt-4">
            <p class="alert alert-warning">No hay productos en el carrito aún. <a class="text-white"
                    href="{{ route('/') }}"><b>Ver
                        productos!</b></a></p>
        </div>
    </div>
    @endif
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar dirección</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('customer.address.store', $customer->id) }}" method="post" class="form"
                enctype="multipart/form-data">
                <div class="modal-body">

                    <input type="hidden" name="default_address" value="1">
                    <div class="card-body p-2">
                        @csrf
                        <div class="form-group">
                            <label for="customer_address">Dirección <span class="text-danger">*</span></label>
                            <input type="text" required name="customer_address" id="customer_address"
                                placeholder="Dirección" class="form-control" value="{{ old('customer_address') }}">
                        </div>
                        <div class="form-group">
                            <label for="country_id">País </label>
                            <select name="country_id" id="country_id" required class="form-control select2">
                                <option value="">Selecciona</option>
                                @foreach($countries as $country)
                                <option @if(env('SHOP_COUNTRY_ID')==$country->id) selected="selected" @endif
                                    value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="provinces" class="form-group" style="display: none;"></div>
                        <div id="cities" class="form-group" style="display: none;"></div>
                        <div class="form-group">
                            <label for="phone">Tu Teléfono </label>
                            <input type="text" name="phone" id="phone" required placeholder="Teléfono"
                                class="form-control" value="{{ old('phone') }}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                    <button type="submmit" class="btn btn-primary btn-sm">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')


<script type="text/javascript">
    function cart() {
        $.get('/api/getCart/', function (data) {
            var cart = '<div class="px-4 pt-4">Resumen de la compra</div>';
            data.cartItems.forEach(e => {
                cart +=
                    '<div class="card-body"><a href="/cart" class="dropdown-item"> <div class="media"> <img src="' +
                    e.cover + '" alt="' + e.slug +
                    '" class="img-size-50 mr-3 img-circle"> <div class="media-body"> <h3 class="dropdown-item-title"> ' +
                    e.name +
                    ' </h3> <p class="text-sm"></p> <p class="text-sm text-muted"><i class="fas fa-dollar-sign"></i> ' +
                    e.price + ' x ' + e.qty +
                    '</p> </div> </div>  </a> <div class="dropdown-divider"></div></div>'
            });
            const formatter = new Intl.NumberFormat('es-CO', {
                style: 'currency',
                currency: 'COP',
                minimumFractionDigits: 0
            })
            data.subtotal = formatter.format(data.subtotal);
            data.tax = formatter.format(data.tax);
            data.shippingFee = formatter.format(data.shippingFee);
            data.total = formatter.format(data.total);
            $('#totalCart').html('Total - ' + data.total);
            $('#totalEfecty').html('Total - ' + data.total);
            $('.total').html(data.total + ' COP');

            cart = cart != '' ? cart +=
                '<div class=""> <div class="media"> <div class="media-body d-flex justify-content-between px-5 my-1"> <p class="text-sm subtotal" style=" font-size: 15px !important; margin: auto 0; ">Subtotal</p> <p class="text-sm text-muted price">' +
                data.subtotal +
                '</p> </div> </div>  <div class="media"> <div class="media-body d-flex justify-content-between px-5 my-1"> <p class="text-sm subtotal" style=" font-size: 15px !important; margin: auto 0; ">Impuestos</p> <p class="text-sm text-muted price">' +
                data.tax +
                '</p> </div> </div>  </div> <div class="media"> <div class="media-body d-flex justify-content-between px-5 my-1"> <p class="text-sm subtotal" style=" font-size: 15px !important; margin: auto 0; ">Envío</p> <p class="text-sm text-muted price">' +
                data.shippingFee +
                '</p> </div> </div>  <div class="media"> <div class="media-body d-flex justify-content-between px-5 my-1"> <p class="text-sm subtotal" style=" font-size: 15px !important; margin: auto 0; ">Total</p> <p class="text-sm text-muted price">' +
                data.total + '</p> </div> </div> </div><div class="dropdown-divider"></div>' :
                '<a href="#" class="dropdown-item dropdown-footer">Tu carrito está vacío </a> <div class="dropdown-item dropdown-footer"> <div class="px-3"> <a href="/cart" class="btn button-reset d-block">Ir al carrito</a> </div> </div>';

            $('#register').html(cart);
        });
    }
    cart();

    function setTotal(total, shippingCost) {
        let computed = +shippingCost + parseFloat(total);
        $('#total').html(computed.toFixed(2));
    }

    function setShippingFee(cost) {
        el = '#shippingFee';
        $(el).html(cost);
        $('#shippingFeeC').val(cost);
    }

    function setCourierDetails(courierId) {
        $('.courier_id').val(courierId);
    }

    $(document).ready(function () {

        let clicked = false;

        $('#sameDeliveryAddress').on('change', function () {
            clicked = !clicked;
            if (clicked) {
                $('#sameDeliveryAddressRow').show();
            } else {
                $('#sameDeliveryAddressRow').hide();
            }
        });

        let billingAddress = 'input[name="billingAddress"]';

        $(billingAddress).on('change', function () {
            let chosenAddressId = $(this).val();
            $('.address_id').val(chosenAddressId);
            $('.delivery_address_id').val(chosenAddressId);
            $('input[name="billingAddress"]').val(chosenAddressId);
        });

        let deliveryAddress = 'input[name="delivery_address"]';
        $(deliveryAddress).on('change', function () {
            let chosenDeliveryAddressId = $(this).val();
            $('.delivery_address_id').val(chosenDeliveryAddressId);
        });

        let courier = 'input[name="courier"]';
        $(courier).on('change', function () {
            let shippingCost = $(this).data('cost');
            let total = $('#total').data('total');

            setCourierDetails($(this).val());
            setShippingFee(shippingCost);
            setTotal(total, shippingCost);
        });

        if ($(courier).is(':checked')) {
            let shippingCost = $(courier + ':checked').data('cost');
            let courierId = $(courier + ':checked').val();
            let total = $('#total').data('total');

            setShippingFee(shippingCost);
            setCourierDetails(courierId);
            setTotal(total, shippingCost);
        }
    });

</script>
<script type="text/javascript">
    function findProvinceOrState(countryId) {
        $.ajax({
            url: '/api/v1/country/' + countryId + '/province',
            contentType: 'json',
            success: function (res) {
                if (res.data.length > 0) {
                    let html = '<label for="province_id">Provinces </label>';
                    html +=
                        '<select name="province_id" id="province_id" required class="form-control select2"> <option value="">Selecciona</option> ';
                    $(res.data).each(function (idx, v) {
                        html += '<option value="' + v.id + '">' + v.name + '</option>';
                    });
                    html += '</select>';

                    $('#provinces').html(html).show();
                    $('.select2').select2();

                    findCity(countryId, 1);

                    $('#province_id').change(function () {
                        var provinceId = $(this).val();
                        findCity(countryId, provinceId);
                    });
                } else {
                    $('#provinces').hide().html('');
                    $('#cities').hide().html('');
                }
            }
        });
    }

    function findCity(countryId, provinceOrStateId) {
        $.ajax({
            url: '/api/v1/country/' + countryId + '/province/' + provinceOrStateId + '/city',
            contentType: 'json',
            success: function (data) {
                let html = '<label for="city_id">City </label>';
                html +=
                    '<select name="city_id" id="city_id" required class="form-control select2">    <option value="">Selecciona</option>';
                $(data.data).each(function (idx, v) {
                    html += '<option value="' + v.id + '">' + v.name + '</option>';
                });
                html += '</select>';

                $('#cities').html(html).show();
                $('.select2').select2();
            },
            errors: function (data) {
            }
        });
    }

    function findUsStates() {
        $.ajax({
            url: '/country/' + countryId + '/state',
            contentType: 'json',
            success: function (res) {
                if (res.data.length > 0) {
                    let html = '<label for="state_code">States </label>';
                    html +=
                        '<select name="state_code" id="state_code" required class="form-control select2">    <option value="">Selecciona</option>';
                    $(res.data).each(function (idx, v) {
                        html += '<option value="' + v.state_code + '">' + v.state + '</option>';
                    });
                    html += '</select>';

                    $('#provinces').html(html).show();
                    $('.select2').select2();

                    findUsCities('AK');

                    $('#state_code').change(function () {
                        let state_code = $(this).val();
                        findUsCities(state_code);
                    });
                } else {
                    $('#provinces').hide().html('');
                    $('#cities').hide().html('');
                }
            }
        });
    }

    function findUsCities(state_code) {
        $.ajax({
            url: '/state/' + state_code + '/city',
            contentType: 'json',
            success: function (res) {
                if (res.data.length > 0) {
                    let html = '<label for="city">City </label>';
                    html +=
                        '<select name="city" id="city" required class="form-control select2"> <option value="">Selecciona</option>';
                    $(res.data).each(function (idx, v) {
                        html += '<option value="' + v.name + '">' + v.name + '</option>';
                    });
                    html += '</select>';

                    $('#cities').html(html).show();
                    $('.select2').select2();

                    $('#state_code').change(function () {
                        let state_code = $(this).val();
                        findUsCities(state_code);
                    });
                } else {
                    $('#provinces').hide().html('');
                    $('#cities').hide().html('');
                }
            }
        });
    }
    let countryId = +"{{ env('SHOP_COUNTRY_ID') }}";

</script>
<script>
    $(document).ready(function () {

        $('#country_id').change(function () {
            var city = $('#country_id').val();
            getCity(city);
        });

        function getCity(city) {
            $.get('/api/getCountry/' + city + '/province/', function (data) {
                if (data) {
                    let html = '<label for="province_id">Departamento </label>';
                    html +=
                        '<select  id="province_id" onchange="getProvince()" required class="form-control select2"> <option value="">Selecciona</option>';
                    $(data).each(function (idx, v) {
                        html += '<option value="' + v.id + '">' + v.province + '</option>';
                    });
                    html += '</select>';

                    $('#provinces').html(html).show();
                }
            });
        }

        $('#province_id').change(function () {
            getProvince(province);
        });


    });

    function getProvince() {
        var province = $('#province_id').val();
        $.get('/api/getProvince/' + province + '/city/', function (data) {
            if (data) {
                let html = '<label for="city">Ciudad </label>';
                html +=
                    '<select name="city_id" id="city_id" required class="form-control select2"> <option value="">Selecciona</option>';
                $(data).each(function (idx, v) {
                    html += '<option value="' + v.id + '">' + v.city + '</option>';
                });
                html += '</select>';

                $('#cities').html(html).show();
            }


        });
    }

</script>


@endsection
