<template>
  <b-card no-body class="card bg-white shadow border-0">
    <b-card-header class="bg-white">
      <div class="row">
        <div class="col">
          <h3 class="mb-0 h4">Eps</h3>
        </div>
        <div class="col text-right">
          <b-button variant="primary" class="btn-sm" v-b-modal.addEps>Agregar</b-button>
        </div>
      </div>
    </b-card-header>
    <div>
      <div class="table-responsive">
        <table
          v-if="customer.customer_epss != ''"
          class="table align-items-center table-flush table-hover"
        >
          <thead class="small">
            <tr>
              <th class="text-center" scope="col">Eps</th>
              <th class="text-center" scope="col">Fecha Registro</th>
            </tr>
          </thead>
          <tbody class="small text-center">
            <tr v-for="(customer_eps, key) in customer.customer_epss" :key="key">
              <td v-if="customer_eps.eps" scope="row">{{customer_eps.eps.eps}}</td>
              <td v-else></td>
              <td scope="row">{{customer_eps.created_at}}</td>
            </tr>
          </tbody>
        </table>
        <div v-else>
          <div class="alert mb-0" role="alert">
            <strong>Aún no</strong> tiene
            <strong>Eps</strong> relacionadas
          </div>
        </div>
      </div>
      <b-overlay :show="show" no-wrap></b-overlay>
      <addEps></addEps>
    </div>
  </b-card>
</template>

<script>
import addEps from "../modals/addEps";

export default {
  components: {
    addEps
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
