<select name="is_signed" id="is_signed" class="form-control select2">
    <option value="0" @if($status==0 || old('is_signed')==0) selected="selected" @endif>Sin Firmar</option>
    <option value="1" @if($status==1 || old('is_signed')==1) selected="selected" @endif>Firmado</option>
</select>
