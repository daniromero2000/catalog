<div class="product">
    @if(isset($product->cover))
    <div class="card border-0 text-center card-products">
        <div class="card text-center card-products" style="border-color: #eeeeee !important;">
            <div class="height-container-img-product relative container-img-product">
                @if ($product->sale_price > 0)
                @php
                $discount = round((($product->price - $product->sale_price) / $product->price) * 100);
                @endphp
                <div class="ribbon-wrapper ribbon-lg mt-2">
                    <div class="ribbon bg-danger p-0">
                        <p class="ribbon-text"> - {{$discount}}%</p>
                    </div>
                </div>
                @endif
                <a class="cursor" href="{{ route('front.get.product', str_slug($product->slug))}}">
                    <img src="{{ asset("storage/$product->cover") }}"
                        class="card-products-img lazy" alt="{{ $product->slug }}">
                </a>
                <div style="min-height:50px !important">
                    <div class="w-100">
                        <h3 class="title-products"> {{$product->name}} </h3>
                    </div>
                </div>
                <div class="mb-4">
                    @if ($product->sale_price > 0)
                    <p class="price-old">
                        <del>${{ number_format($product->price, 0) }} </del>
                    </p>
                    <p class="price-new">
                        <small><b>
                                ${{ number_format($product->sale_price, 0) }}
                            </b>
                        </small><br>
                    </p>
                    @else
                    <p class="price-new mt-2">
                        <small> <b>
                                ${{ number_format($product->price, 0) }}
                            </b></small>
                        <br>
                    </p>
                    @endif
                </div>
                {{-- <div class="my-3 pb-2 d-flex">
                    <a class="btn-cart-category mx-auto" href="">Agregar a la cesta</a>
                </div>--}}

                <div class="row justify-content-center pb-2">
                    <a class="text-dark" data-toggle="modal" data-target="#productModal{{ $product->id }}">
                        <div class="icons-options">
                            <i class="fas fa-eye"></i>
                        </div>
                    </a>
                    <a class="text-dark" onclick="addWishlist({{$product->id}})">
                        <div class="icons-options">
                            <i class="fas fa-heart"></i>
                        </div>
                    </a>
                    <a class="text-dark" href="{{ route('front.get.product', str_slug($product->slug)) }}">
                        <div class="icons-options">
                            <i class="fas fa-external-link-square-alt"></i>
                        </div>
                    </a>
                </div>
            </div>
        </div>

    </div>
    @else
    <img src="{{ asset('img/blank.jpg') }}" alt="{{ $product->name }}"
        class="height-container-img-product lazy" />
    @endif
</div>
