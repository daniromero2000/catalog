<div class="header_sc">
    <table class="table-striped header" width="100%">
        <tbody>
            <tr>
                <td>
                    <img src="img/xisfopay/logo-xisfo-pay-services.png" width="190" height="70" class="img-fluid lazy">
                </td>
                <td style="text-align: center;" width="34%" class="title_sup">
                    <b class="first_title">SOLICITUD DE SERVICIOS</b><br>
                    PERSONA {{ $contract_request->customerCompany->constitution_type }}
                </td>
                <td style="text-align: center;">
                    <img src="img/xisfopay/logo-S&C.png" width="130" height="70" class="img-fluid lazy">
                </td>
            </tr>
        </tbody>
    </table>
    <table class="table-striped second" style="width: 100%;">
        <tbody>
            <tr>
                <td width="50%">
                    <b>Número de Solicitud:</b>
                    {{ $contract_request->client_identifier }}
                </td>
                <td width="50%">
                    <b>Fecha de Solicitud:</b>
                    {{ $contract_request->created_at->format('Y-m-d') }}
                </td>
            </tr>
        </tbody>
    </table>
</div>
