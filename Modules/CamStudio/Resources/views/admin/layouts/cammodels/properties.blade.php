<div>
    <div class="row">
        <div class="col-md-6">
            <div class="card mb-2">
                <div class="card-body">
                    <span class="form-control-label ml-3">Países bloqueados </span>
                    <a class="bg-primary text-white btn btn-sm rounded-pill" data-toggle="modal"
                        data-target="#modal-countries" style="position: absolute;top: 10px;right: 10px;">
                        <i class="fas fa-pen m-auto"> </i> Agregar países
                    </a>
                    <div class="px-3">
                        <div class="card-body">
                            @if($bannedCountries)
                            @foreach($bannedCountries as $bannedCountry)
                            <span class="btn btn-sm rounded-pill"
                                style="background: #E6E6E6;">{{ $bannedCountry->country->name }}</span>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="card mb-2">
                <div class="card-body">
                    <span class="form-control-label ml-3">Turno</span>
                    <select class="form-control rounded-pill mt-2" name="shift_id" id="shift_id" style="background: #E6E6E6">
                        <option value disabled selected>--select an option--</option>
                        @foreach ($shifts as $shift)
                            @if ($shift->id <= 3)
                                <option value="{{ $shift->id }}" @if ($shift->id == $cammodel->shift_id)
                                selected
                                @endif>{{ $shift->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        @include('camstudio::admin.layouts.cammodels.commentaries', ['commentaries' => $cammodel->employee->employeeCommentaries])
        @if (auth()->guard('employee')->user()->hasRole('superadmin|rh'))
        <div class="col-12 mb-3">
            <form action="{{ route('admin.cammodels.deactivate', $cammodel->id) }}" method="get" class="form"
                onsubmit="return confirm('¿Estás seguro que quieres desactivar la modelo?')">
                <button type="submit" class="btn btn-danger btn-sm">Desactivar modelo</button>
            </form>
        </div>
        @endif
    </div>
</div>
