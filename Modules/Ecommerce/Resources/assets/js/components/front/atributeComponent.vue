<template>
  <div class="w-100">
    <input
      type="hidden"
      required
      name="productAttribute"
      id="productAttribute"
    />
    <div class="w-100 justify-content-between d-flex">
      <label class="mb-2"
        ><span class="mr-auto"><b>Elige un color</b></span></label
      >
    </div>
    <div class="d-flex mb-3">
      <div v-for="(color, key) in colors" :key="key">
        <span
          class="badge badge-reset mr-2"
          v-bind:class="{
            active: colorActive == key ? true : false,
            shadow: colorActive == key ? true : false,
          }"
          v-on:click="changeColor(key)"
          v-bind:style="{
            background: color[0].color,
          }"
          >.
        </span>
      </div>
    </div>

    <div class="w-100 justify-content-between d-flex">
      <label class="mb-2" for="productAttribute"
        ><span class="mr-auto"><b>Elige tu talla</b></span></label
      >

      <a data-toggle="modal" data-target="#sizeGuide" class="text-dark" href="">
        <label class="mb-2" for="productAttribute"
          ><span class="mr-auto"><b>Ver tabla de tallas</b></span></label
        ></a
      >
    </div>
    <div class="container-sizes w-100 mb-3" id="sizes">
      <div class="d-flex" v-for="(color, key) in colors" :key="key">
        <div
          v-show="key == colorActive"
          v-for="(color_atributes, values) in color"
          :key="values"
        >
          <div
            v-for="(attributes_value,
            key2) in color_atributes.attributes_values"
            :key="key2"
          >
            <div v-if="attributes_value.attribute.name === 'Talla'">
              <div
                class="sizes"
                v-on:click="addValue(color_atributes.id)"
                :id="'sizes' + color_atributes.id"
              >
                <span class="m-auto" v-on:click="addValue(color_atributes.id)">
                  <p class="m-auto">{{ attributes_value.value }}</p>
                </span>
              </div>
            </div>
            <div v-else-if="attributes_value.attribute.name === 'Color'"></div>
            <div v-else></div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<style>
.badge-reset {
  height: 50px;
  width: 75px;
  border-radius: 9px;
  color: transparent;
}

.active {
  opacity: 0.7;
}
</style>
<script>
export default {
  props: ["product"],
  data: () => ({
    colors: [],
    colorActive: "",
  }),
  created() {
    axios.get("api/getAtributes/" + this.product).then((response) => {
      this.colors = response.data;
    });
  },
  mounted() {},
  watch: {
    colors() {
      let keys = Object.keys(this.colors);
      this.colorActive = keys[0];
    },
  },
  methods: {
    changeColor: function (key) {
      this.colorActive = key;
    },
    addValue: function (id) {
      var buttons = "";
      $('input[name="productAttribute"]').val(id);
      buttons = document.getElementById("sizes" + id);
      buttons.addEventListener("click", function () {
        var res = "";
        res = document.getElementsByClassName("sizes active");
        if (res.length > 0) {
          res[0].className = res[0].className.replace(" active", "");
        }
        this.className += " active";
      });
    },
  },
};
</script>

