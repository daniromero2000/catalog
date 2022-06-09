<div class="row px-4">
    @foreach($categories as $category)
    <div class="px-2">
        <div class="custom-control custom-checkbox mb-3">
            <input class="custom-control-input " name="categories[]" id="{{ $category->id }}" type="checkbox"
                value="{{ $category->id }}" @if(isset($selectedIds) && in_array($category->id,
            $selectedIds))checked="checked" @endif>
            <label class="custom-control-label" for="{{ $category->id }}">{{ $category->name }}</label>
        </div>
    </div>
    @if($category->children->count() >= 1)
    @include('ecommerce::admin.shared.categories', ['categories' => $category->children->where('is_active',1),
    'selectedIds' => $selectedIds])
    @endif
    @endforeach
</div>
