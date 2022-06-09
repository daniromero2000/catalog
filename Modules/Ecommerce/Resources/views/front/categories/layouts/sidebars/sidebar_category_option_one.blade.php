<div class="category-top col-md-12">
    <h2 class="text-uppercase">{{ $category->name }} </h2>
    <hr>
</div>
<form action="{{route('front.category.slug',$category->slug)}}" class="px-2" method="get">
    @foreach($attributes as $attribute)
    <div class="accordion card mt-1 card-reset" id="accordionExample{{$attribute->id}}">
        <h2 class="mb-0">
            <button class="btn btn-block text-left accordionBtn @if(request()->input('q')) show @else collapsed  @endif"
                type="button" data-toggle="collapse" data-target="#collapseOne{{ $attribute->id}}" aria-expanded="true"
                aria-controls="collapseOne{{ $attribute->id}}">
                {{$attribute->name}}
            </button>
        </h2>
        <div id="collapseOne{{ $attribute->id}}" class="collapse @if(request()->input('q')) ? show : @endif "
            aria-labelledby="headingOne" data-parent="#accordionExample{{$attribute->id}}">
            <ul class="mt-2 scroll-options">
                @if ($attribute->values)
                @foreach ($attribute->values as $item)
                <li>
                    <label class="">
                        <input type="checkbox" value="{{$item->value}}" @if( request()->input('q') &&
                        in_array($item->value, request()->input('q'))) checked="checked" @endif
                        name="q[]">
                        {{$item->value}}
                    </label>
                </li>
                @endforeach
                @endif
            </ul>
        </div>
    </div>
    @endforeach
    <div class="ml-2">
        <button class="btn btn-primary btn-search-t my-4">Buscar</button>
        @if (request()->input('q'))
        <a href="{{route('front.category.slug',$category->slug)}}" class="btn btn-secondary my-4">Restaurar</a>
        @endif
    </div>
</form>