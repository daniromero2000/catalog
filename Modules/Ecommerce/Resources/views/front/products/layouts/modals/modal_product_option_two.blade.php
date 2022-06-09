<div class="modal fade" id="productModal{{ $product->id }}" data-backdrop="static" data-keyboard="false" tabindex="-1"
    role="dialog" aria-labelledby="productModal{{ $product->id }}Label" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-content">
                <div class="row mx-0 justify-content-end">
                    <button type="button" class="close mr-2 mt-1" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="row mx-0 py-3">
                    <div class="col-lg-6">
                        <div class="p-2">
                            @if(isset($product->cover))
                            <img id="main-image" class="img-fluid lazy" src="{{ asset("storage/$product->cover") }}?w=400"
                                data-zoom="{{ asset("storage/$product->cover") }}?w=1200">
                            @else
                            <img id="main-image" class="img-fluid lazy" src="{{ asset('img/blank.jpg') }}"
                                data-zoom="{{ asset("storage/$product->cover") }}?w=1200" alt="{{ $product->name }}">
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="product-description text-left w-100 p-2 my-auto">
                            <div class="w-100">
                                <div class="w-100">
                                    <h3 class="">{{ $product->name }}
                                    </h3>
                                    <span>Ref: {{ $product->sku }}</span>
                                </div>
                                <div id="priceProduct{{$product->id}} pl-2" style=" position: relative; ">
                                    @if ($product->sale_price > 0)
                                    <div class="card-products-discount bg-primary-reset text-center">
                                        @php
                                        $discount = round((($product->price - $product->sale_price) / $product->price) *
                                        100);
                                        @endphp
                                        <p>{{$discount}}%</p>
                                        <p>Dcto</p>
                                    </div>
                                    @endif
                                    @if ($product->sale_price > 0)
                                    <p class="text-left" style=" font-size: 24px;margin-bottom: 0px;">
                                        <del>${{ number_format($product->price, 0) }} </del>
                                    </p>
                                    <p class="text-left color-warning-reset"
                                        style=" font-size: 36px;line-height: 40px; ">
                                        <b>
                                            ${{ number_format($product->sale_price, 0) }}
                                        </b>
                                        <br>
                                    </p>
                                    @else
                                    <p class="text-left color-warning-reset"
                                        style=" font-size: 36px;line-height: 40px;">

                                        ${{ number_format($product->price, 0) }}
                                        <br>
                                    </p>
                                    @endif
                                </div>
                            </div>
                            <div class="description text-justify mt-3">{!! $product->description !!}</div>
                            <br>
                            <div class="w-100">
                                <div class="col-11 mx-auto text-center px-1">
                                    <a href="{{ route('front.get.product', str_slug($product->slug)) }}"
                                        class="btn bg-warning-reset mx-auto mt-2">
                                        Agregar al carrito
                                        <i class=" fas fa-shopping-cart"></i>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
