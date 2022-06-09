 <template>
  <div>
    <b-modal
      id="addAddress"
      ref="modal"
      title="Ingresa dirección"
      @show="resetModal"
      @hidden="resetModal"
      hide-footer
      body-class="pt-0"
    >
      <form @submit.stop.prevent="onSubmit">
        <b-form-group label="Tipo Vivienda" label-for="housing_id-input" id>
          <b-form-select
            id="housing_id-input"
            name="housing_id"
            v-model="form.housing_id"
            :state="validateState('housing_id')"
            aria-describedby="input-housing_id"
            :options="housings"
          ></b-form-select>
          <b-form-invalid-feedback id="input-housing_id">Este campo es requerido.</b-form-invalid-feedback>
        </b-form-group>

        <b-form-group label="Antiguedad" label-for="time_living" id>
          <b-form-input
            id="time_living"
            name="time_living"
            aria-describedby="input-time_living"
            :state="validateState('time_living')"
            v-model="form.time_living"
            required
          ></b-form-input>

          <b-form-invalid-feedback id="input-time_living">Este campo es requerido.</b-form-invalid-feedback>
        </b-form-group>

        <b-form-group label="Dirección" label-for="customer_address" id>
          <b-form-input
            id="customer_address"
            name="customer_address"
            aria-describedby="input-customer_address"
            :state="validateState('customer_address')"
            v-model="form.customer_address"
            required
          ></b-form-input>

          <b-form-invalid-feedback id="input-customer_address">Este campo es requerido.</b-form-invalid-feedback>
        </b-form-group>

        <b-form-group label="Estrato Socioeconómico" label-for="stratum_id-input" id>
          <b-form-select
            id="stratum_id-input"
            name="stratum_id"
            v-model="form.stratum_id"
            :state="validateState('stratum_id')"
            aria-describedby="input-stratum_id"
            :options="stratums"
          ></b-form-select>
          <b-form-invalid-feedback id="input-stratum_id">Este campo es requerido.</b-form-invalid-feedback>
        </b-form-group>

        <b-form-group label="Ciudad de ubucación" label-for="city_id-input" id>
          <b-form-select
            id="city_id-input"
            name="city_id"
            v-model="form.city_id"
            :state="validateState('city_id')"
            aria-describedby="input-city_id"
            :options="cities"
          ></b-form-select>
          <b-form-invalid-feedback id="input-city_id">Este campo es requerido.</b-form-invalid-feedback>
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
        housing_id: null,
        time_living: null,
        customer_address: null,
        stratum_id: null,
        city_id: null
      }
    };
  },
  validations: {
    form: {
      housing_id: {
        required
      },
      time_living: {
        required
      },
      customer_address: {
        required
      },
      stratum_id: {
        required
      },
      city_id: {
        required
      }
    }
  },
  created() {
    this.$store.dispatch("getHousings");
    this.$store.dispatch("getStratums");
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
    resetForm() {
      this.form = {
        name: null,
        food: null
      };

      this.$nextTick(() => {
        this.$v.$reset();
      });
    },
    onSubmit() {
      this.$v.form.$touch();
      this.form.customer_id = this.customer.id;
      if (this.$v.form.$anyError) {
        return;
      }
      this.$store.dispatch("storeAddress", this.form);
      this.closeModal();
    },
    closeModal() {
      this.$bvModal.hide("addAddress");
      this.$store.dispatch("getCustomerForId", this.customer.id);
    }
  },
  computed: {
    customer() {
      return this.$store.state.customer;
    },
    housings() {
      var data = [];
      data.push({ value: null, text: "Seleccione", disabled: true });
      var housings = this.$store.state.housings;
      housings.forEach(e => {
        data.push({ value: e.id, text: e.housing });
      });
      return data;
    },
    stratums() {
      var data = [];
      data.push({ value: null, text: "Seleccione", disabled: true });
      var stratums = this.$store.state.stratums;
      stratums.forEach(e => {
        data.push({ value: e.id, text: e.description });
      });
      return data;
    },
    cities() {
      var data = [];
      data.push({ value: null, text: "Seleccione", disabled: true });
      var cities = this.$store.state.cities;
      cities.forEach(e => {
        data.push({ value: e.id, text: e.city });
      });
      return data;
    }
  }
};
</script> 
