<div class="modal fade" id="fineModal{{$cammodelWorkReport->cammodel->id}}" tabindex="-1" role="dialog" 
    aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar multa a {{ $cammodelWorkReport->cammodel->nickname }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.cammodel-fines.store') }}" method="post" class="form"
                onsubmit="disable_button('create_fine_button_{{ $cammodelWorkReport->cammodel->id }}')">
                @csrf
                <div class="modal-body py-0">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="connection_time">Falta</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                    </div>
                                    <select name="foul_id" class="form-control" required>
                                        <option value disabled selected>--select an option--</option>
                                        @foreach ($fouls as $foul)
                                        @if (array_key_exists($cammodelWorkReport->cammodel->id,$cammodelFouls))    
                                            @if (!in_array($foul->id,$cammodelFouls[$cammodelWorkReport->cammodel->id]))    
                                                <option value="{{$foul->id}}">{{ $foul->name }}</option>
                                            @endif
                                        @else
                                            <option value="{{$foul->id}}">{{ $foul->name }}</option>
                                        @endif
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
                        id="create_fine_button_{{ $cammodelWorkReport->cammodel->id }}">Agregar</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
