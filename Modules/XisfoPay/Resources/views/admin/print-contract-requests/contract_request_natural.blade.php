<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>SOLICITUD CONTRATO DE COMPRAVENTA DE FACTURAS CON DESCUENTO</title>
    @include('xisfopay::admin.print-contract-requests.style_layout')
</head>

<body>
    @include('xisfopay::admin.print-contract-requests.header')
    <table class="table-striped title_centerr title_center_" style="width: 100%;">
        <h4 style="text-align:center;"><b>INFORMACIÓN BÁSICA DEL SOLICITANTE</b></h4>
    </table>
    <table class="table-striped info_basic" style="width: 100%;">
        <tbody>
            <tr>
                <td width="50%">
                    <strong>Nombres:</strong><br>
                    {{ $contract_request->customer->name }}
                </td>
                <td width="50%">
                    <strong>Apellidos:</strong><br>
                    {{$contract_request->customer->last_name }}
                </td>
            </tr>
        </tbody>
    </table>
    <table class="table-striped info_basic" style="width: 100%;">
        <tbody>
            <tr>
                <td width="50%">
                    <strong>Número de Identificación:</strong><br>
                    @if($contract_request->customer->customerIdentities[0]->identity_type_id == 1)
                    <span align="right">CC</span>
                    @elseif($contract_request->customer->customerIdentities[0]->identity_type_id == 4)
                    <span align="right">CE</span>
                    @elseif($contract_request->customer->customerIdentities[0]->identity_type_id == 5)
                    <span align="right">NIT</span>
                    @else
                    <span align="right">CC</span><input class="checkbox" type="checkbox" />
                    <span align="right">CE</span><input class="checkbox" type="checkbox" />
                    <span align="right">NIT</span><input class="checkbox" type="checkbox" />
                    @endif
                    {{$contract_request->customer->customerIdentities[0]->identity_number }}
                </td>
                <td width="50%">
                    <strong>Fecha de expedición del documento:</strong><br>
                    {{$contract_request->customer->customerIdentities[0]->expedition_date }}
                </td>
            </tr>
        </tbody>
    </table>
    <table class="table-striped info_basic" style="width: 100%;">
        <tbody>
            <tr>
                <td width="50%">
                    <strong>Lugar de expedición del documento:</strong><br>
                    {{$contract_request->customer->customerIdentities[0]->city->city }}
                </td>
                <td width="50%">
                    <strong>Sexo:</strong><br>
                    {{ $contract_request->customer->genre->genre }}
                </td>
            </tr>
        </tbody>
    </table>
    <table class="table-striped info_basic" style="width: 100%;">
        <tbody>
            <tr>
                <td width="50%">
                    <strong>Fecha de nacimiento:</strong><br>
                    {{ $contract_request->customer->birthday->format('Y-m-d') }}
                </td>
                <td width="50%">
                    <strong>Lugar de nacimiento:</strong><br>
                    {{$contract_request->customer->birthCity->city }}
                </td>
            </tr>
        </tbody>
    </table>
    <table class="table-striped info_basic" style="width: 100%;">
        <tbody>
            <tr>
                <td width="50%">
                    <strong>Estado Civil:</strong><br>
                    {{ $contract_request->customer->civilStatus->civil_status }}
                </td>
                <td width="50%">
                </td>
            </tr>
        </tbody>
    </table>
    <table class="table-striped title_center_" style="width: 100%;">
        <h4 style="text-align:center;"><b>UBICACIÓN</b></h4>
    </table>
    <table class="table-striped info_basic" style="width: 100%;">
        <tbody>
            <tr>
                <td width="50%">
                    <strong>Dirección de Domicilio:</strong><br>
                    {{ $contract_request->customer->customerAddresses[0]->customer_address }}
                </td>
                <td width="50%">
                    <strong>Barrio:</strong><br>
                    {{ $contract_request->customer->customerAddresses[0]->neighborhood }}
                </td>
            </tr>
        </tbody>
    </table>
    <table class="table-striped info_basic" style="width: 100%;">
        <tbody>
            <tr>
                <td width="50%">
                    <strong>Ciudad:</strong><br>
                    {{$contract_request->customer->customerAddresses[0]->city->city }}
                </td>
                <td width="50%">
                    <strong>Correo Electrónico:</strong><br>
                    {{$contract_request->customer->email }}
                </td>
            </tr>
        </tbody>
    </table>
    <table class="table-striped info_basic" style="width: 100%;">
        <tbody>
            <tr>
                <td width="50%">
                    <strong>Teléfono:</strong><br>
                    @if ($contract_request->customer->customerPhones->where('phone_type', 'Fijo')->first())
                    {{ $contract_request->customer->customerPhones->where('phone_type', 'Fijo')->first()->phone }}
                    @else
                    {{ $contract_request->customer->customerPhones[0]->phone }}
                    @endif

                </td>
                <td width="50%">
                    <strong>Celular:</strong><br>
                    {{ $contract_request->customer->customerPhones[0]->phone }}
                </td>
            </tr>
        </tbody>
    </table>
    <table class="table-striped title_center_" style="width: 100%;">
        <h4 style="text-align:center;"><b>INFORMACIÓN DE ACTIVIDAD ECONÓMICA</b></h4>
    </table>
    <table class="table-striped info_basic" style="width: 100%;">
        <tbody>
            <tr>
                <td width="50%">
                    <strong>Nombre de la Empresa o Negocio:</strong><br>
                    {{ $contract_request->customerCompany->company_legal_name }}
                </td>
                <td width="50%">
                    <strong>Dirección de la Empresa o Negocio:</strong><br>
                    {{ $contract_request->customerCompany->company_address }}
                </td>
            </tr>
        </tbody>
    </table>
    <table class="table-striped info_basic" style="width: 100%;">
        <tbody>
            <tr>
                <td width="50%">
                    <strong>Barrio:</strong><br>
                    {{ $contract_request->customerCompany->neighborhood }}
                </td>
                <td width="50%">
                    <strong>Ciudad:</strong><br>
                    {{$contract_request->customerCompany->city->city }}
                </td>
            </tr>
        </tbody>
    </table>
    <table class="table-striped info_basic" style="width: 100%;">
        <tbody>
            <tr>
                <td width="50%">
                    <strong>Teléfono:</strong><br>
                    {{ $contract_request->customer->customerPhones[0]->phone }}
                </td>
                <td width="50%">
                    <strong>Nombre del Estudio:</strong><br>
                    {{ $contract_request->customerCompany->company_commercial_name }}
                </td>
            </tr>
        </tbody>
    </table>
    <table class="table-striped info_basic" style="width: 100%;">
        <tbody>
            <tr>
                <td width="50%">
                    <strong>Número Sedes:</strong><br>
                    {{ $contract_request->customerCompany->subsidiaries}}
                </td>
                <td width="50%">
                    <strong>Tipo de Cliente:</strong><br>
                    {{ $contract_request->customer->customerGroup->name }}
                </td>
            </tr>
        </tbody>
    </table>
    @include('xisfopay::admin.print-contract-requests.same_contract_data')
</body>

</html>
