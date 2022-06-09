@if($categories->isNotEmpty())
<div class="container-reset">
    <div class="row row-reset">
        @foreach ($categories as $key => $category)
        <div class="col-12 col-md-6 col-lg-4 mt-4">
            <div class="card text-center" style="border-radius: 20px; border: none;">
                <div class="card-body p-0">
                    <a class="cursor" href="{{route('front.category.slug', $category->slug)}}">
                        <img style="border-radius: 10px 10px 0px 0px;" src="{{ asset('/img/tws/categorytest2.png') }}"
                            class="w-100" alt="{{ $category->name }}">
                    </a>
                </div>
                <div class="card-footer card-category">
                    <h5 class="card-text">{{$category->name}}</h5>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @endif

</div>