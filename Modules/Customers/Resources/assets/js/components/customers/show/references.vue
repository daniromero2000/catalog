<template>
  <b-card no-body class="card bg-white shadow border-0">
    <b-card-header class="bg-white">
      <div class="row">
        <div class="col">
          <h3 class="mb-0 h4">Datos de Referencias</h3>
        </div>
        <div class="col text-right">
          <b-button variant="primary" class="btn-sm" v-b-modal.addReference>Agregar</b-button>
        </div>
      </div>
    </b-card-header>
    <div>
      <div class="table-responsive">
        <table v-if="customer.customer_references != ''" class="table table-hover text-center">
          <thead class="small">
            <tr>
              <th class="text-center" scope="col">Nombre</th>
              <th class="text-center" scope="col">Apellido</th>
              <th class="text-center" scope="col">Escolaridad</th>
              <th class="text-center" scope="col">Tipo Referencia</th>
              <th class="text-center" scope="col">Parentesco</th>
            </tr>
          </thead>
          <tbody class="small">
            <tr v-for="(data, key) in customer.customer_references" :key="key">
              <td v-if="data.relationship" scope="row">{{data.customer_phone.customer.name}}</td>
              <td v-else></td>
              <td v-if="data.customer_phone" scope="row">{{data.customer_phone.customer.last_name}}</td>
              <td v-else></td>
              <td
                v-if="data.customer_phone"
                scope="row"
              >{{data.customer_phone.customer.scholarity.scholarity}}</td>
              <td v-else></td>
              <td
                v-if="data.relationship"
                scope="row"
              >{{data.relationship.reference_type.reference_type}}</td>
              <td v-else></td>
              <td v-if="data.relationship" scope="row">{{data.relationship.relationship}}</td>
              <td v-else></td>
            </tr>
          </tbody>
        </table>
        <div v-else>
          <div class="alert mb-0" role="alert">
            <strong>Aún no</strong> tiene
            <strong>Referencias</strong> relacionadas
          </div>
        </div>
      </div>
      <b-overlay :show="show" no-wrap></b-overlay>
      <add-reference></add-reference>
    </div>
  </b-card>
</template>

<script>
import addReference from "../modals/addReference";

export default {
  components: {
    addReference
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
