<template>
  <b-card no-body class="card bg-white shadow border-0">
    <b-card-header class="bg-white">
      <div class="row">
        <div class="col">
          <h3 class="mb-0 h4">Datos de Residencia</h3>
        </div>
        <div class="col text-right">
          <b-button variant="primary" class="btn-sm" v-b-modal.addAddress>Agregar</b-button>
        </div>
      </div>
    </b-card-header>
    <div>
      <div class="table-responsive">
        <table
          v-if="customer.customer_addresses != ''"
          class="table align-items-center table-flush table-hover"
        >
          <thead class="small">
            <tr>
              <th class="text-center" scope="col">Tipo Vivienda</th>
              <th class="text-center" scope="col">Antiguedad</th>
              <th class="text-center" scope="col">Dirección</th>
              <th class="text-center" scope="col">Estrato SocioEconómico</th>
              <th class="text-center" scope="col">Ciudad</th>
              <th class="text-center" scope="col">Departamento</th>
            </tr>
          </thead>
          <tbody class="small text-center">
            <tr v-for="(customer_address, key) in customer.customer_addresses" :key="key">
              <td v-if="customer_address.housing" scope="row">{{customer_address.housing.housing}}</td>
              <td v-else></td>
              <td scope="row">{{customer_address.time_living}}</td>
              <td scope="row">{{customer_address.customer_address}}</td>
              <td
                v-if="customer_address.stratum"
                scope="row"
              >{{customer_address.stratum.description}}</td>
              <td v-else></td>
              <td v-if="customer_address.city" scope="row">{{customer_address.city.city}}</td>
              <td v-else></td>
              <td
                v-if="customer_address.city"
                scope="row"
              >{{customer_address.city.province.province}}</td>
              <td v-else></td>
            </tr>
          </tbody>
        </table>
        <div v-else>
          <div class="alert mb-0" role="alert">
            <strong>Aún no</strong> tiene
            <strong>Residencias</strong> relacionadas
          </div>
        </div>
      </div>
      <b-overlay :show="show" no-wrap></b-overlay>
      <addAddress></addAddress>
    </div>
  </b-card>
</template>

<script>
import addAddress from "../modals/addAddress";

export default {
  components: {
    addAddress
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
