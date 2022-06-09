@section('tags')
<script>
    window.dataLayer=window.dataLayer||[];function gtag(){dataLayer.push(arguments);} gtag('js',new Date());gtag('config','UA-175178939-1',{'page_title':'home','page_path':"/cart"});
</script>
@endsection
@section('styles')
<link rel="stylesheet" href="{{ asset('css/front/cart/app.min.css')}}">
<style>
    @media (min-width:768px) {
        .h-card-cupon {
            max-height: 146px;
        }
    }
</style>
@endsection
@section('content')
<div class="container-reset product-in-cart-list content-empty">
    <div class="alert mt-3 container text-center alert-warning fade show mb-4" role="alert">
        Tu compra es <strong>100% segura</strong>
    </div>
    @if(!$cartItems->isEmpty())
    <div class="row mx-0 mt-3">
        <div class="col-md-12 px-2">
            <div class="row bg-header-cart py-2 container-xl mx-auto">
                <h3 class="px-3">EN EL CARRITO</h3>
            </div>
            <div class="row bg-cart header-cart py-3 container-xl mx-auto">
                <div class="col-xl-5 col-md-5 offset-xl-1"><b class="pl-md-4 pl-lg-5">Producto</b></div>
                <div class="col-xl-1 col-md-2 text-md-center"><b>Cantidad</b></div>
                <div class="col-xl-1 col-md-1 text-md-center"><b>Envío</b></div>
                <div class="col-xl-1 col-md-2 text-md-center"><b>Precio</b></div>
                <div class="col-xl-1 col-md-1 text-md-center"><b>Total</b></div>
            </div>
            @foreach($cartItems as $cartItem)
            <div class="row bg-cart py-3 relative container-xl mx-auto">
                <div class="col-xl-5 col-md-5 col-sm-12 offset-xl-1 mb-3">
                    <div class="row mx-0">
                        <div class="text-center col-sm-3 col-xl-2">
                            <a href="{{ route('front.get.product', [$cartItem->product->slug]) }}" class="hover-border">
                                @if(isset($cartItem->cover))
                                <img src="{{$cartItem->cover}}" alt="{{ $cartItem->name }}" class="cover">
                                @else
                                <img src="{{ asset('img/blank.jpg') }}" alt="default" class="cover">
                                @endif
                            </a>
                        </div>
                        <div class="text-center col-sm-9 col-xl-10">
                            <div class="px-md-3">
                                <p class="title-product">{{ $cartItem->name }}</p>
                                @if($cartItem->options->has('combination'))
                                <div style="margin-bottom:5px;">
                                    <small class="label label-primary small-reset">
                                        @foreach($cartItem->options->combination as $option)
                                        {{$option['value']}}
                                        @endforeach
                                    </small>
                                </div>
                                @endif
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xl-1 col-md-2 col-sm-3 px-0 text-center">
                    <div class="input-group mx-auto">
                        <div class="input-group mb-3 container-quanty mx-auto">
                            <div class="input-group-prepend">
                                <button type="button" class="bg-white btn-sm minus-btn"
                                    onclick="minus({{$cartItem->id}})" id="minus-btn{{$cartItem->id}}"><i
                                        class="fa fa-minus"></i></button>
                            </div>
                            <input type="text" id="qty_input{{$cartItem->id}}"
                                class="form-control form-control-sm text-center" value="{{ $cartItem->qty }}" min="1">
                            <div class="input-group-prepend">
                                <button type="button" class="bg-white btn-sm plus-btn" onclick="max({{$cartItem->id}})"
                                    id="plus-btn{{$cartItem->id}}"><i class="fa fa-plus"></i></button>
                            </div>
                            <input type="hidden" id="row{{$cartItem->id}}" value="{{$cartItem->rowId}}">
                            <input type="hidden" id="qty_input_real{{$cartItem->id}}" name="quantity" class=""
                                value="{{ $cartItem->qty }}" min="1">
                        </div>
                    </div>
                </div>
                <div class="col-xl-1 col-md-1 col-sm-3 text-center">
                    <b class="hidden">Envío:</b>
                    <small>
                        <b class="small-reset">A CALCULAR</b>
                    </small>
                </div>
                <div class="col-xl-1 col-md-2 col-sm-2 text-center">
                    <p>
                        <b class="hidden">Precio:</b>
                        @if ($cartItem->sale_price > 0)
                        <small>
                            <del>${{ number_format($cartItem->price, 0) }} </del> </small>

                        <small>
                            ${{ number_format($cartItem->sale_price, 0) }} </small>
                        @else
                        <small>
                            ${{ number_format($cartItem->price, 0) }} </small>
                        @endif

                    </p>

                </div>

                <div class="col-xl-1 col-md-1 col-sm-2 text-center">
                    <p class="small-reset">
                        <b class="hidden">Total:</b>
                        {{config('cart.currency')}}
                        <small id="{{$cartItem->id}}">
                            ${{ number_format(($cartItem->qty*$cartItem->price), 0) }}</small>
                    </p>
                </div>
                <div class="col-xl-1 col-md-1 col-sm-2 col-1 text-center px-0 options">
                    <div class="btn-group">
                        <form action="{{ route('cart.destroy', $cartItem->rowId) }}" method="post">
                            @csrf
                            <input type="hidden" name="_method" value="delete">
                            <button data-toggle="tooltip" data-placement="top" title="Remover"
                                onclick="return confirm('Estas seguro?')" class="btn btn-sm"><i
                                    class="fa fa-times"></i></button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        <div class="w-100">
            <div class="mx-auto line-bottom"></div>
        </div>
    </div>
    <div class="row container-xl mx-auto px-0 mb-4">
        <div class="col-md-6 col-lg-7 pl-lg-0 h-card-cupon">
            <div class="card-body bg-card-cupon" style=" background: #f1f0f0; min-height: 220px;">
                <div class="py-4 py-sm-5 px-sm-3 p-lg-5">
                    <label for=""> <b>TU CUPÓN AQUI</b></label>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="Ingresar" aria-label="Ingresar"
                            aria-describedby="button-addon2" disabled>
                        <div class="input-group-append">
                            <button class="btn bg-blue-page text-white" type="button" id="button-addon2"
                                disabled><b>Agregar</b></button>
                        </div>
                    </div>
                </div>

            </div>

        </div>
        <div class="col-md-6 col-lg-5 pr-lg-0">
            <div class="card-body bg-card-payment" style=" background: #f1f0f0; min-height: 220px;">
                <div class="mx-auto" style=" max-width: 325px; ">
                    <div class="row py-2 px-5 ">
                        <div class="col-12 mt-2 justify-content-between d-flex">SUBTOTAL
                            <b id="subtotalCart">${{ number_format($subtotal, 0) }}</b></div>
                        @if(isset($shippingFee) && $shippingFee != 0)
                        <div class="col-12 mt-2 justify-content-between d-flex">ENVÍO
                            <span class="small"> <b> A CALCULAR </b></span></div>
                        @endif
                        <div class="col-12 mt-2 justify-content-between d-flex">IMPUESTOS
                            <b>${{ number_format($tax, 0) }}</b>
                        </div>
                        <div class="col-12 mt-2 justify-content-between d-flex">TOTAL
                            <b id="totalCart">${{ number_format($total, 0) }}</b></div>
                        <div class="mt-4 d-flex mx-auto btn-payment">
                            <a href="{{ route('checkout.index') }}"
                                class="btn bg-blue-page text-white mx-auto"><b>FINALIZAR
                                    COMPRA</b></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row container-xl mx-auto">
        <h5 class="pl-4 pt-4 pb-4 pr-0">
            <a href="{{ route('/') }}" style=" text-decoration: none; color: black; ">
                <i class="fas fa-caret-left"></i>
                ELEGIR MÁS PRODUCTOS
            </a>
        </h5>
    </div>
    @else
    <div class="row mx-0 ">
        <div class="col-md-12 ">
            <div class="text-center alert-shop p-sm-5">
                <img src="{{ asset('img/logos/cart.png')}}" alt="carrito">
                <h3>Tu carrito está vacío</h3>
                <p>En nuestra tienda tenemos una gran variedad de productos para que elijas los que más te gusten!</p>
                <a href="{{ route('/') }}" class="btn bg-warning-reset">Sigue comprando</a>
            </div>

        </div>
    </div>
    @endif
</div>
@endsection
@section('scripts')
@endsection
