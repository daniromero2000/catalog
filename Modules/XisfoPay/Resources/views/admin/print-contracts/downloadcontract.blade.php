<!DOCTYPE html>
<html>
 <head>
  <title>PDF</title>
  <style type="text/css">
   .box{
    width:600px;
    margin:0 auto;
   }
  </style>
 </head>
 <body>
  <br />
  <div class="container">
   <h3 align="center"><h5 class="modal-title">Solicitud de Servicios @if ($contract_request->customer->customerCompanies)
    Persona {{ $contract_request->customerCompany->constitution_type }}<br>
@endif</h5>/h3><br />

   <div class="row">
    <div class="col-md-7" align="right">
     <h4>Data</h4>
     {{ $contract_request->customer->name }} {{ $contract_request->customer->last_name}}<br>
                <strong>Identificador Cliente </strong>
                    {{ $contract_request->client_identifier }}<br>
    </div>
    <div class="col-md-5" align="right">
     <a href="{{ url('dynamic_pdf/pdf') }}" class="btn btn-danger">Convertir a PDF</a>
    </div>
   </div>
   <br />
   <div class="table-responsive">
    <table class="table-striped table  table-bordered">
     <thead>
      <tr>
       <th>Name</th>
       <th>Código</th>
      </tr>
     </thead>
     <tbody>
      <tr>
        <td>{{ $contract_request->customer->name }}</td>
        <td>{{ $contract_request->client_identifier }}</td>
     </tbody>
    </table>
   </div>
  </div>
 </body>
</html>
