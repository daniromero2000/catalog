<div class="row px-4">
    @foreach($categories as $category)
    <div class="col">
        <div class="custom-control custom-checkbox mb-3">
            <input class="custom-control-input " name="categories[]" id="{{ $category->id }}" type="checkbox"
                value="{{ $category->id }}" @if(isset($selectedIds) && in_array($category->id,
            $selectedIds))checked="checked" @endif>
            <label class="custom-control-label" for="{{ $category->id }}">{{ $category->name }}</label>
        </div>
    </div>
    @if($category->children->count() >= 1)
    @include('camstudio::admin.shared.categories', ['categories' => $category->children, 'selectedIds' => $selectedIds])
    @endif
    @endforeach
</div>
