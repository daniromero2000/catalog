<template>
  <div>
    <div
      class="modal fade"
      :id="'editCustomer'+localItem.id"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog text-left" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel">Editar Cliente</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">×</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="pr-3">
              <div class="row row-reset">
                <div class="col-12">
                  <div class="row">
                    <div class="col-12 col-sm-6 mt-4 pr-0">
                      <label for="name">
                        Nombre
                        <span class="text-danger">*</span>
                      </label>
                      <input
                        type="text"
                        name="name"
                        :id="'name'+localItem.id"
                        validation-pattern="name"
                        placeholder="Nombre"
                        class="form-control"
                        required
                        v-model="localItem.name"
                      />
                    </div>
                    <div class="col-12 col-sm-6 mt-4 pr-0">
                      <label for="last_name">
                        Apellido
                        <span class="text-danger">*</span>
                      </label>
                      <input
                        type="text"
                        name="last_name"
                        :id="'last_name'+localItem.id"
                        validation-pattern="name"
                        placeholder="Apellido"
                        class="form-control"
                        v-model="localItem.last_name"
                        required
                      />
                    </div>
                    <div class="col-12 col-sm-6 mt-4 pr-0">
                      <label for="city_id">
                        Ciudad de Nacimiento
                        <span class="text-danger">*</span>
                      </label>
                      <select
                        name="city_id"
                        :id="'city_id'+localItem.id"
                        v-model="localItem.city_id"
                        class="form-control select2"
                      >
                        <option
                          v-for="(city, key) in cities"
                          :key="key"
                          :value="city.id"
                        >{{ city.city }}</option>
                      </select>
                    </div>
                    <div class="col-12 col-sm-6 mt-4 pr-0">
                      <label for="scholarity_id">
                        Escolaridad
                        <span class="text-danger">*</span>
                      </label>
                      <select
                        name="scholarity_id"
                        :id="'scholarity_id'+localItem.id"
                        v-model="localItem.scholarity_id"
                        class="form-control select2"
                      >
                        <option
                          v-for="(scholarity, key) in scholarities"
                          :key="key"
                          :value="scholarity.id"
                        >{{ scholarity.scholarity }}</option>
                      </select>
                    </div>
                    <div class="col-12 col-sm-6 mt-4 pr-0">
                      <label for="customer_status_id">
                        Estado
                        <span class="text-danger">*</span>
                      </label>
                      <select
                        name="customer_status_id"
                        :id="'customer_status_id'+localItem.id"
                        v-model="localItem.customer_status_id"
                        class="form-control select2"
                      >
                        <option
                          v-for="(status, key) in statuses"
                          :key="key"
                          :value="status.id"
                        >{{ status.status }}</option>
                      </select>
                    </div>
                    <div class="col-12 col-sm-6 mt-4 pr-0">
                      <label for="customer_channel_id">
                        Estado
                        <span class="text-danger">*</span>
                      </label>
                      <select
                        name="customer_channel_id"
                        :id="'customer_channel_id'+localItem.id"
                        v-model="localItem.customer_channel_id"
                        class="form-control select2"
                      >
                        <option
                          v-for="(lead, key) in customer_channels"
                          :key="key"
                          :value="lead.id"
                        >{{ lead.lead }}</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group mt-5 mb-0 text-right">
                    <button @click="handleAddButton" class="btn btn-primary">Actualizar</button>
                    <button
                      type="button"
                      class="btn btn-danger"
                      data-dismiss="modal"
                      aria-label="Close"
                    >
                      <span aria-hidden="true">Cerrar</span>
                    </button>
                  </div>
                  <input
                    type="hidden"
                    name="status"
                    :id="'status'+localItem.id"
                    v-model="localItem.status"
                    class="form-control"
                    value="1"
                  />
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["item", "cities", "scholarities", "statuses", "customer_channels"],
  created() {
    this.localItem = this.item;
  },
  data() {
    return {
      localItem: ""
    };
  },
  methods: {
    handleAddButton() {
      this.$emit("addCustomerEvent", this.localItem);
      this.$modal.hide("editCustomer" + localItem.id);
    }
  }
};
</script>