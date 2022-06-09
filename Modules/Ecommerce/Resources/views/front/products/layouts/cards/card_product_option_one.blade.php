<div class="{{ $background }}" id="products" style="display: none">
    <div class="text-center content-title-banner-products">
        <h3 class="title-interesing">
            {{$title}}
        </h3>
    </div>
    <div class="px-4 px-lg-5 container-reset">
        <div class="glider-contain">
            <div class="glider">
                @foreach ($bestSellers as $item)
                <div class="p-1 p-sm-4">
                    <div class="card border-0 text-center card-products">
                        <div class="height-container-img-product relative container-img-product">
                            @if ($item->sale_price > 0)
                            @php
                            $discount = round((($item->price - $item->sale_price) / $item->price) * 100);
                            @endphp
                            <div class="ribbon-wrapper ribbon-lg">
                                <div class="ribbon bg-danger p-0">
                                    <p class="ribbon-text"> - {{$discount}}%</p>
                                </div>
                            </div>
                            @endif
                            <a class="cursor" href="{{ route('front.get.product', str_slug($item->slug))}}">
                                <img src="{{ asset("storage/$item->cover")  }}" class="card-products-img lazy"
                                    alt="{{ $item->slug }}">
                            </a>
                            <div style="min-height:50px !important">
                                <div class="w-100 text-uppercase">
                                    <h3 class="title-products"> {{$item->name}} </h3>
                                </div>
                            </div>
                            <div class="">
                                @if ($item->sale_price > 0)
                                <p class="price-old">
                                    <small>
                                        <del>${{ number_format($item->price, 0) }} </del> </small>
                                </p>
                                <p class="price-new">
                                    <small><b>
                                            ${{ number_format($item->sale_price, 0) }}
                                        </b>
                                    </small><br>
                                </p>
                                @else
                                <p class="price-new mt-2">
                                    <small> <b>
                                            ${{ number_format($item->price, 0) }}
                                        </b></small>
                                    <br>
                                </p>
                                @endif
                                <div>
                                    <a class="btn-cart-category" href="{{ route('front.get.product', str_slug($item->slug))}}">VIEW PRODUCT</a>
                                </div>
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