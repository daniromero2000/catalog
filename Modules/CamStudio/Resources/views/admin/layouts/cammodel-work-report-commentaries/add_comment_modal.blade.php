<div class="modal fade" id="commentModal{{ $cammodelWorkReport->id }}" tabindex="-1" role="dialog"
    aria-labelledby="modelTitleId" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Agregar comentario a {{ $cammodelWorkReport->cammodel->nickname }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('admin.cammodel-work-report-commentaries.store') }}" method="post" class="form"
                enctype="multipart/form-data">
                <div class="modal-body py-0">
                    @csrf
                    <input name="cammodel_work_report_id" id="cammodel_work_report_id" type="hidden"
                        value="{{ $cammodelWorkReport->id }}">
                    <div class="form-group">
                        <label class="form-control-label" for="commentary">Comentario</label>
                        <div class="input-group input-group-merge">
                            <input type="text" name="commentary" validation-pattern="text" id="commentary"
                                placeholder="Comentario" class="form-control" value="{{ old('commentary') }}" required
                                autofocus>
                        </div>
                    </div>
                </div>
                <div class="w-100 p-3 text-right">
                    <button type="submit" class="btn btn-primary btn-sm">Agregar</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
            <div class="modal-footer m-0 p-3">
                @include('camstudio::admin.layouts.cammodel-work-report-commentaries.commentaries', ['datas' =>
                $cammodelWorkReport->cammodelWorkReportCommentaries])
            </div>
        </div>
    </div>
</div>
