@section('styles')
<style>
    .contract-renewal-alert {
        background-color: #f5365c;
        color: white;
        padding: 5px 10px;
        border-radius: 5px;
    }

</style>
@endsection
<div class="card">
    <div class="card-body">
        <div class="row align-items-center mb-3">
            <div class="col">
                <h3 class="mb-0"> <strong>Vigencias y Renovaciones </strong></h3>
            </div>
            @if ($contract->contractRenewals->isEmpty())
            <div class="col text-right">
                <a href="#" data-toggle="modal" data-target="#contractrenewalmodal" class="btn btn-primary btn-sm"><i
                        class="fa fa-edit"></i>
                    Ingresar Vigencia Contrato</a>
            </div>
            @elseif (!$contract->contractRenewals->first()->is_active)
            <div class="col text-right">
                <a href="#" data-toggle="modal" data-target="#contractrenewalmodal" class="btn btn-primary btn-sm"><i
                        class="fa fa-edit"></i>
                    Renovar Contrato</a>
            </div>
            @endif
        </div>
        <div class="w-100">
            <div class="table-responsive">
                @if(!$contract->contractRenewals->isEmpty())
                <table class="table-striped table align-items-center table-flush table-hover text-center">
                    <thead class="thead-light">
                        <tr>
                            <th scope="col">FECHA RENOVACIÓN</th>
                            <th scope="col">TARIFA</th>
                            <th scope="col">INICIO</th>
                            <th scope="col">EXPIRACIÓN</th>
                            <th scope="col">TARIFA ESPECIAL / APROBADO / ACTIVO</th>
                            <th scope="col">OPCIONES</th>
                        </tr>
                    </thead>
                    <tbody class="list">
                        @foreach($contract->contractRenewals as $data)
                        <tr>
                            <td class="text-center">{{ $data->created_at->format('M d, Y h:i a') }}</td>
                            <td class="text-center">{{ $data->ContractRate->percentage }}</td>
                            <td class="text-center">{{ $data->starts->format('M d, Y h:i a') }}</td>
                            <td class="text-center">{{ $data->expires->format('M d, Y h:i a') }}</td>
                            <td class="text-center">@include('generals::layouts.status', ['status' =>
                                $data->is_special_price]) @include('generals::layouts.status', ['status' =>
                                $data->is_aprobed]) @include('generals::layouts.status', ['status' =>
                                $data->is_active])
                            </td>
                            <td class="text-center">
                                <a data-toggle="modal" data-target="#modal{{$data->id}}" href=""
                                    class="table-action table-action" data-toggle="tooltip" data-original-title="">
                                    <i class="fas fa-edit"></i></a>
                                <a href="" class=" table-action table-action" data-toggle="tooltip"
                                    data-original-title="">
                                    <i class=""></i>
                                </a>
                                <a href="#" data-toggle="modal" data-target="#modal-bankImage{{$data->id}}">
                                    <i class="fas fa-search"></i>
                                </a>
                            </td>
                            @include('xisfopay::layouts.contracts.contract_image')
                            <!-- Modal -->
                            <div class="modal fade" id="modal{{$data->id}}" tabindex="-1" role="dialog"
                                aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Editar Renovación De Contrato</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body py-0">
                                            <form action="{{ route('admin.contract-renewals.update', $data->id) }}"
                                                method="post" class="form" enctype="multipart/form-data"
                                                id="form_{{$data->id}}">
                                                @csrf
                                                @method('PUT')
                                                <div id="size_overflow_{{$data->id}}" style="display: none">
                                                    <h3>TAMAÑO DE ARCHIVO EXCEDIDO<span style="color: #f5365c;">
                                                            <i class="fas fa-exclamation-circle"></i>
                                                        </span></h3>
                                                    <p>
                                                        El tamaño máximo de todos los archivos a subir debe ser menor o
                                                        igual a 10MB
                                                    </p>
                                                    <p>Los archivos que has seleccionado pesan <span
                                                            id="total_size_{{$data->id}}"></span>MB</p>
                                                </div>
                                                @if (!$data->is_aprobed)
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="starts">Fecha de
                                                                inicio</label>
                                                            <div class="input-group input-group-merge">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i
                                                                            class="fas fa-calendar-week"></i></span>
                                                                </div>
                                                                <input value="{{ $data->starts->format('Y-m-d') }}"
                                                                    type="date" class="form-control" name="starts"
                                                                    id="starts" placeholder="00/00/0000">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label class="form-control-label" for="expires">Fecha de
                                                                expiración</label>
                                                            <div class="input-group input-group-merge">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i
                                                                            class="fas fa-calendar-week"></i></span>
                                                                </div>
                                                                <input type="date"
                                                                    value="{{ $data->expires->format('Y-m-d') }}"
                                                                    class="form-control" name="expires" id="expires">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label class="form-control-label"
                                                                for="account_number">Archivo</label>
                                                            <div class="input-group input-group-merge">
                                                                <div class="input-group-prepend">
                                                                    <span class="input-group-text"><i
                                                                            class="fa fa-file-alt"></i></span>
                                                                </div>
                                                                <input type="file" name="file" id="file_{{$data->id}}_1"
                                                                    placeholder="Archivo" class="form-control"
                                                                    value="{!! $data->file ?: old('file')  !!}"
                                                                    accept="image/*, .pdf"
                                                                    onchange="AcceptableFileUpload('form_{{$data->id}}', '0', '{{$data->id}}', 'file_{{$data->id}}_1')">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @else
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label class="form-control-label"
                                                            for="account_number">Archivo</label>
                                                        <div class="input-group input-group-merge">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i
                                                                        class="fa fa-file-alt"></i></span>
                                                            </div>
                                                            <input type="file" name="file" id="file_{{$data->id}}_2"
                                                                accept="image/*, .pdf" placeholder="Archivo"
                                                                class="form-control"
                                                                value="{!! $data->file ?: old('file')  !!}"
                                                                onchange="AcceptableFileUpload('form_{{$data->id}}', '0', '{{$data->id}}', 'file_{{$data->id}}_2')">
                                                        </div>
                                                    </div>
                                                </div>
                                                <h3 class="mb-0">Ya fue aprobada!!!</h3>
                                                @endif
                                                <div class="card-footer text-right">
                                                    <button type="submit" id="create_button_{{$data->id}}"
                                                        class="btn btn-primary btn-sm">Actualizar</button>
                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                        data-dismiss="modal">Cerrar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </tr>
                    </tbody>
                    @endforeach
                </table>
                @else
                <span class="text-sm"><strong>Aún no</strong> tiene Vigencia el Contrato.<br>
                    Debes asignarle una para su impresión y firma. Puedes asignar una vigencia aleatoria ya que el
                    sistema calculará un año automaticamente a partir de la fecha de impresión.</span><br>
                @endif
            </div>
        </div>
    </div>
</div>
@include('generals::layouts.admin.files.size_calculatorJS')
