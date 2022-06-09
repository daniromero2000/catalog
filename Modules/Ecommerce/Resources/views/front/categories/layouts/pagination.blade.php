<nav class="mt-4" aria-label="...">
    <ul class="pagination d-flex justify-content-center">
        <li class="page-item @if(request()->input('skip') < 1) disabled @endif">
            <a class="page-link"
                href="{{ route("front.category.slug", [ $category->slug, 'skip' => (request()->input('skip') - 1), 'q' => request()->input('q') ] ) }}"
                tabindex="-1" aria-disabled="true"><i class="fas fa-angle-left"></i></a>
        </li>
        @for ($i = 0; $i < $paginate; $i++) <li class="page-item @if(request()->input('skip') == $i) active @endif"><a
                class="page-link "
                href="{{ route("front.category.slug", [ $category->slug, 'skip' => ($skip = $i), 'q' => request()->input('q') ] ) }}">{{$i + 1}}</a>
            </li>
            @endfor
            @if ($paginate > 1)
            <li class="page-item" @if((request()->input('skip') + 1) == $paginate) hidden @endif>
                <a class="page-link"
                    href="{{ route("front.category.slug", [ $category->slug, 'skip' => (request()->input('skip') + 1), 'q' => request()->input('q') ] ) }}"><i
                        class="fas fa-angle-right"></i></a>
            </li>
            @endif
    </ul>
    {{-- @include('ecommerce::front.products.layouts.product_list_option_one') --}}
</nav>