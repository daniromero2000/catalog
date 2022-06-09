@extends('layouts.front.app')
<style>
    /* form starting stylings ------------------------------- */
    .group {
        position: relative;
        margin-bottom: 45px;
    }

    input {
        font-size: 18px;
        padding: 10px 10px 10px 5px;
        display: block;
        width: 100%;
        border: none;
        border-bottom: 1px solid #757575;
        background: transparent;
    }

    input:focus {
        outline: none;
    }

    /* LABEL ======================================= */
    label {
        color: #999;
        font-size: 18px;
        font-weight: normal;
        position: absolute;
        pointer-events: none;
        left: 5px;
        top: 10px;
        transition: 0.2s ease all;
        -moz-transition: 0.2s ease all;
        -webkit-transition: 0.2s ease all;
    }

    /* active state */
    input:focus~label,
    input:valid~label {
        top: -20px;
        font-size: 14px;
        color: #E72179;
    }

    /* BOTTOM BARS ================================= */
    .bar {
        position: relative;
        display: block;
        width: 100%;
    }

    .bar:before,
    .bar:after {
        content: '';
        height: 2px;
        width: 0;
        bottom: 1px;
        position: absolute;
        background: #E72179;
        transition: 0.2s ease all;
        -moz-transition: 0.2s ease all;
        -webkit-transition: 0.2s ease all;
    }

    .bar:before {
        left: 50%;
    }

    .bar:after {
        right: 50%;
    }

    /* active state */
    input:focus~.bar:before,
    input:focus~.bar:after {
        width: 50%;
    }

    /* HIGHLIGHTER ================================== */
    .highlight {
        position: absolute;
        height: 60%;
        width: 100px;
        top: 25%;
        left: 0;
        pointer-events: none;
        opacity: 0.5;
    }

    /* active state */
    input:focus~.highlight {
        -webkit-animation: inputHighlighter 0.3s ease;
        -moz-animation: inputHighlighter 0.3s ease;
        animation: inputHighlighter 0.3s ease;
    }

    /* ANIMATIONS ================ */
    @-webkit-keyframes inputHighlighter {
        from {
            background: #E72179;
        }

        to {
            width: 0;
            background: transparent;
        }
    }

    @-moz-keyframes inputHighlighter {
        from {
            background: #E72179;
        }

        to {
            width: 0;
            background: transparent;
        }
    }

    @keyframes inputHighlighter {
        from {
            background: #E72179;
        }

        to {
            width: 0;
            background: transparent;
        }
    }
</style>
@section('content')
<div class="container-reset content-empty mb-2">
    <div class="row my-5 mx-0">
        <div class="col-md-5 my-2 p-0 p-sm-3 order-md-last">
            <div class="card" id="register" style=" background: rgb(249 249 249);">
            </div>
        </div>

        <div class="col-md-7 p-0 p-sm-3 my-2">
            <div class="card"
                style=" background: linear-gradient(157deg, rgb(249 249 249) 64%, rgba(247,213,210,1) 100%); ">
                <div class="px-4 py-3 text-white" style=" background: black; ">Datos del comprador</div>
                <div class="card-body mt-2">
                    <form class="form-horizontal" role="form" method="POST" action="{{ route('register') }}">
                        @csrf
                        <div class="row mx-0">
                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <div class="group">
                                        <input id="name" type="text" required name="name" value="{{ old('name') }}">
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Nombres</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <div class="group">
                                        <input id="last_name" type="text" required name="last_name"
                                            value="{{ old('last_name') }}">
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Apellidos</label>
                                    </div>
                                    @if ($errors->has('last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('last_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <div class="group">
                                        <input id="email" required type="email" name="email"
                                            value="{{ request()->session()->get('email') }}">
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Email</label>
                                    </div>
                                    <label for="email" class="control-label"></label>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('identity_number') ? ' has-error' : '' }}">
                                    <div class="group">
                                        <input id="identity_number" required type="identity_number"
                                            name="identity_number" value="{{ old('identity_number') }}">
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Cédula</label>
                                    </div>
                                </div>
                            </div>
                            @if (str_contains(URL::previous(), 'cart'))
                            <input id="password" class="form-control" required name="password" value="12345678" hidden>
                            <input id="password-confirm" class="form-control" name="password_confirmation"
                                value="12345678" hidden>
                            @else
                            <div class="col-sm-6">
                                <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                    <div class="group">
                                        <input id="password" type="password" required name="password">
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Contraseña</label>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="group">
                                        <input id="password-confirm" type="password" required
                                            name="password_confirmation">
                                        <span class="highlight"></span>
                                        <span class="bar"></span>
                                        <label>Confirmar contraseña</label>
                                    </div>
                                </div>
                            </div>
                            @endif
                            <div class="col-12">
                                <div class="form-group">
                                    <div class=" col-md-offset-4 text-center">
                                        <button type="submit" class="btn btn-primary"
                                            style=" padding: 4px 20px 4px 20px;font-size: 18px;border-radius: 20px;background-color: #E72179;border-color: #E72179; ">
                                            Registrame
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    function cart() {
    $.get('/api/getCart/', function (data) {
        var cart = '<div class="px-4 py-3 text-white" style=" background: black; ">Resumen de la compra</div>';
        data.cartItems.forEach(e => {
            cart += '<div class="card-body"><a href="/cart" class="dropdown-item"> <div class="media"> <img src="' + e.cover + '" alt="' + e.slug + '" class="img-size-50 mr-3 img-circle"> <div class="media-body"> <h3 class="dropdown-item-title"> ' + e.name + ' </h3> <p class="text-sm"></p> <p class="text-sm text-muted"><i class="fas fa-dollar-sign"></i> ' + e.price + ' x ' + e.qty + '</p> </div> </div>  </a> <div class="dropdown-divider"></div></div>'
        });

        const formatter = new Intl.NumberFormat('es-CO', {
            style: 'currency',
            currency: 'COP',
            minimumFractionDigits: 0
        })
        data.subtotal = formatter.format(data.subtotal);

        cart = cart != '' ? cart += '<div class=""> <div class="media"> <div class="media-body d-flex justify-content-between px-4 py-2"> <p class="text-sm subtotal">Subtotal</p> <p class="text-sm text-muted price">' + data.subtotal + '</p> </div> </div>  </div> <div class="dropdown-divider"></div>' : '<a href="#" class="dropdown-item dropdown-footer">Tu carrito está vacío </a> <div class="dropdown-item dropdown-footer"> <div class="px-3"> <a href="/cart" class="btn button-reset d-block">Ir al carrito</a> </div> </div>';

        $('#register').html(cart);
    });
}
cart();

</script>
@endsection
