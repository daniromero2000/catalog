<template>
  <b-card no-body class="card bg-white shadow border-0">
    <b-card-header class="bg-white">
      <div class="row">
        <div class="col">
          <h3 class="mb-0 h4">Comentarios</h3>
        </div>
        <div class="col text-right">
          <b-button variant="primary" class="btn-sm" v-b-modal.addComment>Agregar</b-button>
        </div>
      </div>
    </b-card-header>
    <div>
      <div class="table-responsive">
        <table
          v-if="customer.customer_commentaries != ''"
          class="table align-items-center table-flush table-hover"
        >
          <thead class="small">
            <tr>
              <th class="text-center" scope="col">Comentario</th>
              <th class="text-center" scope="col">Usuario</th>
              <th class="text-center" scope="col">Fecha</th>
            </tr>
          </thead>
          <tbody class="small text-center">
            <tr v-for="(customer_commentary, key) in customer.customer_commentaries" :key="key">
              <td scope="row">{{customer_commentary.commentary}}</td>
              <td
                v-if="customer_commentary.customer"
                scope="row"
              >{{customer_commentary.customer.name}}</td>
              <td v-else></td>
              <td scope="row">{{customer_commentary.created_at}}</td>
            </tr>
          </tbody>
        </table>
        <div v-else>
          <div class="alert mb-0" role="alert">
            <strong>Aún no</strong> tiene
            <strong>Comentarios</strong>
          </div>
        </div>
      </div>
      <b-overlay :show="show" no-wrap></b-overlay>
      <addComment></addComment>
    </div>
  </b-card>
</template>

<script>
import addComment from "../modals/addComment";

export default {
  components: {
    addComment
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
