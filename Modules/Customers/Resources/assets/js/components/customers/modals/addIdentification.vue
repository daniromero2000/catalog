 <template>
  <div>
    <b-modal
      id="addIdentification"
      ref="modal"
      title="Ingresa Actividad Económica"
      @show="resetModal"
      @hidden="resetModal"
      hide-footer
      body-class="pt-0"
    >
      <form @submit.stop.prevent="onSubmit">
        <b-form-group label="Tipo de identificación" label-for="identity_type_id-input" id>
          <b-form-select
            id="identity_type_id-input"
            name="identity_type_id"
            v-model="form.identity_type_id"
            :state="validateState('identity_type_id')"
            aria-describedby="input-identity_type_id"
            :options="identityTypes"
          ></b-form-select>
          <b-form-invalid-feedback id="input-identity_type_id">Este campo es requerido.</b-form-invalid-feedback>
        </b-form-group>

        <b-form-group label="Número de Documento" label-for="identity_number" id>
          <b-form-input
            id="identity_number"
            name="identity_number"
            aria-describedby="input-identity_number"
            :state="validateState('identity_number')"
            v-model="form.identity_number"
            required
          ></b-form-input>

          <b-form-invalid-feedback id="input-identity_number">Este campo es requerido.</b-form-invalid-feedback>
        </b-form-group>

        <b-form-group label="Fecha de Expedición" label-for="expedition_date" id>
          <b-input-group class="mb-3">
            <b-form-input
              id="expedition_date"
              v-model="form.expedition_date"
              type="date"
              placeholder="YYYY-MM-DD"
              :state="validateState('expedition_date')"
              autocomplete="off"
              aria-describedby="input-expedition_date"
            ></b-form-input>
            <b-input-group-append>
              <b-form-datepicker
                v-model="form.expedition_date"
                button-only
                today-button
                reset-button
                close-button
                right
                locale="en-ES"
                aria-controls="expedition_date"
              ></b-form-datepicker>
            </b-input-group-append>
            <b-form-invalid-feedback id="input-expedition_date">Este campo es requerido.</b-form-invalid-feedback>
          </b-input-group>
        </b-form-group>

        <b-form-group label="Ciudad de Expedición" label-for="city_id-input" id>
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
        identity_type_id: null,
        city_id: null,
        identity_number: null,
        expedition_date: null
      }
    };
  },
  validations: {
    form: {
      identity_type_id: {
        required
      },
      city_id: {
        required
      },
      identity_number: {
        required
      },
      expedition_date: {
        required
      }
    }
  },
  created() {
    this.$store.dispatch("getIdentityTypes");
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
      this.$store.dispatch("storeIdentification", this.form);
      this.closeModal();
    },
    closeModal() {
      this.$bvModal.hide("addIdentification");
      this.$store.dispatch("getCustomerForId", this.customer.id);
    }
  },
  computed: {
    customer() {
      return this.$store.state.customer;
    },
    identityTypes() {
      var data = [];
      data.push({ value: null, text: "Seleccione", disabled: true });
      var identityTypes = this.$store.state.identityTypes;
      identityTypes.forEach(e => {
        data.push({ value: e.id, text: e.identity_type });
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
