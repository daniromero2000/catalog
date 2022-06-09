<select name="is_active" id="is_active" class="form-control select2">
    <option value="0" @if($status==0 || old('is_active')==0) selected="selected" @endif>No Activo</option>
    <option value="1" @if($status==1 || old('is_active')==1) selected="selected" @endif>Activo</option>
</select>
