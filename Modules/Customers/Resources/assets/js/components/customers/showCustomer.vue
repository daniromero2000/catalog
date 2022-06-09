<template>
  <div>
    <div class="nav-wrapper">
      <ul
        class="nav nav-pills nav-fill flex-column flex-md-row"
        id="tabs-icons-text"
        role="tablist"
      >
        <li class="nav-item">
          <a
            class="nav-link mb-sm-3 mb-md-0 active"
            id="tabs-icons-text-1-tab"
            data-toggle="tab"
            href="#tabs-icons-text-1"
            role="tab"
            aria-controls="tabs-icons-text-1"
            aria-selected="true"
          >
            <i class="ni ni-cloud-upload-96 mr-2"></i>Cliente
          </a>
        </li>
        <li class="nav-item">
          <a
            class="nav-link mb-sm-3 mb-md-0"
            id="tabs-icons-text-2-tab"
            data-toggle="tab"
            href="#tabs-icons-text-2"
            role="tab"
            aria-controls="tabs-icons-text-2"
            aria-selected="false"
          >
            <i class="ni ni-bell-55 mr-2"></i>Contacto
          </a>
        </li>
        <li class="nav-item">
          <a
            class="nav-link mb-sm-3 mb-md-0"
            id="tabs-icons-text-3-tab"
            data-toggle="tab"
            href="#tabs-icons-text-3"
            role="tab"
            aria-controls="tabs-icons-text-3"
            aria-selected="false"
          >
            <i class="ni ni-calendar-grid-58 mr-2"></i>Seguimiento
          </a>
        </li>
      </ul>
    </div>
    <div class="card shadow">
      <div class="card-body">
        <div class="tab-content" id="myTabContent">
          <div
            class="tab-pane fade show active"
            id="tabs-icons-text-1"
            role="tabpanel"
            aria-labelledby="tabs-icons-text-1-tab"
          >
            <b-row>
              <b-col sm="5">
                <generals></generals>
                <vehicles></vehicles>
                <professions></professions>
              </b-col>
              <b-col sm="7">
                <customer-ids></customer-ids>
                <references></references>
                <economicActivities></economicActivities>
              </b-col>
            </b-row>
          </div>
          <div
            class="tab-pane fade"
            id="tabs-icons-text-2"
            role="tabpanel"
            aria-labelledby="tabs-icons-text-2-tab"
          >
            <b-row>
              <b-col sm="5">
                <epssCustomer></epssCustomer>
                <emailCustomer></emailCustomer>
              </b-col>
              <b-col sm="7">
                <addressCustomer></addressCustomer>
                <phonesCustomer></phonesCustomer>
              </b-col>
            </b-row>
          </div>
          <div
            class="tab-pane fade"
            id="tabs-icons-text-3"
            role="tabpanel"
            aria-labelledby="tabs-icons-text-3-tab"
          >
            <b-row>
              <b-col sm="7">
                <commentaries></commentaries>
              </b-col>
              <b-col sm="5">
                <statusesLog></statusesLog>
              </b-col>
            </b-row>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import generals from "./show/generals.vue";
import customerIds from "./show/ids.vue";
import vehicles from "./show/vehicles.vue";
import professions from "./show/professions.vue";
import references from "./show/references.vue";
import economicActivities from "./show/economicActivities.vue";
import addressCustomer from "./show/address.vue";
import phonesCustomer from "./show/phones.vue";
import epssCustomer from "./show/eps.vue";
import emailCustomer from "./show/email.vue";
import commentaries from "./show/commentaries.vue";
import statusesLog from "./show/statusesLog.vue";

export default {
  props: { customerId: Number },
  components: {
    generals,
    customerIds,
    vehicles,
    professions,
    references,
    economicActivities,
    addressCustomer,
    phonesCustomer,
    epssCustomer,
    emailCustomer,
    commentaries,
    statusesLog
  },
  created() {
    this.$store.dispatch("getCustomerForId", this.customerId);
  },
  methods: {}
};
</script>
