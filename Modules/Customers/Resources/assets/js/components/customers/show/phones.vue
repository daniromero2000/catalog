<template>
  <b-card no-body class="card bg-white shadow border-0">
    <b-card-header class="bg-white">
      <div class="row">
        <div class="col">
          <h3 class="mb-0 h4">Teléfonos</h3>
        </div>
        <div class="col text-right">
          <b-button variant="primary" class="btn-sm" v-b-modal.addPhone>Agregar</b-button>
        </div>
      </div>
    </b-card-header>
    <div>
      <div class="table-responsive">
        <table
          v-if="customer.customer_phones != ''"
          class="table align-items-center table-flush table-hover"
        >
          <thead class="small">
            <tr>
              <th class="text-center" scope="col">Tipo Teléfono</th>
              <th class="text-center" scope="col">Teléfono</th>
              <th class="text-center" scope="col">Fecha Registro</th>
            </tr>
          </thead>
          <tbody class="small text-center">
            <tr v-for="(customer_phone, key) in customer.customer_phones" :key="key">
              <td scope="row">{{customer_phone.phone_type}}</td>
              <td scope="row">{{customer_phone.phone}}</td>
              <td scope="row">{{customer_phone.created_at}}</td>
            </tr>
          </tbody>
        </table>
        <div v-else>
          <div class="alert mb-0" role="alert">
            <strong>Aún no</strong> tiene
            <strong>Teléfonos</strong> relacionados
          </div>
        </div>
      </div>
      <b-overlay :show="show" no-wrap></b-overlay>
      <addPhone></addPhone>
    </div>
  </b-card>
</template>

<script>
import addPhone from "../modals/addPhone";

export default {
  components: {
    addPhone
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
