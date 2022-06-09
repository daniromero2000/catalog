<select name="set_up" id="set_up" class="form-control select2">
    <option value="0" @if($status==0 || old('set_up')==0) selected="selected" @endif>Sin Configurar</option>
    <option value="1" @if($status==1 || old('set_up')==1) selected="selected" @endif>Configurada</option>
</select>
