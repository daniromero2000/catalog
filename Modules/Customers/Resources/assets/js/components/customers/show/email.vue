<template>
  <b-card no-body class="card bg-white shadow border-0">
    <b-card-header class="bg-white">
      <div class="row">
        <div class="col">
          <h3 class="mb-0 h4">Email</h3>
        </div>
        <div class="col text-right">
          <b-button variant="primary" class="btn-sm" v-b-modal.addEmail>Agregar</b-button>
        </div>
      </div>
    </b-card-header>
    <div>
      <div class="table-responsive">
        <table
          v-if="customer.customer_emails != ''"
          class="table align-items-center table-flush table-hover"
        >
          <thead class="small">
            <tr>
              <th class="text-center" scope="col">Email</th>
              <th class="text-center" scope="col">Fecha Registro</th>
            </tr>
          </thead>
          <tbody class="small text-center">
            <tr v-for="(customer_email, key) in customer.customer_emails" :key="key">
              <td scope="row">{{customer_email.email}}</td>
              <td scope="row">{{customer_email.created_at}}</td>
            </tr>
          </tbody>
        </table>
        <div v-else>
          <div class="alert mb-0" role="alert">
            <strong>Aún no</strong> tiene
            <strong>Emails</strong> relacionados
          </div>
        </div>
      </div>
      <b-overlay :show="show" no-wrap></b-overlay>
      <addEmail></addEmail>
    </div>
  </b-card>
</template>

<script>
import addEmail from "../modals/addEmail";

export default {
  components: {
    addEmail
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
