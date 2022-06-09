@foreach($categories as $category)
<li aria-haspopup="true"><span class="wsmenu-click">@if (!empty($category->children->where('is_active',1)->toArray()))<i
                        class="wsmenu-arrow"></i>@endif<i class="wsmenu-arrow "></i></span>
        <a href="{{route('front.category.slug', $category->slug)}}" class="navtext"><span
                        class="text-center">{{$category->name}} <br>
                        <small>{{$category->description}}</small></span></a>
        @if (!empty($category->children->where('is_active',1)->toArray()))
        <ul class="sub-menu">
                @foreach ($category->children->where('is_active',1) as $children)
                <li aria-haspopup="true" class="d-flex">
                        <a href="{{route('front.category.slug', $children->slug)}}"> <i class="fas fa-angle-right"></i>
                                {{$children->name}}</a>
                </li>
                @foreach ($children->children as $newChildren)
                <li aria-haspopup="true"> <i class="fas fa-angle-right"></i><a
                                href="{{route('front.category.slug', $newChildren->slug)}}">{{$newChildren->name}} </a>
                </li>
                @endforeach
                @endforeach
        </ul>
        @endif
</li>
@endforeach