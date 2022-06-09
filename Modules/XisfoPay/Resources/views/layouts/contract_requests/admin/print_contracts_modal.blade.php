
<div class="modal fade" id="printmodal" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div align="center" class="modal-header ">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body py-0">
                <div class="container">
                    <h3 align="center" class="modal-title">Solicitud de Servicios @if ($contract_request->customer->customerCompanies)
                        Persona {{ $contract_request->customerCompany->constitution_type }}<br>
                    @endif</h3><br />

                    <div class="row">
                        <div class="col-md-7">
                            {{ $contract_request->customer->name }} {{ $contract_request->customer->last_name}}<br>
                        </div>
                    </div>
                    <br />
                    <div class="table-responsive">
                        <table class="table-striped table  table-bordered">
                        <thead>
                        <tr>
                        <th>Nombre</th>
                        <th>Identificador Cliente</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>{{ $contract_request->customer->name }} {{ $contract_request->customer->last_name}}</td>
                            <td>{{ $contract_request->client_identifier }}</td>
                        </tbody>
                        </table>
                    </div>
                    </div>
            </div>
            {{ $contract_request->id }}
            <div class="card-footer text-right">
                <a href="route('admin.contractrequest.generate',$contract_request->id)" class="btn btn-primary" target="_blank">Imprimir</a>
                <a href="route('admin.contract.generate',$contract_request->id)" id="dm" class="btn-primary" name="dm" target="_blank">Descargar</a>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>


