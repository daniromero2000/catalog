<div class="product">
    <div class="card border-0 text-center card-products">
        <a class="cursor" href="{{ route('front.get.product', str_slug($product->slug))}}">
            <img src="{{ asset("storage/$product->cover") }}"
                class="card-products-img lazy" alt="{{ $product->slug }}">
        </a>
        <div class="w-100">
            <h3 class="title-products"> {{$product->name}} </h3>
        </div>
        @if ($product->sale_price > 0)
        <p class="price-old">
            <small>
                <del>${{ number_format($product->price, 0) }} </del> </small>
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
        <div class="row justify-content-center">
            <a class="" data-toggle="modal" data-target="#productModal{{ $product->id }}">
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
