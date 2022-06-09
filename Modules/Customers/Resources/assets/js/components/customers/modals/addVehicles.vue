 <template>
  <div>
    <b-modal
      id="addVehicle"
      ref="modal"
      title="Ingresa Actividad Económica"
      @show="resetModal"
      @hidden="resetModal"
      hide-footer
      body-class="pt-0"
    >
      <form @submit.stop.prevent="onSubmit">
        <b-form-group label="Tipo" label-for="vehicle_type_id-input" id>
          <b-form-select
            id="vehicle_type_id-input"
            name="vehicle_type_id"
            v-model="form.vehicle_type_id"
            :state="validateState('vehicle_type_id')"
            aria-describedby="input-vehicle_type_id"
            :options="vehicleTypes"
          ></b-form-select>
          <b-form-invalid-feedback id="input-vehicle_type_id">Este campo es requerido.</b-form-invalid-feedback>
        </b-form-group>

        <b-form-group label="Marca" label-for="vehicle_brand_id-input" id>
          <b-form-select
            id="vehicle_brand_id-input"
            name="vehicle_brand_id"
            v-model="form.vehicle_brand_id"
            :state="validateState('vehicle_brand_id')"
            aria-describedby="input-vehicle_brand_id"
            :options="vehicleBrands"
          ></b-form-select>
          <b-form-invalid-feedback id="input-vehicle_brand_id">Este campo es requerido.</b-form-invalid-feedback>
        </b-form-group>

        <div class="py-2 text-right">
          <b-button size="sm" @click="closeModal()">Cancelar</b-button>
          <b-button size="sm" variant="primary" @click="onSubmit">Agregar</b-button>
        </div>
      </form>
    </b-modal>
  </div>
</template>     

<script>
import { validationMixin } from "vuelidate";
import { required, minLength } from "vuelidate/lib/validators";
export default {
  mixins: [validationMixin],
  data() {
    return {
      form: {
        customer_id: null,
        vehicle_type_id: null,
        vehicle_brand_id: null
      }
    };
  },
  validations: {
    form: {
      vehicle_type_id: {
        required
      },
      vehicle_brand_id: {
        required
      }
    }
  },
  created() {
    this.$store.dispatch("getVehicles");
  },
  methods: {
    validateState(name) {
      const { $dirty, $error } = this.$v.form[name];
      return $dirty ? !$error : null;
    },
    resetModal() {
      this.name = "";
      this.nameState = null;
    },
    onSubmit() {
      this.$v.form.$touch();
      this.form.customer_id = this.customer.id;
      if (this.$v.form.$anyError) {
        return;
      }
      this.$store.dispatch("storeVehicle", this.form);
      this.closeModal();
    },
    closeModal() {
      this.$bvModal.hide("addVehicle");
      this.$store.dispatch("getCustomerForId", this.customer.id);
    }
  },
  computed: {
    customer() {
      return this.$store.state.customer;
    },
    vehicleTypes() {
      var data = [];
      data.push({ value: null, text: "Seleccione", disabled: true });
      var vehicleTypes = this.$store.state.vehicleTypes;
      vehicleTypes.forEach(e => {
        data.push({ value: e.id, text: e.vehicle_type });
      });
      return data;
    },
    vehicleBrands() {
      var data = [];
      data.push({ value: null, text: "Seleccione", disabled: true });
      var vehicleBrands = this.$store.state.vehicleBrands;
      vehicleBrands.forEach(e => {
        data.push({ value: e.id, text: e.vehicle_brand });
      });
      return data;
    }
  }
};
</script> 
