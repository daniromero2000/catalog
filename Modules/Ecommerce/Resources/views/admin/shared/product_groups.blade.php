<div class="row px-4">
    @foreach($product_groups as $product_group)
    <div class="col">
        <div class="custom-control custom-checkbox mb-3">
            <input class="custom-control-input " name="product_groups[]" id="{{ $product_group->name }}" type="checkbox"
                value="{{ $product_group->id }}" @if(isset($selectedGroupIds) && in_array($product_group->id,
            $selectedGroupIds))checked="checked" @endif>
            <label class="custom-control-label" for="{{ $product_group->name }}">{{ $product_group->name }}</label>
        </div>
    </div>
    @endforeach
</div>