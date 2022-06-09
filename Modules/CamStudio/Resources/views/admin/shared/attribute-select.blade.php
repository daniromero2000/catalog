<div class="form-group">
    <label for="weight">Peso</label>
    <div class="form-inline">
        <input type="text" class="form-control col-sm-8" id="weight" name="weight" placeholder="0"
            value="{{ number_format($product->weight, 2) }}">
        <label for="mass_unit" class="sr-only">Unidades</label>
        <select name="mass_unit" id="mass_unit" class="form-control col-sm-4 select2">
            @foreach($weight_units as $key => $unit)
            <option @if($default_weight==$unit) selected="selected" @endif value="{{ $unit }}">{{ $key }} -
                ({{ $unit }})</option>
            @endforeach
        </select>
    </div>
    <a class="text-center info-tooltip text-bold" data-toggle="tooltip" data-original-title="Opcional"> ! </a>
</div>