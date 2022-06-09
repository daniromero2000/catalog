<!DOCTYPE html>
<html>

<head>
    <title>CONTRATO DE COMPRAVENTA DE FACTURAS CON DESCUENTO</title>
    @include('xisfopay::admin.print-contracts.style_layout')
    {{-- <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.1/css/all.css" integrity="sha384-vp86vTRFVJgpjF9jiIGPEEqYqlDwgyBgEF109VFjmqGmIY/Y4HV4d3Gp2irVfcrp" crossorigin="anonymous"> --}}
</head>

<body>
    @include('xisfopay::admin.print-contracts.header')
    @include('xisfopay::admin.print-contracts.footer')
    <main><strong><u><span style="font-size: 15px !important;">CONTRATO DE COMPRAVENTA DE FACTURAS CON DESCUENTO PERSONA NATURAL.</span></u></strong><br>
        Contrato <strong>DE COMPRAVENTA DE FACTURAS CON DESCUENTO</strong> suscrito entre:
        <strong>{{ $contract_request->customerCompany->company_legal_name }}</strong> mayor de edad,
        vecino
        de la ciudad de <strong>{{$contract_request->customerCompany->city->city }}</strong> identificado
        con la
        cédula de ciudadanía número <strong>{{$contract_request->customer->customerIdentities[0]->identity_number
            }}</strong> expedida en
        <strong>{{$contract_request->customer->customerIdentities[0]->city->city }}</strong>
        @include('xisfopay::admin.print-contracts.same_contract_data')
        @include('xisfopay::admin.print-contracts.sign_layout')
        <main>
</body>

</html>
