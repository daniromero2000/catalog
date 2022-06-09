<!-- Modal -->
<div class="modal fade" id="modal{{$cammodel->id}}" tabindex="-1" role="dialog"
    aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Activar Modelo: 
                    {{ $cammodel->nickname }}</h5>
                <button type="button" class="close" data-dismiss="modal" 
                    aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form 
                action="{{ route('admin.cammodels.activate', $cammodel->id) }}" 
                method="get" class="form">
                @csrf
                <div class="modal-body py-0">
                    <span>¿Desea activar a {{ $cammodel->employee->name }} 
                        {{ $cammodel->employee->last_name }}?</span>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-sm btn-primary">Activar</button>
                </div>
            </form>
        </div>
    </div>
</div>