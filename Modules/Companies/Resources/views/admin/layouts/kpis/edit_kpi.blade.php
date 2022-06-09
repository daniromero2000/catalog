<!-- Modal -->
<div class="modal fade" id="modal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Actualizar Kpi</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route($optionsRoutes . '.update', $data->id) }}" method="post" class="form"
                enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="modal-body py-0">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="min_fortnight_goal">Meta mínima quincenal 
                                    <span class="text-danger">*</span></label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-dollar-sign"></i></span>
                                    </div>
                                    <input type="decimal" name="min_fortnight_goal" id="min_fortnight_goal" 
                                        placeholder="2000,00" validation-pattern="min_fortnight_goal"
                                        class="form-control" value="{{ $data->min_fortnight_goal }}" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="icon">Sede 
                                    <span class="text-danger">*</span></label>
                                <select class="form-control" name="subsidiary_id" id="subsidiary_id">
                                    <option value selected disabled>--select an option--</option>
                                    @foreach ($subsidiaries as $subsidiary)
                                        <option value="{{ $subsidiary->id }}"
                                            @if ($subsidiary->id == $data->subsidiary_id)
                                                selected
                                            @endif>
                                            {{ $subsidiary->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="icon">Turno 
                                    <span class="text-danger">*</span></label>
                                <select class="form-control" name="shift_id" id="shift_id">
                                    <option value selected disabled>--select an option--</option>
                                    @foreach ($shifts as $shift)
                                        <option value="{{ $shift->id }}"
                                            @if ($shift->id == $data->shift_id)
                                                selected
                                            @endif>{{ $shift->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
