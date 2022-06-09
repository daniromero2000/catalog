<div class="row mx-0 text-center">
    @foreach($products as $product)
    <div class="col-xl-4 col-lg-6 col-md-4 col-sm-6 mb-4 col-products">
        <div class="single-product">

            @include('ecommerce::front.products.layouts.product_list_option_one')
            @include('ecommerce::front.products.layouts.modals.modal-product_option_one')
        </div>
    </div>
    @endforeach
</div>