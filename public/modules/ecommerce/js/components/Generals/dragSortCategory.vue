<template>
  <div class="drag-sort-todo__wrapper">
    <div v-if="dataLocal.length > 0">
      <!-- <ul class="list-group mb-2 text-sm scroll">
        <draggable v-model="dataLocal">
          <transition-group>
            <li
              class="list-group-item d-flex justify-content-between"
              v-for="data in dataLocal"
              :key="data.id"
              style=" min-width: 720px; "
            >
              <span style=" width: 81px; ">{{data.sku}}</span>
              <span style=" min-width: 353px; ">{{data.name}}</span>
              <span style=" min-width: 65px; ">{{data.quantity}}</span>
              <span style=" min-width: 106px; ">${{data.price}}</span>
              <span></span>
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
      </ul>-->
      <div class="table-responsive">
        <table class="table table-striped text-center">
          <thead class="thead-light">
            <tr>
              <td class="text-center">Nombre</td>
              <td class="text-center">Estado</td>
              <td class="text-center">Acciones</td>
            </tr>
          </thead>
          <draggable v-bind="dragOptions" v-model="dataLocal" tag="tbody" @end="saveNewSequence">
            <tr v-for="item in dataLocal" :key="item.name">
              <td>
                <a :href="'/admin/categories/'+ item.id + ''">{{ item.name }}</a>
              </td>
              <td>
                <button v-if="item.is_active == 1" type="button" class="btn btn-success btn-sm">
                  <i class="fa fa-check"></i>
                </button>

                <button v-else type="button" class="btn btn-danger btn-sm">
                  <i class="fa fa-times"></i>
                </button>
              </td>
              <td>
                <a
                  :href="'/admin/categories/'+item.id+'/edit'"
                  class="table-action table-action"
                  data-toggle="tooltip"
                  data-original-title="Editar"
                >
                  <i class="fas fa-user-edit"></i>
                </a>
              </td>
            </tr>
          </draggable>
        </table>
      </div>
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
.flip-list-move {
  transition: transform 0.5s;
}
.no-move {
  transition: transform 0s;
}
.ghost {
  opacity: 0.5;
  background: #c8ebfb;
}
.list-group {
  min-height: 20px;
}
.list-group-item {
  cursor: move;
}
.list-group-item i {
  cursor: pointer;
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
        .put("/admin/api/update-category-order/" + 1, postData)
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
