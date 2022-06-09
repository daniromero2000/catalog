<template>
  <b-card no-body class="card bg-white shadow border-0">
    <div class="text-center" style=" position: absolute; top: 9px; right: 18px; ">
      <span
        class="badge"
        :style="'color: #ffffff; background-color:'+ currentStatus.color"
      >{{currentStatus.status}}</span>
    </div>
    <div class="card-body mt-4">
      <div class="text-center">
        <h5 class="h4">{{customer.name}} {{customer.last_name}}</h5>
        <div class="h5 mt-4" v-if="customer.city">
          <i class="ni business_briefcase-24 mr-2"></i>
          Ciudad de Nacimiento {{customer.city.city}}
        </div>
        <div style=" font-size: 14px; ">
          <i class="ni education_hat mr-2"></i>
          Fecha de Nacimiento {{customer.birthday}}
        </div>
      </div>

      <div class="row">
        <div class="col">
          <div class="card-profile-stats d-flex justify-content-center">
            <div>
              <span class="heading" style="font-size: 15px;">{{customer.age}}</span>
              <span class="description">Edad</span>
            </div>
            <div>
              <span
                class="heading"
                v-if="customer.genre"
                style="font-size: 15px;"
              >{{customer.genre.genre}}</span>
              <span class="heading" v-else style="font-size: 15px;">NA</span>
              <span class="description">Genero</span>
            </div>
            <div>
              <span
                class="heading"
                v-if="customer.civil_status"
                style="font-size: 15px;"
              >{{customer.civil_status.civil_status}}</span>
              <span class="description">Estado Civil</span>
            </div>
          </div>
        </div>
      </div>
      <div class="text-right">
        <a v-b-modal.addComment class="btn btn-sm bg-success">
          <i class="fas fa-comments text-white"></i>
        </a>
        <a href="#" class="btn btn-sm btn-primary">
          <i class="fas fa-user"></i> Editar
        </a>
      </div>
      <b-overlay :show="show" no-wrap></b-overlay>
    </div>

    <!-- <div class="card-body">
      <div class="row">
        <div class="col-9">
          <h2 class="lead mb-2">
            <b>{{customer.name}} {{customer.last_name}}</b>
          </h2>
          <ul class="ml-4 mb-0 fa-ul text-muted">
            <li class="small mt-2">
              <span class="fa-li">
                <i class="fas fa-lg fa-building"></i>
              </span>
              Fecha de Nacimiento: {{customer.birthday}}
            </li>
            <li v-if="customer.city" class="small mt-2">
              <span class="fa-li">
                <i class="fas fa-lg fa-phone"></i>
              </span>
              Ciudad de Nacimiento: {{customer.city.city}}
            </li>
            <li class="small mt-2">
              <span class="fa-li">
                <i class="fas fa-lg fa-phone"></i>
              </span>
              Edad: {{customer.age}}
            </li>
            <li v-if="customer.civil_status" class="small mt-2">
              <span class="fa-li">
                <i class="fas fa-lg fa-phone"></i>
              </span>
              Estado Civil: {{customer.civil_status.civil_status}}
            </li>
            <li v-if="customer.genre" class="small mt-2">
              <span class="fa-li">
                <i class="fas fa-lg fa-phone"></i>
              </span>
              Genero: {{customer.genre.genre}}
            </li>
            <li v-if="customer.scholarity" class="small mt-2">
              <span class="fa-li">
                <i class="fas fa-lg fa-phone"></i>
              </span>
              Escolaridad: {{customer.scholarity.scholarity}}
            </li>
            <li v-if="customer.customerLead" class="small mt-2">
              <span class="fa-li">
                <i class="fas fa-lg fa-phone"></i>
              </span>
              Lead: {{customer.customerLead.lead}}
            </li>
          </ul>
        </div>
        <div class="col-3 text-center">
          <span
            class="badge"
            :style="'color: #ffffff; background-color:'+ currentStatus.color"
          >{{currentStatus.status}}</span>
        </div>
      </div>
     
    </div>-->
  </b-card>
</template>

<script>
export default {
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
    },
    currentStatus() {
      return this.$store.state.currentStatus;
    }
  },
  watch: {
    customer() {
      this.show = false;
    }
  }
};
</script>
