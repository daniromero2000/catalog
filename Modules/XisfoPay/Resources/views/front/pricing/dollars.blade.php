<div class="row m-0 p-0 py-3 justify-content-center align-items-center bg-secondary">
    <div class="col-lg-4 order-lg-1 order-2">
        @include('xisfopay::front.pricing.pt_calculator')
    </div>
    <div class="col-lg-4 p-lg-0 m-lg-0 mt-sm-0 order-lg-2 order-1">
        @include('xisfopay::front.pricing.xisfopay_calculator')
    </div>
    <div class="col-lg-4 order-lg-3 order-3">
        @include('xisfopay::front.pricing.bt_calculator')
    </div>
</div>