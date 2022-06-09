@foreach($categories as $category)
<li aria-haspopup="true"><span class="wsmenu-click">@if (!empty($category->children->toArray()))<i
            class="wsmenu-arrow"></i>@endif
    </span><a style="border: none;" href="{{route('front.category.slug', $category->slug)}}"
        class="navtext"><span>{{$category->name}}</span></a>
    @if (!empty($category->children->toArray()))
    <div class="wsmegamenu clearfix">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-md-12">
                    <ul class="wstliststy02 clearfix">
                        @foreach ($category->children as $children)
                        <li class="wstheading clearfix"> <a
                                href="{{route('front.category.slug', $children->slug)}}">{{$children->name}}</a> </li>
                        @foreach ($children->children as $newChildren)
                        <li><a href="{{route('front.category.slug', $newChildren->slug)}}">{{$newChildren->name}} </a>
                        </li>
                        @endforeach
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @endif
</li>
@endforeach