@if($categories->isNotEmpty())
<div class="container-reset">
    @foreach ($categories as $key => $category)
    @if ($category->homeProducts->isNotEmpty())
    <div class="row mx-0 my-4">
        <div class="col-12 text-center my-4">
            <div class="content-title-banner-products">
                <h2 style=" font-size: 50px; padding: 5px; ">{{$category->name}}</h2>
            </div>
        </div>
        <div class="col-sm-9 mx-auto col-12 {{($key+1) %2==0 ? 'order-md-last' : '' }} col-lg-5 col-md-4 p-3 py-lg-4">
            <a class="cursor" href="{{route('front.category.slug', $category->slug)}}">
                <a href="{{route('front.category.slug', $category->slug)}}" class="btn btn-danger btn-danger-reset">Ver
                    mas</a>
                <img src="{{ asset('storage/'.$category->cover) }}"
                    class="d-block w-100 img-fluid img-children lazy" alt="{{ $category->name }}">
            </a>
        </div>
        <div class="col-12 col-md-8 col-lg-7 px-1 px-sm-2 px-lg-0 d-flex">
            <div class="row mx-0 pt-3 w-100">
                @foreach($category->homeProducts->take(4) as $product)
                <div class="col-products col-sm-6 pr-2 px-sm-2">
                    <div class="card-body px-0 text-center py-2">
                        <div class="container-img-product img-baner-product-girl relative shadow-reset">
                            @if ($product->sale_price > 0)
                            @php
                            $discount = round((($product->price - $product->sale_price) / $product->price) * 100);
                            @endphp
                            <div class="ribbon-wrapper ribbon-lg">
                                <div class="ribbon bg-danger ">
                                    <p class="ribbon-text">
                                        - {{$discount}}%</p>
                                </div>
                            </div>
                            @endif
                            <a class="cursor" href="{{ route('front.get.product', str_slug($product->slug))}}">
                                <img src="{{ asset('storage/'.$product->cover) }}" alt="{{ $product->name }}"
                                    class="img-baner-product-girl lazy">
                            </a>
                        </div>
                    </div>
                    <div class="w-100 py-2 px-sm-4 text-center">
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
                        <p class="mt-3 price-new">
                            <small><b>
                                    ${{ number_format($product->price, 0) }}
                                </b>
                            </small><br>
                        </p>
                        @endif
                    </div>
                </div>

                @endforeach
            </div>
        </div>
    </div>
    @endif
    @endforeach
</div>
@endif
