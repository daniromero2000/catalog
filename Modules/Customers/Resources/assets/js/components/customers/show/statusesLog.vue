<template>
  <b-card no-body class="card bg-white shadow border-0">
    <b-card-header class="bg-white">
      <h3 class="mb-0">Historial</h3>
    </b-card-header>
    <div
      class="card-body"
      style=" max-height: 500px; overflow: auto; "
      v-if="customer.customer_statuses_log != ''"
    >
      <div
        class="timeline timeline-one-side"
        data-timeline-content="axis"
        data-timeline-axis-style="dashed"
        v-for="(customer_statuses, key) in customer.customer_statuses_log"
        :key="key"
      >
        <div class="timeline-block">
          <span class="timeline-step badge-success">
            <i class="fa fa-clock"></i>
          </span>
          <div class="timeline-content">
            <small class="text-muted font-weight-bold">{{customer_statuses.created_at}}</small>
            <h5 class="mt-3 mb-0">{{customer_statuses.status}}</h5>
            <p class="text-sm mt-1 mb-0" v-if="customer_statuses.employee">
              <b>Usuario:</b>
              <span style="font-weight: 700;">{{customer_statuses.employee.name}}</span>
            </p>
            <div class="mt-3 mb-3">
              <span class="badge badge-pill badge-success">
                {{customer_statuses.time_passed}} Despues de ser
                creado
              </span>
            </div>
          </div>
        </div>
      </div>
    </div>
    <b-overlay :show="show" no-wrap></b-overlay>
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
