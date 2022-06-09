<label class="form-control-label" for="is_active">Estado </label>
<div class="input-group input-group-merge">
    <div class="input-group-prepend">
        <span class="input-group-text"> <i
                class="fa fa-check"></i></span>
    </div>
    <select name="is_active" id="is_active" class="form-control select2">
        <option value="0" @if($status==0 || old('is_active')==0) selected="selected" @endif>Deshabilitado</option>
        <option value="1" @if($status==1 || old('is_active')==1) selected="selected" @endif>Habilitado</option>
    </select>
</div>