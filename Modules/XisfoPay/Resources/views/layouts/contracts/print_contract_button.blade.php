<div class="text-right">
    <a id="dm" data-toggle="modal" data-target="#modalConfirmPrint" class="btn btn-primary text-white btn-sm"
        target="_blank"><i class="fa fa-print pr-2"></i>
        Imprimir contrato
    </a>
</div>
<!-- Modal -->
<div class="modal fade" id="modalConfirmPrint" tabindex="-1" role="dialog" aria-labelledby="modalConfirmCreateLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header m-auto">
                <h1 class="modal-title mt-2" id="modalConfirmCreateLabel">AVISO DE SEGURIDAD<span
                        style="color: #f5365c;"> <i class="fas fa-exclamation-circle"></i></span></h1>
            </div>
            <div class="modal-body text-center mx-3" style="padding:0px !important;">
                <p>
                    ¿Estás seguro que quieres imprimir este contrato?
                </p>
                <p>Esto afectará las fechas de vigencia iniciando desde la fecha de hoy</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Volver</button>
                <a class="btn btn-primary text-white btn-sm" target="_blank"
                    href="{{ route('admin.contract.generate', $id) }}">Imprimir</a>
            </div>
        </div>
    </div>
</div>
