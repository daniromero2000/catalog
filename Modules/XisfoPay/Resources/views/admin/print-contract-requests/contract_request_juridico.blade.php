<!DOCTYPE html>
<html>

<head>
    <title>SOLICITUD CONTRATO DE COMPRAVENTA DE FACTURAS CON DESCUENTO</title>
    @include('xisfopay::admin.print-contract-requests.style_layout')
</head>

<body>
    @include('xisfopay::admin.print-contract-requests.header')
    <table class="table-striped title_center" style="width: 100%;">
        <h4 style="text-align:center;"><b>INFORMACIÓN BÁSICA DEL SOLICITANTE</b></h4>
    </table>
    <table class="table-striped info_basic" style="width: 100%;">
        <tbody>
            <tr>
                <td width="50%">
                    <strong>Razón Social:</strong><br>
                    {{ $contract_request->customerCompany->company_legal_name }}
                </td>
                <td width="50%">
                    <strong>NIT:</strong><br>
                    {{$contract_request->customerCompany->company_id_number }}
                </td>
            </tr>
            <tr>
                <td width="50%">
                    <strong>Fecha de Constitución:</strong><br>
                </td>
                <td width="50%">
                </td>
            </tr>
        </tbody>
    </table>
    <table class="table-striped title_center_" style="width: 100%;">
        <h4 style="text-align:center;"><b>INFORMACIÓN DEL REPRESENTANTE LEGAL</b></h4>
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
                </td>
            </tr>
        </tbody>
    </table>
    <table class="table-striped title_center_" style="width: 100%;padding-top:10px;">
        <h4 style="text-align:center;"><b>DATOS DE LA EMPRESA</b></h4>
    </table>
    <table class="table-striped info_basic" style="width: 100%;">
        <tbody>
            <tr>
                <td width="50%">
                    <strong>Nombre del Estudio:</strong><br>
                    {{ $contract_request->customerCompany->company_commercial_name }}
                </td>
                <td width="50%">
                    <strong>Dirección:</strong><br>
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
                    <strong>Correo Electrónico:</strong><br>
                    {{ $contract_request->customer->email}}
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
                </td>
            </tr>
        </tbody>
    </table>

    @include('xisfopay::admin.print-contract-requests.same_contract_data')
</body>

</html>
