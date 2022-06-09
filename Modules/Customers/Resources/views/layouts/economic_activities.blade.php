<div class="row">
  <!-- references -->
  <div class="col-md-12">
    <div class="box" style="box-shadow: 0px 2px 25px rgba(0, 0, 0, .25);">
      <div class="box-body">
        <h1><i class="fa fa-money" aria-hidden="true"></i> Actividades Económicas</h1>
        @if($customer->customerEconomicActivities->isNotEmpty())
        <table class="table-striped table table-borderless table-hover table-sm">
          <thead>
            <tr>
              <th class="text-center" scope="col">Tipo Actividad</th>
              <th class="text-center" scope="col">Nombre Entidad</th>
              <th class="text-center" scope="col">Cargo</th>
              <th class="text-center" scope="col">Dirección Entidad</th>
              <th class="text-center" scope="col">Teléfono Entidad</th>
              <th class="text-center" scope="col">Ciudad</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($customer->customerEconomicActivities as $customer_economic_activity)
                      <tr>
              <td class="text-center">
                {{ $customer_economic_activity->economicActivityType->economic_activity_type }}</td>
              <td class="text-center">
                {{ $customer_economic_activity->entity_name }}
              </td>
              <td class="text-center">
                {{ $customer_economic_activity->professionsList->profession }}
              </td>
              <td class="text-center">
                {{ $customer_economic_activity->entity_address }}
              </td>
              <td class="text-center">
                  {{ $customer_economic_activity->entity_phone }}
                </td>
              <td class="text-center">
                {{ $customer_economic_activity->city->city }}
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        @else
        <span><strong>Aún no</strong> tiene profesiones</span><br>
        @endif
        <div class="row">
          <div class="col">
            <a href="#" data-toggle="modal" data-target="#economicactivitymodal" <i class="btn btn-primary btn-sm"><i
                class="fa fa-edit"></i>
              Agregar Referencia</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
