<select name="is_active" id="is_active" class="form-control select2">
    <option value="0" @if($status==0 || old('payment_type')==0) selected="selected" @endif>Adelanto</option>
    <option value="1" @if($status==1 || old('payment_type')==1) selected="selected" @endif>Pago Total</option>
</select>
