<template>
  <div>
    <div class="table-responsive mb-0">
      <b-table
        :busy="isBusy"
        :items="dataCustomers"
        :borderless="true"
        :hover="true"
        :fields="fields"
        class="align-items-center table-flush"
        responsive
      >
        <template v-slot:table-busy>
          <div class="text-center text-primary my-2">
            <b-spinner class="align-middle"></b-spinner>
            <strong>Cargando...</strong>
          </div>
        </template>

        <template v-slot:cell(Estado)="data">
          <span>
            <b-badge :style="'color:white; background:'+data.value.color">{{ data.value.status }}</b-badge>
          </span>
        </template>
        <template v-slot:cell(Opciones)="row">
          <a class="btn btn-info btn-sm" :href="'/admin/customers/'+row.item['#']">Ver mas</a>
        </template>
      </b-table>
    </div>
    <div class="card-footer py-2">
      <nav aria-label="...">
        <ul class="pagination justify-content-end mb-0">
          <li class="page-item disabled" v-if="skip < 1">
            <a class="page-link">
              <i class="fas fa-angle-left"></i>
              <span class="sr-only">Previous</span>
            </a>
          </li>
          <li class="page-item " v-else>
            <a class="page-link" @click="previousPage">
              <i class="fas fa-angle-left"></i>
              <span class="sr-only">Previous</span>
            </a>
          </li>
          <li class="page-item active">
            <a class="page-link" v-if="skip < 1" href="#">0</a>
            <a class="page-link" v-else href="#">{{skip}}</a>
          </li>
          <li class="page-item">
            <a class="page-link" @click="nextPage">
              <i class="fas fa-angle-right"></i>
              <span class="sr-only">Next</span>
            </a>
          </li>
        </ul>
      </nav>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      localCustomers: [],
      fields: [
        { key: "#", sortable: true },
        { key: "Nombre", sortable: true },
        { key: "Apellido", sortable: true },
        { key: "Fecha de Ingreso", sortable: true },
        { key: "Lead", sortable: true },
        { key: "Estado", sortable: true },
        { key: "Opciones", sortable: false }
      ]
    };
  },
  mounted() {
    this.$store.dispatch("getCustomers");
    this.$store.commit("toggleBusy", true);
  },
  methods: {
    previousPage() {
      var skip = Number(this.skip) - 1;
      this.$store.commit("vauleSkip", skip);
      this.$store.commit("toggleBusy", true);
      this.$store.dispatch("getCustomers");
    },
    nextPage() {
      var skip = Number(this.skip) + 1;
      this.$store.commit("vauleSkip", skip);
      this.$store.commit("toggleBusy", true);
      this.$store.dispatch("getCustomers");
    }
  },
  computed: {
    isBusy() {
      return this.$store.state.isBusy;
    },
    skip() {
      return this.$store.state.skip;
    },
    customers() {
      return this.$store.state.customers;
    },
    dataCustomers() {
      var data = [];
      this.customers.forEach(element => {
        data.push({
          "#": element.id,
          Nombre: element.name,
          Apellido: element.last_name,
          ["Fecha de Ingreso"]: element.created_at,
          Lead: element.customer_channel.lead,
          Estado: {
            status: element.customer_status.status,
            color: element.customer_status.color
          }
        });
      });
      return data;
    }
  },
  watch: {
    customers() {
      this.$store.commit("toggleBusy", false);
    }
  }
};
</script>
