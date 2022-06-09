<template>
  <b-card no-body class="card bg-white shadow border-0">
    <b-card-header class="bg-white">
      <div class="row">
        <div class="col">
          <h3 class="mb-0 h4">Datos de Identificación</h3>
        </div>
        <div class="col text-right">
          <b-button variant="primary" class="btn-sm" v-b-modal.addIdentification>Agregar</b-button>
        </div>
      </div>
    </b-card-header>
    <div>
      <div class="table-responsive">
        <table
          v-if="customer.customer_identities != ''"
          class="table align-items-center table-flush table-hover"
        >
          <thead class="small">
            <tr>
              <th class="text-center" scope="col">Tipo de Documento</th>
              <th class="text-center" scope="col">Número</th>
              <th class="text-center" scope="col">Fecha de Expedición</th>
              <th class="text-center" scope="col">Ciudad de Expedición</th>
            </tr>
          </thead>
          <tbody class="small text-center">
            <tr v-for="(customer_identity, key) in customer.customer_identities" :key="key">
              <td
                v-if="customer_identity.identity_type"
                scope="row"
              >{{customer_identity.identity_type.identity_type}}</td>
              <td v-else></td>
              <td scope="row">{{customer_identity.identity_number}}</td>
              <td scope="row">{{customer_identity.expedition_date}}</td>
              <td v-if="customer_identity.city" scope="row">{{customer_identity.city.city}}</td>
              <td v-else></td>
            </tr>
          </tbody>
        </table>
        <div v-else>
          <div class="alert mb-0" role="alert">
            <strong>Aún no</strong> tiene
            <strong>Identificaciones</strong> relacionadas
          </div>
        </div>
      </div>
      <b-overlay :show="show" no-wrap></b-overlay>
      <addIdentification></addIdentification>
    </div>
  </b-card>
</template>

<script>
import addIdentification from "../modals/addIdentification";

export default {
  components: {
    addIdentification
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
