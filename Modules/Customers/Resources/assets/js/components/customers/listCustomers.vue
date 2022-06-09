<template>
  <div class="container">
    <div class="card shadow-lg border-0">
      <div class="card-header bg-white">
        <div class="row row-reset">
          <div class="col-md-12">
            <b-button v-b-toggle.collapse-1 variant="primary" class="btn-sm">
              <i class="fas fa-filter"></i> Filtrar
            </b-button>
            <b-collapse id="collapse-1" class="mt-2">
              <b-form @submit="onSubmit">
                <b-row>
                  <b-col cols="4">
                    <b-form-group
                      id="input-group-1"
                      label-size="sm"
                      label="Buscar"
                      label-for="search"
                      description="Busca entre nombres y apellidos"
                    >
                      <b-form-input id="search" class=" form-control-sm" v-model="form.search" type="text"></b-form-input>
                    </b-form-group>
                  </b-col>
                  <b-col cols="4">
                    <b-form-group id="input-group-1" label-size="sm" label="Desde" label-for="from">
                      <b-input-group class="mb-3">
                        <b-form-input
                          id="from"
                          v-model="form.from"
                          type="text"
                          size="sm"
                          placeholder="YYYY-MM-DD"
                        ></b-form-input>
                        <b-input-group-append>
                          <b-form-datepicker
                            v-model="form.from"
                            button-only
                            size="sm"
                            right
                            locale="en-US"
                            aria-controls="from"
                          ></b-form-datepicker>
                        </b-input-group-append>
                      </b-input-group>
                    </b-form-group>
                  </b-col>
                  <b-col cols="4">
                    <b-form-group id="input-group-1" label-size="sm" label="Hasta" label-for="to">
                      <b-input-group class="mb-3">
                        <b-form-input
                          id="to"
                          v-model="form.to"
                          type="text"
                          size="sm"
                          placeholder="YYYY-MM-DD"
                        ></b-form-input>
                        <b-input-group-append   >
                          <b-form-datepicker
                            v-model="form.to"
                            button-only
                            right
                            size="sm"
                            locale="en-US"
                            aria-controls="to"
                          ></b-form-datepicker>
                        </b-input-group-append>
                      </b-input-group>
                    </b-form-group>
                  </b-col>
                  <b-col cols="12" class="d-flex justify-content-end">
                    <div>
                      <b-button type="submit" variant="primary" class="btn-sm">
                        <i class="fa fa-search"></i> Buscar
                      </b-button>
                      <b-button type="reset" variant="secondary" class="btn-sm">Restaurar</b-button>
                    </div>
                  </b-col>
                </b-row>
              </b-form>
            </b-collapse>
          </div>
        </div>
      </div>
      <div class="row row-reset">
        <div class="col-12">
          <table-customers></table-customers>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import TableCustomers from "./tables/tableListCustomers.vue";

export default {
  data() {
    return {
      form: {
        from: "",
        to: "",
        search: ""
      }
    };
  },
  components: {
    TableCustomers
  },
  methods: {
    onSubmit(evt) {
      evt.preventDefault();
      this.$store.commit("toggleBusy", true);
      this.$store.dispatch("getCustomersFiltered", this.form);
    }
  }
};
</script>
