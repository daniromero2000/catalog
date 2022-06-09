<div class="row mx-0 py-3">
    <div class="col-lg-6">
        <div class="p-2">
            @if(isset($product->cover))
            <img id="main-image" class="img-fluidlazy " src="{{ asset("storage/$product->cover") }}?w=400"
                data-zoom="{{ asset("storage/$product->cover") }}?w=1200">
            @else
            <img id="main-image" class="img-fluid lazy" src="{{ asset('img/blank.jpg') }}"
                data-zoom="{{ asset("storage/$product->cover") }}?w=1200" alt="{{ $product->name }}">
            @endif
        </div>
    </div>
    <div class="col-lg-6">
        <div class="product-description  w-100 p-2 my-auto">
            <div class="w-100 text-center">
                <div class="w-100">
                    <h4 class="">{{ $product->name }}
                    </h4>
                </div>
                <div id="priceProduct pl-2" style=" position: relative; ">
                    @if ($product->sale_price > 0)
                    <div class="card-products-discount text-center">
                        @php
                        $discount = round((($product->price - $product->sale_price) / $product->price) * 100);
                        @endphp
                        <p>{{$discount}}%</p>
                        <p>Dcto</p>
                    </div>
                    @endif
                    @if ($product->sale_price > 0)
                    <p style="color:black; font-size: 24px;margin-bottom: 0px;">
                        <small>
                            <del>${{ number_format($product->price, 0) }} </del> </small>
                    </p>
                    <p style="color:black; font-size: 30px;line-height: 24px; ">
                        <small><b>
                                ${{ number_format($product->sale_price, 0) }}
                            </b>
                        </small><br>
                    </p>
                    @else
                    <p style="color:black; font-size: 30px;line-height: 24px;">
                        <small>
                            ${{ number_format($product->price, 0) }} </small>
                        <br>
                    </p>
                    @endif
                </div>
            </div>
            <div class="description text-center">{!! $product->description !!}</div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('cart.store') }}" class="form-inline" method="post">
                        @csrf
                        @if(isset($product->attributes) && !$product->attributes->isEmpty())
                        <div class="w-100">
                            <div class="form-group  mb-2">
                                <div class="w-100">
                                    <label class=" mb-2" for="productAttribute"><span class="mr-auto"><b>Elige tu
                                                talla</b></span></label>
                                </div>

                                <div class="container-sizes w-100" id="sizes">
                                    <input type="hidden" required name="productAttribute"
                                        id="productAttribute{{$product->id}}">
                                    @foreach($product->attributes as $productAttribute)
                                    @foreach($productAttribute->attributesValues as $key => $value)
                                    @if ($value->attribute->name == 'Talla')
                                    <div class="sizes" id="sizes{{$productAttribute->id}}"
                                        onclick="addValue({{$productAttribute->id}})">
                                        <span class="m-auto" onclick="addValue({{$productAttribute->id}})">
                                            <p class="m-auto">{{ ucwords($value->value) }}</p>
                                        </span>
                                    </div>
                                    @endif
                                    @endforeach
                                    @endforeach
                                </div>

                            </div>
                        </div>
                        <hr>
                        @endif
                        <div class="row mx-0 w-100 ">
                            <div class=" col-xl-12">
                                <div class="input-group mx-auto mt-2">
                                    <div class="input-group mb-3 container-quanty mx-auto">
                                        <div class="input-group-prepend">
                                            <button type="button" class="btn btn-sm minus-btn"
                                                onclick="resId({{$product->id}})"><i class="fa fa-minus"></i></button>
                                        </div>
                                        <input type="text" id="qty_input{{$product->id}}" name="quantity"
                                            class="form-control form-control-sm text-center" value="1" min="1">
                                        <div class="input-group-prepend">
                                            <button type="button" class="btn btn-sm plus-btn"
                                                onclick="sumId({{$product->id}})"><i class="fa fa-plus"></i></button>
                                        </div>
                                        <input type="hidden" id="qty_input_real{{$product->id}}" class="" value="1"
                                            min="1">
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-12">
                                <button type="button" onclick="addCartWishlist({{$product->id}},{{  $data->id }},'2')"
                                    class="btn button-reset btn-block mx-auto mt-2">
                                    <i class="fas fa-cart-plus"></i> Agregar a carrito
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
