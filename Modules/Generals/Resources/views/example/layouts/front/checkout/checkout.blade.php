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
            @include('ecommerce::front.checkout.layouts.headers.header_option_one')
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
            @include('ecommerce::front.checkout.layouts.addresses.addresses_option_one')
            @endif
            @if(!is_null($rates))
            @include('ecommerce::front.checkout.layouts.couriers.courier_option_one')
            @endif
            @if(!empty($addresses->toArray()))
            @include('ecommerce::front.checkout.layouts.payment_methods.payment_methods_option_one')
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

@endsection
@section('scripts')


<script type="text/javascript">
    function cart() {
    $.get('/api/getCart/', function (data) {
        var cart = '<div class="px-4 pt-4">Resumen de la compra</div>';
        data.cartItems.forEach(e => {
            cart += '<div class="card-body"><a href="/cart" class="dropdown-item"> <div class="media"> <img src="' + e.cover + '" alt="' + e.slug + '" class="img-size-50 mr-3 img-circle"> <div class="media-body"> <h3 class="dropdown-item-title"> ' + e.name + ' </h3> <p class="text-sm"></p> <p class="text-sm text-muted"><i class="fas fa-dollar-sign"></i> ' + e.price + ' x ' + e.qty + '</p> </div> </div>  </a> <div class="dropdown-divider"></div></div>'
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

        cart = cart != '' ? cart += '<div class=""> <div class="media"> <div class="media-body d-flex justify-content-between px-5 my-1"> <p class="text-sm subtotal" style=" font-size: 15px !important; margin: auto 0; ">Subtotal</p> <p class="text-sm text-muted price">' + data.subtotal + '</p> </div> </div>  <div class="media"> <div class="media-body d-flex justify-content-between px-5 my-1"> <p class="text-sm subtotal" style=" font-size: 15px !important; margin: auto 0; ">Impuestos</p> <p class="text-sm text-muted price">' + data.tax + '</p> </div> </div>  </div> <div class="media"> <div class="media-body d-flex justify-content-between px-5 my-1"> <p class="text-sm subtotal" style=" font-size: 15px !important; margin: auto 0; ">Envío</p> <p class="text-sm text-muted price">' + data.shippingFee + '</p> </div> </div>  <div class="media"> <div class="media-body d-flex justify-content-between px-5 my-1"> <p class="text-sm subtotal" style=" font-size: 15px !important; margin: auto 0; ">Total</p> <p class="text-sm text-muted price">' + data.total + '</p> </div> </div> </div><div class="dropdown-divider"></div>' : '<a href="#" class="dropdown-item dropdown-footer">Tu carrito está vacío </a> <div class="dropdown-item dropdown-footer"> <div class="px-3"> <a href="/cart" class="btn button-reset d-block">Ir al carrito</a> </div> </div>';

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

            let billingAddress = 'input[name="billing_address"]';

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
                url : '/api/v1/country/' + countryId + '/province',
                contentType: 'json',
                success: function (res) {
                    if (res.data.length > 0) {
                        let html = '<label for="province_id">Provinces </label>';
                        html += '<select name="province_id" id="province_id" required class="form-control select2"> <option value="">Selecciona</option> ';
                        $(res.data).each(function (idx, v) {
                            html += '<option value="'+ v.id+'">'+ v.name +'</option>';
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
                    html += '<select name="city_id" id="city_id" required class="form-control select2">    <option value="">Selecciona</option>';
                    $(data.data).each(function (idx, v) {
                        html += '<option value="'+ v.id+'">'+ v.name +'</option>';
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
                url : '/country/' + countryId + '/state',
                contentType: 'json',
                success: function (res) {
                    if (res.data.length > 0) {
                        let html = '<label for="state_code">States </label>';
                        html += '<select name="state_code" id="state_code" required class="form-control select2">    <option value="">Selecciona</option>';
                        $(res.data).each(function (idx, v) {
                            html += '<option value="'+ v.state_code+'">'+ v.state +'</option>';
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
                url : '/state/' + state_code + '/city',
                contentType: 'json',
                success: function (res) {
                    if (res.data.length > 0) {
                        let html = '<label for="city">City </label>';
                        html += '<select name="city" id="city" required class="form-control select2"> <option value="">Selecciona</option>';
                        $(res.data).each(function (idx, v) {
                            html += '<option value="'+ v.name+'">'+ v.name +'</option>';
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
    $( document ).ready(function() {

        $('#country_id').change(function () {
            var city = $('#country_id').val();
            getCity(city);
        });
        function getCity(city) {
            $.get('/api/getCountry/'+ city + '/province/', function (data) {
                if (data ) {
                    let html = '<label for="province_id">Departamento </label>';
                    html += '<select  id="province_id" onchange="getProvince()" required class="form-control select2"> <option value="">Selecciona</option>';
                        $(data).each(function (idx, v) {
                        html += '<option value="'+ v.id+'">'+ v.province +'</option>';
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
    $.get('/api/getProvince/'+ province + '/city/', function (data) {
    if (data) {
    let html = '<label for="city">Ciudad </label>';
    html += '<select name="city_id" id="city_id" required class="form-control select2"> <option value="">Selecciona</option>';
        $(data).each(function (idx, v) {
        html += '<option value="'+ v.id+'">'+ v.city +'</option>';
        });
        html += '</select>';

    $('#cities').html(html).show();
    }


    });
    }
</script>


@endsection
