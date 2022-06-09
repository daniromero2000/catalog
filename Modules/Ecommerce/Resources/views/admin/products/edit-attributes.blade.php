{{-- <div class="form-group text-left">
    <div class="row">
        @foreach($attributes as $attribute)
        <div class="col-sm-6">
            <div class="custom-control custom-checkbox mb-3">
                <input class="custom-control-input pAattribute" name="pAattribute[]"
                    id="pAattribute{{$pa->id}}{{ $attribute->id }}" type="checkbox"
onclick="inputActive({{$pa->id}}{{ $attribute->id }})" value="{{ $attribute->id }}">
<label class="custom-control-label" for="pAattribute{{$pa->id}}{{ $attribute->id }}">{{ $attribute->name }}</label>
</div>
{{$pa->attributes_value}}
<label for="pAattributeValue{{$pa->id}}{{ $attribute->id }}" style="display: none; visibility: hidden"></label>
@if(!$attribute->values->isEmpty())
<select name="pAattributeValue[]" id="pAattributeValue{{$pa->id}}{{
            $attribute->id }}" class="form-control select2" style="width: 100%" disabled>
    @foreach($attribute->values as $attr)
    <option {{ $pa->attributes_values }} value="{{ $attr->id }}">{{ $attr->value }}</option>
    @endforeach
</select>
@endif
</div>
@endforeach
</div>
</div> --}}
