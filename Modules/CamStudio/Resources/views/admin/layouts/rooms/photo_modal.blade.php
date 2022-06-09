<div class="modal fade" id="room-photo-{{$data->id}}" tabindex="-1" role="dialog"
    aria-labelledby="modal-default" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title" id="modal-title-default">Foto de {{ $data->name }} </h6>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            @if (!empty($data->photo))
            @include('generals::layouts.admin.files.show_pdf_or_image', ['data'=>
            $data->photo])
            @else
            <div class="modal-body">
                <span>No hay foto registrada del room.</span>
            </div>
            @endif
            <div class="modal-footer">
                <button type="button" class="btn btn-link  ml-auto" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
