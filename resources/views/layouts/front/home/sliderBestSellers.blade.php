@if ($bestSellers->isNotEmpty())
<div class="container-reset" id="sliderHome">
    <div class="text-center content-title-banner-products">
        <h4>
            los <img src="{{ asset('img/FVN/plus.jpg') }}" alt="los mas vendidos"> vendidos
        </h4>
    </div>
    <div class="p-4">
        <div class="glider-contain">
            <div class="glider">
                @foreach ($bestSellers as $item)
                <a href="{{ route('front.get.product', str_slug($item->slug)) }}">
                    <div class="card-body p-2 d-flex">
                        <img src="{{ asset('storage/'.$item->cover) }}" alt="{{ $item->name }}"
                            class="img-card-product m-auto lazy">
                    </div>
                </a>
                @endforeach
            </div>
            <button class="glider-prev glider-prev-one"><i class="fas fa-caret-left slider"></i></button>
            <button class="glider-next glider-next-one"><i class="fas fa-caret-right slider"></i></button>
        </div>
    </div>
</div>
@endif
