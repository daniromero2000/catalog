<label class="form-control-label" for="status">Estado</label>
<div class="input-group input-group-merge">
    <div class="input-group-prepend">
        <span class="input-group-text"> <i class="fa fa-check"></i></span>
    </div>
    <select name="status" id="status" class="form-control select2">
        <option value="0" @if($status==0 || old('status')==0) selected="selected" @endif>Deshabilitado</option>
        <option value="1" @if($status==1 || old('status')==1) selected="selected" @endif>Habilitado</option>
    </select>
</div>