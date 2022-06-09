<template>
  <div class="drag-sort-todo__wrapper">
    <div v-if="dataLocal.length > 0">
      <h2>Productos en esta categoria</h2>
      <ul class="list-group mb-2 text-sm scroll">
        <draggable v-bind="dragOptions" v-model="dataLocal" @end="saveNewSequence">
          <transition-group>
            <li
              class="list-group-item d-flex justify-content-between"
              v-for="data in dataLocal"
              :key="data.id"
              style=" min-width: 780px; "
            >
              <span style=" width: 81px; ">{{data.sku}}</span>
              <span style=" min-width: 400px; ">{{data.name}}</span>
              <span style=" min-width: 65px; ">{{data.quantity}}</span>
              <span style=" min-width: 106px; ">${{data.price}}</span>
              <span>
                <button v-if="data.is_active == 1" type="button" class="btn btn-success btn-sm">
                  <i class="fa fa-check"></i>
                </button>

                <button v-else type="button" class="btn btn-danger btn-sm">
                  <i class="fa fa-times"></i>
                </button>
              </span>
              <span>
                <a
                  :href="'/admin/products/'+data.id+'/edit'"
                  class="table-action table-action"
                  data-toggle="tooltip"
                  data-original-title="Editar"
                >
                  <i class="fas fa-user-edit"></i>
                </a>
              </span>
            </li>
          </transition-group>
        </draggable>
      </ul>
    </div>

    <div v-else>Cargando...</div>
  </div>
</template>
  <style>
@media (max-width: 900px) {
  .scroll {
    overflow: scroll;
  }
}
</style>

<script>
import draggable from "vuedraggable";

export default {
  props: ["data"],
  components: {
    draggable,
  },
  data() {
    return {
      dataLocal: [],
    };
  },
  created() {
    this.dataLocal = this.data;
  },
  methods: {
    saveNewSequence() {
      var order = "";
      this.dataLocal.forEach((data, key) => {
        order = parseInt(key) + 1;
        this.dataLocal[key].sort_order = order;
      });

      let postData = {};
      postData = this.dataLocal.map((data) => {
        return {
          sort_order: data.sort_order,
          id: data.id,
        };
      });

      axios
        .put("/admin/api/update-product-order/" + 1, postData)
        .then((response) => console.log("response", response))
        .catch((error) => console.error(error.response));
    },
  },
  computed: {
    dragOptions() {
      return {
        animation: 300,
        group: "description",
        disabled: false,
        ghostClass: "ghost",
      };
    },
  },
};
</script>
