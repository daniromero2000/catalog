<div class="modal fade" id="modal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            @if (!$data->is_transfered)
            <div class="modal-header">
                <h5 class="modal-title">¿Desea confirmar transferencia realizada por <b>
                        ${{number_format($data->value)}}</b>?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route($optionsRoutes . '.update', $data->id) }}" method="post" class="form">
                @csrf
                @method('PUT')
                <input type="hidden" name="is_transfered" value="1">
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-sm" id="create_button_edit_payment_cut">Sí</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">No</button>
                </div>
                @else
                <div class="modal-header">
                    <h5 class="modal-title">Ya fue transferido</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @endif
            </form>
        </div>
    </div>
</div>
