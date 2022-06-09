<div class="container-reset product">
    <div class="row mx-0 py-3 justify-content-center" style="margin-bottom: 10%;">
        <div class="col-xl-8 col-lg-7 mb-3">
            <div class="p-2 d-flex">
                <div class="horVerSlider" data-desktop="600" data-tabportrait="600" data-tablandscape="600"
                    data-mobilelarge="375" data-mobilelandscape="500" data-mobileportrait="375">
                    <div class="close"></div>
                    <div class="vertical-wrapper">
                        <div id="vertical-slider">
                            <ul>
                                <li class="ui-draggable ui-draggable-handle ui-draggable-disabled">
                                    <img class="img-fluid lazy" src="{{ asset("storage/$product->cover") }}"
                                        alt="{{$product->slug}}" style=" border-radius: 6px; "></li>
                                @if(isset($images) && !$images->isEmpty())
                                @foreach($images as $image)
                                <li class="ui-draggable ui-draggable-handle ui-draggable-disabled">
                                    <img class="img-fluid lazy" src="{{ asset("storage/$image->src") }}"
                                        alt="{{$product->slug}}" style=" border-radius: 6px; "></li>
                                @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="horizon-wrapper ">
                        <div class="horizone-nav">
                            <div class="prev" style="display: none;">
                                <div>
                                    <i class="fas fa-chevron-left"></i>
                                </div>
                            </div>
                            <div class="next" style="display: block;">
                                <div>
                                    <i class="fas fa-chevron-right"></i>
                                </div>
                            </div>
                        </div>
                        <div id="horizon-slider">
                            <ul>
                                <li class="ui-draggable bg-white zoom-img">
                                    <img class="img-fluid zoom lazy" src="{{ asset("storage/$product->cover") }}"
                                        alt="{{$product->slug}}" style=" border-radius: 15px; "></li>
                                @if(isset($images) && !$images->isEmpty())
                                @foreach($images as $image)
                                <li class="ui-draggable ui-draggable-handle ui-draggable-disabled bg-white zoom-img">
                                    <img class="img-fluid zoom lazy" src="{{ asset("storage/$image->src") }}"
                                        alt="{{$product->slug}}" style=" border-radius: 15px; "></li>
                                @endforeach
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-4 col-lg-5 col-md-8 col-sm-11 d-flex">
            <div class="product-description text-center w-100 p-2 my-auto">
                <div class="w-100">
                    <div class="w-100">
                        <h4 class="">{{ $product->name }}
                        </h4>
                    </div>
                    <div id="priceProduct{{$product->id}} pl-2" style=" position: relative; ">
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
                        <p class="text-center" style="font-size: 25px;margin-bottom: 0px;color: #585858;">

                            <del>${{ number_format($product->price, 0) }} </del>
                        </p>
                        <p class="text-center price-product">
                            <b>
                                ${{ number_format($product->sale_price, 0) }}
                            </b>
                            <br>
                        </p>
                        @else
                        <p class="text-center price-product">

                            ${{ number_format($product->price, 0) }}
                            <br>
                        </p>
                        @endif
                    </div>
                </div>
                <div class="description text-justify">{!! $product->description !!}</div>
                <br>
                <div class="w-100">
                    <div class="w-100">
                        @include('generals::layouts.errors-and-messages')
                        <form action="{{ route('cart.store') }}" class="form-inline" method="post">
                            @csrf
                            <div class="row mx-0 w-100">
                                <div class=" col-xl-12">
                                    <div class="input-group mx-auto">
                                        <div class="input-group mb-3 container-quanty mx-auto">
                                            <div class="input-group-prepend">
                                                <button type="button" class="btn btn-sm minus-btn" onclick="res()"
                                                    id="minus-btn"><i class="fa fa-minus"></i></button>
                                            </div>
                                            <input type="text" id="qty_input" name="quantity"
                                                class="form-control form-control-sm text-center" value="1" min="1">
                                            <div class="input-group-prepend">
                                                <button type="button" class="bg-white btn-sm plus-btn" onclick="sum()"
                                                    id="plus-btn"><i class="fa fa-plus"></i></button>
                                            </div>
                                            <input type="hidden" id="qty_input_real" class="" value="1" min="1">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-11 mx-auto col-sm-6 px-1">
                                    <button type="button" onclick="addCart({{$product->id}},'1')"
                                        class="btn button-reset btn-block mx-auto mt-2">
                                        <img src="{{ asset('img/icons/cart.png') }}" alt="Agregar al carrito"
                                            class="height-container-img-product" style=" max-width: 30px; " />
                                        Agregar al carrito
                                    </button>
                                </div>
                                <div class="col-11 mx-auto col-sm-6 px-1">
                                    <button type="button" onclick="addWishlist({{$product->id}},'2')"
                                        class="btn button-reset btn-block mx-auto mt-2 btn-wish">
                                        <img src="{{ asset('img/icons/wishlist.png') }}"
                                            alt="Agregar a la lista de deseos" class="height-container-img-product"
                                            style="max-width: 28px;position: absolute;left: 4px;top: 2px;" />
                                        <span>Agregar a lista</span> <br> de deseos
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@if (!empty($bestSellers))
<div class="container-reset my-4" id="carrousel-reset" style="display: none">
    <div class="text-center content-title-banner-products">
        <h4 class="title-interesing">
            También te puede interesar
        </h4>
    </div>
    <div class="px-4 px-lg-5 pb-4 pt-2">
        <div class="glider-contain">
            <div class="glider">
                @foreach ($bestSellers as $item)
                <div class="p-1 p-sm-3">
                    <div class="card border-0" style=" border-radius: 11px; ">
                        <div class="card-body p-2 d-flex">
                            <a href="{{ route('front.get.product', str_slug($item->slug)) }}"
                                style="text-decoration: none;margin: auto;">
                                <img src="{{ asset('storage/'.$item->cover) }}" alt="{{ $item->slug }}"
                                    class="img-card-product m-auto lazy">
                            </a>

                        </div>
                        <div class="w-100 p-2">
                            <a href="{{ route('front.get.product', str_slug($item->slug)) }}"
                                style="text-decoration: none;">
                                <p class="name-card-slider">
                                    {{$item->name}}
                                </p>
                            </a>
                            <div class="container-price-slider">
                                @if ($item->sale_price > 0)
                                <p class="text-center price-old-card-slider">

                                    <del>${{ number_format($item->price, 0) }} </del>
                                </p>
                                <p class="text-center price-new-card-slider">
                                    <b>
                                        ${{ number_format($item->sale_price, 0) }}
                                    </b>
                                    <br>
                                </p>
                                @else
                                <p class="text-center price-new-card-slider">

                                    ${{ number_format($item->price, 0) }}
                                    <br>
                                </p>
                                @endif
                            </div>
                            <div class="text-center">
                                <button class="btn btn-primary btn-add-card mb-1" onclick="addCart({{$item->id}},'1')"
                                    type="button">AÑADIR AL
                                    CARRITO</button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <button class="glider-prev glider-prev-one"><i class="fas fa-caret-left slider"></i></button>
            <button class="glider-next glider-next-one"><i class="fas fa-caret-right slider"></i></button>
        </div>
    </div>
</div>

@endif
