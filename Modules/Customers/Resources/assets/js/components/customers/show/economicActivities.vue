<template>
  <b-card no-body class="card bg-white shadow border-0">
    <b-card-header class="bg-white">
      <div class="row">
        <div class="col">
          <h3 class="mb-0 h4">Actividades Económicas</h3>
        </div>
        <div class="col text-right">
          <b-button variant="primary" class="btn-sm" v-b-modal.addActivity>Agregar</b-button>
        </div>
      </div>
    </b-card-header>
    <div>
      <div class="table-responsive">
        <table
          v-if="customer.customer_economic_activities != ''"
          class="table table-hover text-center"
        >
          <thead class="small">
            <tr>
              <th class="text-center" scope="col">Tipo Actividad</th>
              <th class="text-center" scope="col">Nombre Entidad</th>
              <th class="text-center" scope="col">Cargo</th>
              <th class="text-center" scope="col">Dirección Entidad</th>
              <th class="text-center" scope="col">Teléfono Entidad</th>
              <th class="text-center" scope="col">Ciudad</th>
            </tr>
          </thead>
          <tbody class="small">
            <tr v-for="(data, key) in customer.customer_economic_activities" :key="key">
              <td
                v-if="data.economic_activity_type"
                scope="row"
              >{{data.economic_activity_type.economic_activity_type}}</td>
              <td v-else></td>
              <td scope="row">{{data.entity_name}}</td>
              <td v-if="data.professions_list" scope="row">{{data.professions_list.profession}}</td>
              <td v-else></td>
              <td scope="row">{{data.entity_address}}</td>
              <td scope="row">{{data.entity_phone}}</td>
              <td v-if="data.city" scope="row">{{data.city.city}}</td>
              <td v-else></td>
            </tr>
          </tbody>
        </table>
        <div v-else>
          <div class="alert mb-0" role="alert">
            <strong>Aún no</strong> tiene
            <strong>Actividades Económicas</strong> relacionadas
          </div>
        </div>
      </div>
      <b-overlay :show="show" no-wrap></b-overlay>
      <add-modal></add-modal>
    </div>
  </b-card>
</template>

<script>
import addModal from "../modals/addEconomicActivity";

export default {
  components: {
    addModal
  },
  data() {
    return {
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
