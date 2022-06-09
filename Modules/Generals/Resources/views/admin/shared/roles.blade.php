<div class="row row-reset">
    @foreach($roles as $role)
    <div class="col-4">
        <div class="custom-control custom-checkbox mb-3">
            <input class="custom-control-input" id="role{{$role->id}}" type="radio" @if(isset($selectedIds) && $role->id
            == $selectedIds)checked="checked" @endif @if($data->id == auth()->guard('employee')->user()->id )
            disabled @endif name="roles[]"
            value="{{ $role->id }}">
            <label class="custom-control-label" for="role{{$role->id}}">{{ $role->display_name }}</label>
        </div>
    </div>
    @endforeach
</div>
