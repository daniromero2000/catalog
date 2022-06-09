<template>
  <b-card no-body class="card bg-white shadow border-0">
    <b-card-header class="bg-white">
      <div class="row">
        <div class="col">
          <h3 class="mb-0 h4">Datos de Vehículos</h3>
        </div>
        <div class="col text-right">
          <b-button variant="primary" class="btn-sm" v-b-modal.addVehicle>Agregar</b-button>
        </div>
      </div>
    </b-card-header>
    <div>
      <div class="table-responsive">
        <table
          v-if="customer.customer_vehicles != ''"
          class="table align-items-center table-flush table-hover"
        >
          <thead class="small">
            <tr>
              <th class="text-center" scope="col">Fecha Registro</th>
              <th class="text-center" scope="col">Tipo de Vehículo</th>
              <th class="text-center" scope="col">Marca</th>
            </tr>
          </thead>
          <tbody class="small text-center">
            <tr v-for="(data, key) in customer.customer_vehicles" :key="key">
              <td scope="row">{{data.created_at}}</td>
              <td v-if="data.vehicle_type" scope="row">{{data.vehicle_type.vehicle_type}}</td>
              <td v-else></td>
              <td v-if="data.vehicle_brand" scope="row">{{data.vehicle_brand.vehicle_brand}}</td>
              <td v-else></td>
            </tr>
          </tbody>
        </table>
        <div v-else>
          <div class="alert mb-0" role="alert">
            <strong>Aún no</strong> tiene
            <strong>Vehículos</strong> relacionados
          </div>
        </div>
      </div>
      <b-overlay :show="show" no-wrap></b-overlay>
      <addVehicles></addVehicles>
    </div>
  </b-card>
</template>

<script>
import addVehicles from "../modals/addVehicles";

export default {
  components: {
    addVehicles
  },
  data() {
    return {
      form: {
        from: "",
        to: "",
        search: ""
      },
      show: true
    };
  },
  mounted() {
    this.$store.commit("toggleBusy", true);
  },
  methods: {
    onSubmit(evt) {
      evt.preventDefault();
      this.$store.commit("toggleBusy", true);
    }
  },
  computed: {
    customer() {
      return this.$store.state.customer;
    }
  },
  watch: {
    customer() {
      this.show = false;
    }
  }
};
</script>
