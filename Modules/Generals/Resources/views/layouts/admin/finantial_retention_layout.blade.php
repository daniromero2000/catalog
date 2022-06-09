<select name="finantial_retention" id="finantial_retention" class="form-control select2">
    <option value="0" @if($status==0 || old('finantial_retention')==0) selected="selected" @endif>Sin Retención</option>
    <option value="1" @if($status==1 || old('finantial_retention')==1) selected="selected" @endif>Con Retención</option>
</select>
