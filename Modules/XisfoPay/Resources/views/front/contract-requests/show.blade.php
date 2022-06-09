@extends('xisfopay::front.customers.accounts.app')
@section('name-pagine')
Solicitud de servicio |
@endsection
@section('name-module')
 Solicitudes de servicio <i class="fas fa-file-contract"></i>
@endsection
@section('breadcum-item')
Solicitudes de servicio <i class="fas fa-file-signature"></i> / Solicitud de servicio cliente no. <span>{{ $contract_request->client_identifier }} </span>
@endsection
@section('styles')
<style>
    #image-comp .hidden-button a {
        display: none;
    }

    #image-comp .hidden-button:hover a {
        display: inline;
    }

</style>
@endsection
@section('content')
<div class="container-fluid mt--6">
    @include('generals::layouts.errors-and-messages')
    <div class="row">
        <div class="col-xl-12 order-xl-12">
            <div class="card">
                <div class="card-header">
                    <div class="row row-reset w-100">
                        <div class="col-12 col-sm-12 col-md-12 col-xl-3 m-auto text-center">
                            <div>
                                <img style="max-height: 200px; max-width: 200px;"
                                    src="{{asset("img/xisfopay/logo-xisfo-pay-services.png")}}" alt="Logo Xisfo Pay">
                            </div>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-xl-6 m-auto">
                            <h2 class="text-center p-3 mb-2">
                                Solicitud de servicios
                                @if ($contract_request->customer->customerCompanies) Persona
                                {{ $contract_request->customerCompany->constitution_type }}<br>
                                <small>{{ $contract_request->customerCompany->company_legal_name }} /
                                    {{ $contract_request->customerCompany->company_commercial_name }}</small>
                                <br>
                                @endif
                                <small>{{ $contract_request->client_identifier }}</small><br>
                                <span class="badge"
                                    style="color: #ffffff; background-color: {{ $contract_request->contractRequestStatus->color }}">
                                    {{ $contract_request->contractRequestStatus->name }}
                                </span>
                            </h2>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-xl-3 m-auto text-center">
                            @if (!@isset($contract_request->customerCompany->logo))
                            <div id="image-comp">
                                <div class="hidden-button">
                                    <img class="w-100" style="max-height: 200px; max-width: 130px;"
                                        src="{{asset("storage/" . $contract_request->customerCompany->logo)}}"
                                        alt="Logo compañía cliente">
                                    <a style="position: absolute; left: 50%; bottom: 50%; transform: translate(-50%,50%)"
                                        href="#" data-toggle="modal" data-target="#companyLogoModal"
                                        class="btn btn-sm btn-primary" type="button">
                                        <span><i class="fas fa-edit"></i></span> Editar logo</a>
                                </div>
                            </div>
                            @else
                            <div id="image-comp">
                                <div class="hidden-button">
                                    <img src="{{asset('img/xisfopay/logo-defecto.png')}}" alt="Cargar logo empresa">
                                    <br>
                                    <span>Cargar logo empresa</span>
                                    <a style="position: absolute; left: 50%; bottom: 50%; transform: translate(-50%,50%)"
                                        href="#" data-toggle="modal" data-target="#companyLogoModal"
                                        class="btn btn-sm btn-primary" type="button">
                                        <span><i class="fas fa-edit"></i></span> Editar logo</a>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="row align-items-center">
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 text-center m-0 p-0">
                            <h3 class="mb-0"> <i class="fas fa-columns"></i> Panel de adminsitración solicitud de servicio</h3>
                        </div>
                        <div class="col-12 col-sm-12 col-md-6 col-lg-6 col-xl-6 text-center m-0 p-0">
                            <h3 class="mb-0"> <strong><i class="fas fa-user-tie"></i> Asesor Comercial: </strong>
                                @if ($contract_request->employee)
                                {{$contract_request->employee->name}}
                                {{$contract_request->employee->last_name}}
                                @else
                                <span class="dont-commercial">Aún no tienes Asesor Comercial asignado</span>
                                @endif
                            </h3>
                        </div>
                    </div>
                    <div class="row row-reset w-100 mt-4">
                        @if ($contract_request->contract_request_status_id == 7)
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 m-auto text-right">
                            <span class="indicator-title">
                                <i class="fas fa-check-double"></i> Indicador de solicitud:
                            </span>
                            <span href="" data-toggle="modal" data-target="#InformationModal" style="background-color: {{ $contract_request->contractRequestStatus->color }}" class="btn-information-precaution">
                                Completa los datos para tramitar tu solicitud
                                <i class="fas fa-exclamation-circle"></i>
                            </span>
                            <br>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 m-auto text-left">
                            <span class="indicator-description">
                                <span>Para completar tu solicitud asegurate de que lo siguientes datos estén completos y verificados:</span>
                                <ul>
                                @if($contract_request->customer->customerReferences->isEmpty())
                                    <li class="ul-none-style" type="square">
                                        <i style="color: {{ $contract_request->contractRequestStatus->color }}" class="fas fa-flag"></i> Referencias de cliente.
                                    </li>
                                @endif
                                @if ($contract_request->customer->customerAddresses->isEmpty())
                                    <li class="ul-none-style" type="square">
                                        <i style="color: {{ $contract_request->contractRequestStatus->color }}" class="fas fa-flag"></i> Datos de direcciones y residencia.
                                    </li>
                                @endif
                                @if ($contract_request->customer->customerPhones->isEmpty())
                                    <li class="ul-none-style" type="square">
                                        <i style="color: {{ $contract_request->contractRequestStatus->color }}" class="fas fa-flag"></i> Teléfonos de contacto.
                                    </li>
                                @endif
                                @if ($contract_request->customer->customerEmails->isEmpty())
                                    <li class="ul-none-style">
                                        <i style="color: {{ $contract_request->contractRequestStatus->color }}" class="fas fa-flag"></i>  Correos electrónicos.
                                    </li>
                                @endif
                                @if (!@isset($contract_request->customerCompany->file))
                                    <li class="ul-none-style" type="square">
                                        <i style="color: {{ $contract_request->contractRequestStatus->color }}" class="fas fa-flag"></i> Documento de cámara de comercio sin cargar.
                                    </li>
                                @endif
                                @if ($contract_request->customer->customerIdentities->isEmpty())
                                    <li class="ul-none-style" type="square">
                                        <i style="color: {{ $contract_request->contractRequestStatus->color }}" class="fas fa-flag"></i> Documentos de identidad de cliente sin cargar.
                                    </li>
                                @endif
                                @if ($contract_request->customer->customerBankAccounts->isEmpty())
                                    <li class="ul-none-style" type="square">
                                        <i style="color: {{ $contract_request->contractRequestStatus->color }}" class="fas fa-flag"></i> Cuentas bancarias sin registrar.
                                    </li>
                                @endif
                                @if (!@isset($contract_request->customerCompany->logo))
                                    <li class="ul-none-style" type="square">
                                        <i style="color: {{ $contract_request->contractRequestStatus->color }}" class="fas fa-flag"></i> Logo de empresa sin cargar.
                                    </li>
                                @else
                                @endif
                                @if ($contract_request->contractRequestStreamAccount->isEmpty())
                                    <li class="ul-none-style" type="square">
                                        <i style="color: {{ $contract_request->contractRequestStatus->color }}" class="fas fa-flag"></i> Cuentas master sin agregar.
                                    </li>
                                @endif
                            </ul>
                            </span>
                        </div>
                        @elseif ($contract_request->contract_request_status_id == 3)
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 m-auto text-right">
                            <span class="indicator-title">
                                <i class="fas fa-check-double"></i> Indicador de solicitud:
                            </span>
                            <span href="" data-toggle="modal" data-target="#InformationModal" style="background-color: {{ $contract_request->contractRequestStatus->color }}" class="btn-information-contract">
                                Carga tu contrato y solicitud <i class="fas fa-exclamation-circle"></i>
                            </span>
                            <br>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 m-auto text-left">
                            <span class="indicator-description">
                                <span>Para completar tu solicitud carga tu FUC (Formato único de cliente) y tu contrato</span>
                                <ul>
                                    @if (!@isset($contract_request->file))
                                        <li class="ul-none-style" type="square">
                                            <i style="color: {{ $contract_request->contractRequestStatus->color }}" class="fas fa-flag"></i> Solicitud de servicios sin cargar.</li>
                                    @endif
                                    @if (!@isset($contract_request->contract->file))
                                        <li class="ul-none-style" type="square">
                                            <i style="color: {{ $contract_request->contractRequestStatus->color }}" class="fas fa-flag"></i> Contrato sin cargar.</li>
                                    @endif
                                </ul>
                            </span>
                        </div>
                        @elseif ($contract_request->contract_request_status_id == 1)
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 m-auto text-right">
                            <span class="indicator-title">
                                <i class="fas fa-check-double"></i> Indicador de solicitud:
                            </span>
                            <span href="" data-toggle="modal" data-target="#InformationModal" style="background-color: {{ $contract_request->contractRequestStatus->color }}" class="btn-information-revision">
                                Tu solicitud está en revisión
                                <i class="fas fa-exclamation-circle"></i>
                            </span>
                            <br>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 m-auto text-left">
                            <span class="indicator-description">
                                <span>Ya casi completas el proceso, espera la verificación de los datos por parte de tu asesor comercial para continuar con el proceso.</span>
                                <ul>
                                    <li class="ul-none-style" type="square">
                                        <i style="color: {{ $contract_request->contractRequestStatus->color }}" class="fas fa-flag"></i> Tus datos están siendo verificados.
                                    </li>
                                    @if ($contract_request->is_signed==0)
                                        <li class="ul-none-style" type="square">
                                            <i style="color: {{ $contract_request->contractRequestStatus->color }}" class="fas fa-flag"></i> Tu solicitud aún  no está firmada.
                                        </li>
                                    @endif
                                    @if (!@isset($contract_request->file))
                                    <li class="ul-none-style" type="square">
                                        <i style="color: {{ $contract_request->contractRequestStatus->color }}" class="fas fa-flag"></i> Solicitud de servicios sin cargar.</li>
                                    @endif
                                    @if (!@isset($contract_request->contract->file))
                                        <li class="ul-none-style" type="square">
                                            <i style="color: {{ $contract_request->contractRequestStatus->color }}" class="fas fa-flag"></i> Contrato sin cargar.</li>
                                    @endif
                                    @if ($contract_request->contract->is_signed==0)
                                    <li class="ul-none-style" type="square">
                                        <i style="color: {{ $contract_request->contractRequestStatus->color }}" class="fas fa-flag"></i> Tu contrato aún  no está firmado.</li>
                                    @endif
                                    @if ($contract_request->contract->is_active==0)
                                    <li class="ul-none-style" type="square">
                                        <i style="color: {{ $contract_request->contractRequestStatus->color }}" class="fas fa-flag"></i> Tu contrato aún  no está activo.
                                    </li>
                                    @endif
                                    @foreach ($contract_request->customer->customerBankAccounts as $customer_account)
                                        @if ($customer_account->is_aprobed==0)
                                        <li class="ul-none-style" type="square">
                                            <i style="color: {{ $contract_request->contractRequestStatus->color }}" class="fas fa-flag"></i> Tienes cuentas bancarias sin aprobar.
                                        </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </span>
                        </div>
                        @elseif($contract_request->contract_request_status_id == 8)
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 m-auto text-right">
                            <span class="indicator-title">
                                <i class="fas fa-check-double"></i> Indicador de solicitud:
                            </span>
                            <span href="" data-toggle="modal" data-target="#InformationModal" style="background-color: {{ $contract_request->contractRequestStatus->color }}" class="btn-send-document">
                                Tu solicitud está pendiente por documento físico
                                <i class="fas fa-exclamation-circle"></i>
                            </span>
                            <br>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 m-auto text-left">
                            <span class="indicator-description">
                                <span>Envía tus documento físico a la sucursal administrativa (Carrera 7 # 20 - 32, Pereira, Centro.) a nombre de tu asesor comercial.</span>
                            </span>
                        </div>
                        @elseif($contract_request->contract_request_status_id == 5)
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 m-auto text-right">
                            <span class="indicator-title">
                                <i class="fas fa-check-double"></i> Indicador de solicitud:
                            </span>
                            <span href="" data-toggle="modal" data-target="#InformationModal" style="background-color: {{ $contract_request->contractRequestStatus->color }}" class="btn-send-aprobbed">
                                Tu solicitud está aprobada
                                <i class="fas fa-exclamation-circle"></i>
                            </span>
                            <br>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 m-auto text-left">
                            <span class="indicator-description">
                                <span>Tu solicitud está aprobada, verifica si tienes items faltantes en tu contrato para hacer tus procesos en plataforma.</span>
                            </span>
                        </div>
                        @elseif($contract_request->contract_request_status_id == 9)
                        <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xl-6 m-auto text-right">
                            <span class="indicator-title">
                                <i class="fas fa-check-double"></i> Indicador de solicitud:
                            </span>
                            <span href="" data-toggle="modal" data-target="#InformationModal" style="background-color: {{ $contract_request->contractRequestStatus->color }}" class="btn-send-aprobbed">
                                Tu solicitud está inactiva
                                <i class="fas fa-exclamation-circle"></i>
                            </span>
                            <br>
                        </div>
                        <div class="col-12 col-sm-12 col-md-12 col-lg-6 col-xl-6 m-auto text-left">
                            <span class="indicator-description">
                                <span>Comunícate con tu asesor para verificar la reactivación de tu solicitud, no tienes permisos para ejecutar ninguna acción en el panel.</span>
                            </span>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="card-body">
                    <div class="row-row-reset">
                        <div class="col-12">
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab"
                                        aria-controls="home" aria-selected="true"> <i class="fas fa-hand-pointer"></i> 1. Datos de cliente</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile" role="tab"
                                        aria-controls="profile" aria-selected="false"> <i class="fas fa-hand-pointer"></i> 2. Documentos de solicitud</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="contact-tab" data-toggle="tab" href="#contact" role="tab"
                                        aria-controls="contact" aria-selected="false"> <i class="fas fa-hand-pointer"></i> 3. Trazabilidad</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                    @include('xisfopay::layouts.contract_requests.front.contacts')
                                </div>
                                <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                                    @include('xisfopay::layouts.contract_requests.front.documents')
                                </div>
                                <div class="tab-pane fade" id="contact" role="tabpanel" aria-labelledby="contact-tab">
                                    @include('generals::layouts.admin.statusesLog', ['datas' =>
                                    $contract_request->contractRequestStatusesLogs])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@include('xisfopay::front.layouts.contract-requests.edit_company_logo', ['data'=>$contract_request->customerCompany])
@include('xisfopay::front.layouts.contract-requests.edit_contract_request', ['data' => $contract_request])
@include('xisfopay::front.layouts.contract-requests.edit_customer', ['data' => $contract_request->customer])
@include('xisfopay::front.layouts.contract-requests.add_master_account_modal')
@include('xisfopay::front.layouts.contract-requests.add_bank_account_modal')
@include('xisfopay::front.layouts.contract-requests.add_customer_identity_modal')
@include('generals::layouts.admin.files.size_calculatorJS')
@endsection
@section('scripts')
@include('generals::layouts.cities-selectorJS')
@endsection
