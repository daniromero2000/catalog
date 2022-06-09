<div class="modal fade" id="tipperModal{{$cammodelWorkReport->cammodel->id}}" tabindex="-1" role="dialog" 
    aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar Tipper a {{ $cammodelWorkReport->cammodel->nickname }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.cammodel-tippers.store') }}" method="post" class="form"
                onsubmit="disable_button('create_tipper_button_{{ $cammodelWorkReport->cammodel->id }}')">
                @csrf
                <div class="modal-body py-0">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="profile">Nombre</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-font"></i></span>
                                    </div>
                                    <input type="text" class="form-control" name="profile" required>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="connection_time">Plataforma</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-desktop"></i></span>
                                    </div>
                                    <select name="streaming_id" class="form-control" required>
                                        <option value selected disabled>--select an option--</option>
                                        @foreach ($cammodelWorkReport->cammodel->cammodelStreamAccountsWithoutSkype as $streamAccount)
                                            <option value="{{ $streamAccount->streaming->id }}">
                                                {{ $streamAccount->streaming->streaming }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type="hidden" name="cammodel_id" value="{{ $cammodelWorkReport->cammodel->id }}">
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-sm" 
                        id="create_tipper_button_{{ $cammodelWorkReport->cammodel->id }}">Agregar</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
            <div class="table">
                <table class="table text-center">
                    <thead>
                        <tr>
                            <th>Nombre</th>
                            <th>Plataforma</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($cammodelWorkReport->cammodel->tippers as $tipper)
                        <tr>
                            <td>
                                <a href="{{ route('admin.cammodel-tippers.show', $tipper->id) }}">
                                    {{ $tipper->profile }}
                                </a>
                            </td>
                            <td>{{ $tipper->streaming->streaming }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
