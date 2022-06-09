<div class="modal fade" id="modal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Actualizar Empleado: <b>{{$data->name}}</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.employees.update', $data->id) }}" method="post" class="form"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body py-0">
                    <input name="employee_id" id="employee_id" type="hidden" value="{{ $data->id }}">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="name">Nombre</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-font"></i></span>
                                    </div>
                                    <input type="text" name="name" id="name" validation-pattern="name"
                                        placeholder="Nombre" class="form-control"
                                        value="{!! $data->name ?: old('name')  !!}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="last_name">Apellido</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-font"></i></span>
                                    </div>
                                    <input type="text" name="last_name" id="last_name" validation-pattern="name"
                                        placeholder="Apellido" class="form-control"
                                        value="{!! $data->last_name ?: old('last_name')  !!}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="email">Email</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                                    </div>
                                    <input type="text" name="email" id="email" validation-pattern="email"
                                        placeholder="Email" class="form-control"
                                        value="{{ $data->email ?: old('email')  }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div id="cities" class="form-group">
                                <label class="form-control-label" for="employee_position_id">Cargo</label>
                                <div class="input-group">
                                    <select name="employee_position_id" id="employee_position_id" class="form-control">
                                        @foreach($employee_positions as $data_position)
                                        @if($data_position->id == $data->employee_position_id)
                                        <option selected="selected" value="{{ $data_position->id }}">
                                            {{ $data_position->position }}</option>
                                        @else
                                        <option value="{{ $data_position->id }}">{{ $data_position->position }}
                                        </option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div id="cities" class="form-group">
                                <label class="form-control-label" for="department_id">Departamento</label>
                                <div class="input-group">
                                    <select name="department_id" id="department_id" class="form-control">
                                        @foreach($all_departments as $department)
                                        @if($department->id == $data->department_id)
                                        <option selected="selected" value="{{ $department->id }}">
                                            {{ $department->name }}
                                        </option>
                                        @else
                                        <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="email">Tipo Sangre</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-tint"></i></span>
                                    </div>
                                    <input type="text" name="rh" id="rh" placeholder="RH" class="form-control"
                                        value="{!! $data->rh ?: old('rh')  !!}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="email">Cuenta Bancaria</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-hashtag"></i></span>
                                    </div>
                                    <input type="text" name="bank_account" id="bank_account" placeholder="XXXX"
                                        class="form-control" value="{!! $data->bank_account ?: old('bank_account')  !!}"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="admission_date">Ingreso</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-calendar-week"></i></span>
                                    </div>
                                    <input type="date" name="admission_date" id="admission_date"
                                        placeholder="Fecha Ingreso" class="form-control"
                                        value="{!! $data->admission_date ?: old('admission_date')  !!}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="birthday">Fecha Nacimiento</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-calendar-week"></i></span>
                                    </div>
                                    <input type="date" name="birthday" id="birthday" placeholder="Fecha Nacimiento"
                                        class="form-control" value="{!! $data->birthday ?: old('birthday')  !!}"
                                        required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div id="is_rotative" class="form-group">
                                <label class="form-control-label" for="is_rotative">Rota?</label>
                                <div class="input-group">
                                    <select name="is_rotative" id="is_rotative" class="form-control">
                                        @if( 1 == $data->is_rotative)
                                        <option selected="selected" value="1">Sí </option>
                                        <option value="0">No</option>
                                        @elseif( 0 == $data->is_rotative)
                                        <option selected="selected" value="0">No</option>
                                        <option value="1">Sí</option>
                                        @else
                                        <option value="0">No</option>
                                        <option value="1">Sí</option>
                                        @endif
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div id="cities" class="form-group">
                                <label class="form-control-label" for="department_id">Sede</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-building"></i></span>
                                    </div>
                                    <select name="subsidiary_id" id="subsidiary_id" class="form-control">
                                        @foreach($subsidiaries as $subsidiary)
                                        @if($subsidiary->id == $data->subsidiary_id)
                                        <option selected="selected" value="{{ $subsidiary->id }}">
                                            {{ $subsidiary->name }}
                                        </option>
                                        @else
                                        <option value="{{ $subsidiary->id }}">{{ $subsidiary->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div id="cities" class="form-group">
                                <label class="form-control-label" for="shift_id">Turno</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-clock"></i></span>
                                    </div>
                                    <select name="shift_id" id="shift_id" class="form-control">
                                        <option value selected disabled>--select an option--</option>
                                        @foreach($shifts as $shift)
                                        @if($shift->id == $data->shift_id)
                                        <option selected="selected" value="{{ $shift->id }}">
                                            {{ $shift->name }}
                                        </option>
                                        @else
                                        <option value="{{ $shift->id }}">{{ $shift->name }}</option>
                                        @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="account_number">Firma</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-file-signature"></i></span>
                                    </div>
                                    <input type="file" name="signature" id="signature_{{$data->id}}" accept="image/*"
                                        placeholder="Archivo" class="form-control"
                                        value="{!! $data->signature ?: old('signature')  !!}"
                                        onchange="AcceptableFileUpload('form_inputs', '0', '{{$data->id}}', 'signature_{{$data->id}}')">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-control-label" for="account_number">Foto Perfil</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-image"></i></span>
                                    </div>
                                    <input type="file" name="avatar" id="avatar_{{$data->id}}" accept="image/*"
                                        placeholder="Archivo" class="form-control"
                                        value="{!! $data->avatar ?: old('avatar')  !!}"
                                        onchange="AcceptableFileUpload('form_inputs', '0', '{{$data->id}}', 'avatar_{{$data->id}}')">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <label class="form-control-label" for="status">Estado</label>
                            <div class="input-group input-group-merge">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-check"></i></span>
                                </div>
                                @include('generals::layouts.admin.is_active_layout', ['status' => $data->is_active])
                            </div>
                        </div>
                        <div class="col-sm-6" id="size_overflow_{{$data->id}}" style="display: none">
                            <h3>TAMAÑO DE ARCHIVO EXCEDIDO<span style="color: #f5365c;">
                                    <i class="fas fa-exclamation-circle"></i>
                                </span></h3>
                            <p>
                                El tamaño máximo de todos los archivos a subir debe ser menor o igual a 10MB
                            </p>
                            <p>Los archivos que has seleccionado pesan <span id="total_size_{{$data->id}}"></span>MB</p>
                        </div>
                        @if (auth()->guard('employee')->user()->hasRole('superadmin|rh'))
                        <div class="col-sm-12">
                            <label class="form-control-label" for="password">Rol</label>
                            @include('generals::admin.shared.roles', ['roles' => $roles, 'selectedIds' =>
                            ( $data->role->isNotEmpty() )? $data->role->first()->id : 0])
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-sm"
                        id="create_button_{{$data->id}}">Actualizar</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
