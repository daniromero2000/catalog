<div class="modal fade" id="modal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">¿Desea aprobar el corte? <b>{{$data->name}}</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body py-0">
                @if (!$data->is_aprobed)
                <form action="{{ route($optionsRoutes . '.update', $data->id) }}" method="post" class="form"
                    onsubmit="disable_button('create_button_edit_payment_cut')">
                @csrf
                @method('PUT')
                    <input type="hidden" name="is_aprobed" value="1">
                    <div class="card-footer text-right">
                        <button type="submit" class="btn btn-primary btn-sm" id="create_button_edit_payment_cut">Sí</button>
                        <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">No</button>
                    </div>
                </form>
                @else
                <div class="row">
                    <div class="col-12">
                        <p>
                            <b>Ya fue Aprobado</b>
                        </p>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
