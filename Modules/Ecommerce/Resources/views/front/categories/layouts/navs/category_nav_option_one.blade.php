@foreach($categories as $category)
<li class="nav-item">
    <a @if(request()->segment(2) == $category->slug) class="active nav-link" @endif class="nav-link"
        href="{{route('front.category.slug', $category->slug)}}">{{$category->name}}</a>
</li>
@endforeach