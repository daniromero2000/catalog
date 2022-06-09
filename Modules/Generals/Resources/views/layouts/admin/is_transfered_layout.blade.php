<select name="is_transfered" id="is_transfered" class="form-control select2">
    <option value="0" @if($status==0 || old('is_transfered')==0) selected="selected" @endif>Sin Transferir</option>
    <option value="1" @if($status==1 || old('is_transfered')==1) selected="selected" @endif>Transferido</option>
</select>
