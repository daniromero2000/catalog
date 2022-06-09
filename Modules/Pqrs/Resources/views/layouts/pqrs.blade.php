<form class="form-horizontal" role="form" method="POST" action="{{ route('pqrs.store') }}">
   @csrf
    <div class="form-group{{ $errors->has('cedula') ? ' has-error' : '' }}">
        <input id="cedula" type="text" class="form-control form-controlPqrs" name="cedula"
            placeholder="Número de Cédula" value="{{ old('cedula') }}" autofocus required>
        @if($errors->has('cedula')) <span class="help-block">
            <strong>{{ $errors->first('cedula') }}</strong> </span> @endif</div>

    <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
        <input id="name" type="text" class="form-control form-controlPqrs" name="name" placeholder="Nombres y Apellidos"
            value="{{ old('name') }}" autofocus required>
        @if($errors->has('name')) <span class="help-block">
            <strong>{{ $errors->first('name') }}</strong> </span> @endif</div>

    <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}"> <input id="email" type="email"
            class="form-control form-controlPqrs" name="email" placeholder="Correo Electrónico"
            value="{{ old('email') }}" required>
        @if($errors->has('email')) <span class="help-block">
            <strong>{{ $errors->first('email') }}</strong> </span> @endif</div>

    <div class="form-group{{ $errors->has('phone') ? ' has-error' : '' }}"> <input id="phone" type="phone"
            class="form-control form-controlPqrs" name="phone" placeholder="Teléfono" value="{{ old('phone') }}"
            required>
        @if($errors->has('phone')) <span class="help-block">
            <strong>{{ $errors->first('phone') }}</strong> </span> @endif</div>
    <div class="form-group">
        <label for="pqr" class="control-label">Tipo de PQR</label>
        <div class="input-group">
            <div class="input-group-addon">
                <i class="fa fa-check"></i>
            </div>
            <select class="selectpicker form-control form-controlPqrs " id="pqr" name="pqr">
                <option>Petición</option>
                <option>Queja</option>
                <option>Reclamo</option>
                <option>Solicitud</option>
            </select>
        </div>
    </div>
    <div id="cities" class="form-group">
        <label for="city_id">Ciudad <span class="text-danger">*</span></label>
        <div class="input-group">
            <div class="input-group-addon">
                <i class="fa fa-map-marker" aria-hidden="true"></i>
            </div>
            <select name="city_id" id="city_id" class="form-control form-controlPqrs" enabled>
                @foreach($cities as $city)
                <option value="{{ $city->id }}">{{ $city->name }}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group{{ $errors->has('asunto') ? ' has-error' : '' }}"> <input id="asunto" type="asunto"
            class="form-control form-controlPqrs" name="asunto" placeholder="Asunto" value="{{ old('asunto') }}"
            required>
        @if($errors->has('asunto')) <span class="help-block">
            <strong>{{ $errors->first('asunto') }}</strong> </span> @endif</div>
    <div class="form-group{{ $errors->has('mensaje') ? ' has-error' : '' }}"> <textarea id="mensaje" type="mensaje"
            class="form-control" name="mensaje" placeholder="Mensaje" value="{{ old('mensaje') }}" required></textarea>
        @if($errors->has('mensaje')) <span class="help-block">
            <strong>{{ $errors->first('mensaje') }}</strong> </span> @endif</div>
    <div class="form-group hidden"> <input id="pqr_status_id" type="text" class="form-control" name="pqr_status_id"
            value="3"></div>

    <input class="hidden" id="lead" type="text" class="form-control" name="lead" value="Registro">

    {{-- <input type="hidden" name="status" value="1"> <label class="register-box-msg"><small>Prueba que
            no
            eres un robot</small></label> {!! NoCaptcha::display() !!} --}}

    <div class="checkbox termsConditionscheck"> <label><input type="checkbox" value="1" name="data_politics"
                id="data_politics" required> Acepto</label> <a href="" target="_blank">Politica de tratamiento de datos
            personales</a></div>
    <div class="form-group">
        <div class="d-flex justify-content-center d-flex align-items-end"> <button type="submit" class="btn btnlogin"><i
                    class="fa fa-check yellow" aria-hidden="true"></i> Envíar</button></div>
    </div>
</form>