<select name="is_aprobed" id="is_aprobed" class="form-control select2">
    <option value="0" @if($status==0 || old('is_aprobed')==0) selected="selected" @endif>Sin Aprobar</option>
    <option value="1" @if($status==1 || old('is_aprobed')==1) selected="selected" @endif>Aprobado</option>
</select>
