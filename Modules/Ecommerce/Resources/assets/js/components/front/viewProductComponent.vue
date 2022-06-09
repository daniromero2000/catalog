<template>
  <div class="row mx-0">
    <div class="col-xl-7 col-lg-6 mb-3">
      <div id="app">
        <carousel :productId="product"> </carousel>
      </div>
    </div>
    <div class="col-xl-5 col-lg-5 col-md-8 col-sm-11 d-flex">
      <div class="product-description text-left w-100 p-2 my-auto">
        <div class="w-100">
          <div class="w-100">
            <!-- <h4 class="">{{ $product->name }}</h4>
            <span>Ref:{{ $product->sku }}</span> -->
          </div>
          <!-- <div
            id="priceProduct{{$product->id}} pl-2"
            style="position: relative"
          >
            @if ($product->sale_price > 0)
            <div class="card-products-discount text-center">
              @php $discount = round((($product->price - $product->sale_price) /
              $product->price) * 100); @endphp
              <p>{{ $discount }}%</p>
              <p>Dcto</p>
            </div>
            @endif @if ($product->sale_price > 0)
            <p class="text-left" style="font-size: 24px; margin-bottom: 0px">
              <small>
                <del>${{ number_format($product->price, 0) }} </del>
              </small>
            </p>
            <p class="text-left" style="font-size: 30px; line-height: 24px">
              <small
                ><b> ${{ number_format($product->sale_price, 0) }} </b> </small
              ><br />
            </p>
            @else
            <p class="text-left" style="font-size: 30px; line-height: 24px">
              <small> ${{ number_format($product->price, 0) }} </small>
              <br />
            </p>
            @endif
          </div> -->
        </div>
        <div class="description text-justify">
          <!-- {!! $product->description !!} -->
        </div>
        <br />
        <div class="w-100">
          <div class="w-100">
            <!-- @include('generals::layouts.errors-and-messages') -->
            <!-- <form
              action="{{ route('cart.store') }}"
              class="form-inline"
              method="post"
            > -->
            <div class="w-100 justify-content-between d-flex">
              <label class="mb-2" for="productAttribute"
                ><span class="mr-auto"><b>Elige tu talla</b></span></label
              >

              <a
                data-toggle="modal"
                data-target="#sizeGuide"
                class="text-dark"
                href=""
              >
                <label class="mb-2" for="productAttribute"
                  ><span class="mr-auto"
                    ><b>Ver tabla de tallas</b></span
                  ></label
                ></a
              >
            </div>

            <!-- @if(isset($productAttributes) && !$productAttributes->isEmpty())
              <div class="w-100">
                <div class="form-group mb-2">
                  <div class="container-sizes w-100" id="sizes">
                    <input
                      type="hidden"
                      required
                      name="productAttribute"
                      id="productAttribute"
                    />
                    @foreach($productAttributes as $productAttribute) @if
                    ($productAttribute->quantity > 0)
                    @foreach($productAttribute->attributesValues as $key =>
                    $value) @if ($value->attribute->name == 'Talla')
                    <input type="hidden" id="table" name="table" value="1" />
                    <div
                      class="sizes"
                      id="sizes{{$productAttribute->id}}"
                      onclick="addValue({{$productAttribute->id}})"
                    >
                      <span
                        class="m-auto"
                        onclick="addValue({{$productAttribute->id}})"
                      >
                        <p class="m-auto">{{ ucwords($value->value) }}</p>
                      </span>
                    </div>
                    @endif @endforeach @endif @endforeach
                  </div>
                </div>
              </div>
              <hr />
              @endif -->
            <div class="row mx-0 w-100">
              <div class="col-xl-12">
                <div class="input-group mx-auto">
                  <div class="input-group mb-3 container-quanty mx-auto">
                    <div class="input-group-prepend">
                      <button
                        type="button"
                        class="btn btn-sm minus-btn"
                        onclick="res()"
                        id="minus-btn"
                      >
                        <i class="fa fa-minus"></i>
                      </button>
                    </div>
                    <input
                      type="text"
                      id="qty_input"
                      name="quantity"
                      class="form-control form-control-sm text-left"
                      value="1"
                      min="1"
                    />
                    <div class="input-group-prepend">
                      <button
                        type="button"
                        class="bg-white btn-sm plus-btn"
                        onclick="sum()"
                        id="plus-btn"
                      >
                        <i class="fa fa-plus"></i>
                      </button>
                    </div>
                    <input
                      type="hidden"
                      id="qty_input_real"
                      class=""
                      value="1"
                      min="1"
                    />
                  </div>
                </div>
              </div>
              <!-- <div class="col-11 mx-auto col-sm-6 px-1">
                  <button
                    type="button"
                    onclick="addCart({{$product->id}},'1')"
                    class="btn button-reset btn-block mx-auto mt-2"
                    style="font-size: 12px !important"
                  >
                    <i class="fas fa-shopping-cart"></i>
                    Agregar al carrito
                  </button>
                </div>
                <div class="col-11 mx-auto col-sm-6 px-1">
                  <button
                    type="button"
                    onclick="addWishlist({{$product->id}},'2')"
                    class="btn button-reset btn-block mx-auto mt-2"
                    style="font-size: 12px !important"
                  >
                    <i class="fas fa-heart"></i>
                    <span>Agregar a lista de deseos</span>
                  </button>
                </div> -->
              <!-- @include('ecommerce::front.products.layouts.reviews.reviews_option_one') -->
            </div>
            <!-- </form> -->
          </div>
        </div>
      </div>
    </div>
    <!-- @include('ecommerce::front.products.layouts.modals.modal_size_guide_option_one') -->
  </div>
</template>

<script>
import carousel from "./carousel.vue";
// import customerIds from "./show/ids.vue";

export default {
  props: ["product"],
  components: {
    carousel,
    // customerIds,
  },
  created() {
  },
  methods: {},
};
</script>
