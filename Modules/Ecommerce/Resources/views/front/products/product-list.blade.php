@if(!empty($products) && !collect($products)->isEmpty())

<div class="row mx-0 text-center">
    @foreach($products as $product)
    <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6 mb-4 col-products">
        <div class="single-product">
            <div class="product">
                @if(isset($product->cover))
                <div class="card border-0 text-center card-products">
                    <div class="height-container-img-product relative container-img-product shadow-reset">
                        {{-- @if ($product->sale_price > 0)
                        @php
                        $discount = round((($product->price - $product->sale_price) / $product->price) * 100);
                        @endphp
                        <div class="ribbon-wrapper ribbon-lg">
                            <div class="ribbon bg-danger p-0">
                                <p class="ribbon-text"> - {{$discount}}%</p>
                            </div>
                        </div>
                        @endif --}}
                        <a class="cursor" href="{{ route('front.get.product', str_slug($product->slug))}}">
                            <img  src="{{ asset("storage/$product->cover") }}"
                                class="card-products-img lazy" alt="{{ $product->slug }}">
                        </a>
                        <div class="w-100">
                            <h3 style="text-transform: uppercase; padding: 0px 10%;" class="title-products"> {{$product->name}} </h3>
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
                        <div class="my-2">
                            <a class="btn-cart-category" href="">AÑADIR AL CARRITO</a>
                        </div>
                        <div class="row justify-content-center">
                            <a class=" data-toggle="modal" data-target="#productModal{{ $product->id }}">
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
                    {{-- <div class="w-100 pt-2 px-2 text-center">
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
                        <p class="price-new mt-3">
                            <small> <b>
                                    ${{ number_format($product->price, 0) }}
                                </b></small>
                            <br>
                        </p>
                        @endif
                    </div> --}}
                    {{-- <div class="row justify-content-center">
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
                    </div> --}}
                </div>
                @else
                <img src="{{ asset('img/blank.jpg') }}"
                    alt="{{ $product->name }}" class="height-container-img-product lazy" />
                @endif
            </div>
            <div class="modal fade" id="productModal{{ $product->id }}" data-backdrop="static" data-keyboard="false"
                tabindex="-1" role="dialog" aria-labelledby="productModal{{ $product->id }}Label" aria-hidden="true">
                <div class="modal-dialog modal-lg">
                    <div class="modal-content">
                        <div class="modal-content">
                            <div class="row mx-0 justify-content-end">
                                <button type="button" class="close mr-2 mt-1" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            @include('ecommerce::layouts.front.modal-product')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    @if($products instanceof \Illuminate\Contracts\Pagination\LengthAwarePaginator)
    <div class="row">
        <div class="col-md-12">
            <div class="pull-left">{{ $products->links() }}</div>
        </div>
    </div>
    @endif
</div>
@else
<p class="alert alert-warning">No hay productos aún</p>
@endif
