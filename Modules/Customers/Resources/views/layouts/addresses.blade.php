<!-- Residences -->
<div class="row">
  <div class="col-md-12">
    <div class="box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
      <div class="box-body">
        <h1><i class="fas fa-map-marker-alt" aria-hidden="true"></i> Residencia</h1>
        @if($customer->customerAddresses->isNotEmpty())
        <table class="table-striped table table-borderless table-hover table-sm">
          <thead>
            <tr>
              <th class="text-center" scope="col">Tipo Vivienda</th>
              <th class="text-center" scope="col">Antiguedad</th>
              <th class="text-center" scope="col">Dirección</th>
              <th class="text-center" scope="col">Estrato SocioEconómico</th>
              <th class="text-center" scope="col">Ciudad</th>
              <th class="text-center" scope="col">Departamento</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($customer->customerAddresses as $customer_address)
            <tr>
              <td class="text-center">{{ $customer_address->housing->housing }}
              </td>
              <td class="text-center">{{ $customer_address->time_living }} meses</td>
              <td class="text-center">{{ $customer_address->customer_address }}</td>
              <td class="text-center">
                {{ $customer_address->Stratum->description }}</td>
              <td class="text-center">{{ $customer_address->city->city }}</td>
              <td class="text-center">{{ $customer_address->city->province->province }}
              </td>
            </tr>
            @endforeach
            </th>
          </tbody>
        </table>
        @else
        <span><strong>Aún no</strong> tiene direcciones</span><br>
        @endif
        <div class="row">
          <div class="col">
            <a href="# " data-toggle="modal" data-target="#addressmodal" <i class="btn btn-primary btn-sm"><i
                class="fa fa-edit"></i>
              Agregar Residencia</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
