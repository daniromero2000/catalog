 <template>
  <div>
    <b-modal
      id="addActivity"
      ref="modal"
      size="xl"
      title="Ingresa Actividad Económica"
      @show="resetModal"
      @hidden="resetModal"
      hide-footer
      body-class="pt-0"
    >
      <form @submit.stop.prevent="onSubmit">
        <b-row>
          <b-col lg="6">
            <b-form-group
              label="Tipo de Actividad Económica"
              label-for="economic-activity-input"
              id
            >
              <b-form-select
                id="economic-activity-input"
                name="economic_activity_type_id"
                v-model="$v.form.economic_activity_type_id.$model"
                :state="validateState('economic_activity_type_id')"
                aria-describedby="input-economic-activity"
                :options="economicActivities"
              ></b-form-select>

              <b-form-invalid-feedback id="input-economic-activity">Este campo es requerido.</b-form-invalid-feedback>
            </b-form-group>

            <b-form-group label="Nombre de Entidad" label-for="entity_name" id>
              <b-form-input
                id="entity_name"
                name="entity_name"
                aria-describedby="input-entity_name"
                :state="validateState('entity_name')"
                v-model="form.entity_name"
                required
              ></b-form-input>

              <b-form-invalid-feedback id="input-entity_name">Este campo es requerido.</b-form-invalid-feedback>
            </b-form-group>

            <b-form-group label="Cargo" label-for="profession-input" id>
              <b-form-select
                id="profession-input"
                name="professions_list_id"
                v-model="form.professions_list_id"
                :state="validateState('professions_list_id')"
                aria-describedby="input-profession"
                :options="professions"
              ></b-form-select>
              <b-form-invalid-feedback id="input-profession">Este campo es requerido.</b-form-invalid-feedback>
            </b-form-group>

            <b-form-group label="Fecha de Ingreso" label-for="start_date" id>
              <b-input-group class="mb-3">
                <b-form-input
                  id="start_date"
                  v-model="form.start_date"
                  type="date"
                  placeholder="YYYY-MM-DD"
                  :state="validateState('start_date')"
                  autocomplete="off"
                  aria-describedby="input-start-date"
                ></b-form-input>
                <b-input-group-append>
                  <b-form-datepicker
                    v-model="form.start_date"
                    button-only
                    today-button
                    reset-button
                    close-button
                    right
                    locale="en-ES"
                    aria-controls="start_date"
                  ></b-form-datepicker>
                </b-input-group-append>
                <b-form-invalid-feedback id="input-start-date">Este campo es requerido.</b-form-invalid-feedback>
              </b-input-group>
            </b-form-group>

            <b-form-group label="Dirección Entidad" label-for="entity_address" id>
              <b-form-input
                id="entity_address"
                name="entity_address"
                aria-describedby="input-entity_address"
                :state="validateState('entity_address')"
                v-model="form.entity_address"
                required
              ></b-form-input>

              <b-form-invalid-feedback id="input-entity_address">Este campo es requerido.</b-form-invalid-feedback>
            </b-form-group>
            <b-form-group label="Teléfono Entidad" label-for="entity_phone" id>
              <b-form-input
                id="entity_phone"
                name="entity_phone"
                aria-describedby="input-entity_phone"
                :state="validateState('entity_phone')"
                v-model="form.entity_phone"
                required
              ></b-form-input>

              <b-form-invalid-feedback id="input-entity_phone">Este campo es requerido.</b-form-invalid-feedback>
            </b-form-group>
          </b-col>

          <b-col lg="6">
            <b-form-group label="Ciudad" label-for="city_id" id>
              <b-form-select
                id="city_id"
                name="city_id"
                v-model="form.city_id"
                :state="validateState('city_id')"
                aria-describedby="input-city_id"
                :options="cities"
              ></b-form-select>
              <b-form-invalid-feedback id="input-city_id">Este campo es requerido.</b-form-invalid-feedback>
            </b-form-group>
            <b-form-group label="Ingresos" label-for="incomes" id>
              <b-form-input
                id="incomes"
                name="example-input-1"
                aria-describedby="input-incomes"
                :state="validateState('incomes')"
                v-model="form.incomes"
                required
              ></b-form-input>

              <b-form-invalid-feedback id="input-incomes">Este campo es requerido.</b-form-invalid-feedback>
            </b-form-group>

            <b-form-group label="Otros Ingresos" label-for="other_incomes" id>
              <b-form-input
                id="other_incomes"
                name="other_incomes"
                aria-describedby="input-other_incomes"
                :state="validateState('other_incomes')"
                v-model="form.other_incomes"
                required
              ></b-form-input>

              <b-form-invalid-feedback id="input-other_incomes">Este campo es requerido.</b-form-invalid-feedback>
            </b-form-group>

            <b-form-group label="Fuente Otros Ingresos" label-for="other_incomes_source" id>
              <b-form-input
                id="other_incomes_source"
                name="other_incomes_source"
                aria-describedby="input-other_incomes_source"
                :state="validateState('other_incomes_source')"
                v-model="form.other_incomes_source"
                required
              ></b-form-input>

              <b-form-invalid-feedback id="input-other_incomes_source">Este campo es requerido.</b-form-invalid-feedback>
            </b-form-group>

            <b-form-group label="Egresos" label-for="expenses" id>
              <b-form-input
                id="expenses"
                name="expenses"
                aria-describedby="input-expenses"
                :state="validateState('expenses')"
                v-model="form.expenses"
                required
              ></b-form-input>

              <b-form-invalid-feedback id="input-expenses">Este campo es requerido.</b-form-invalid-feedback>
            </b-form-group>
          </b-col>
        </b-row>

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

  // props: {
  //   // customer: Number
  // },
  data() {
    return {
      form: {
        customer_id: null,
        economic_activity_type_id: null,
        entity_name: null,
        professions_list_id: null,
        start_date: null,
        incomes: null,
        other_incomes: null,
        other_incomes_source: null,
        expenses: null,
        entity_address: null,
        entity_phone: null,
        city_id: null
      }
    };
  },
  validations: {
    form: {
      economic_activity_type_id: {
        required
      },
      entity_name: {
        required
      },
      professions_list_id: {
        required
      },
      start_date: {
        required
      },
      incomes: {
        required
        // minLength: minLength(4)
      },
      other_incomes: {
        required
      },
      other_incomes_source: {
        required
      },
      expenses: {
        required
      },
      entity_address: {
        required
      },
      entity_phone: {
        required
      },
      city_id: {
        required
      }
    }
  },
  created() {
    this.$store.dispatch("getlistEconomicActivity");
    this.$store.dispatch("getListCities");
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
      this.$store.dispatch("storeEconomicActivity", this.form);
      this.closeModal();
    },
    closeModal() {
      this.$bvModal.hide("addActivity");
      this.$store.dispatch("getCustomerForId", this.customer.id);
    }
  },
  computed: {
    customer() {
      return this.$store.state.customer;
    },
    economicActivities() {
      var data = [];
      data.push({ value: null, text: "Seleccione", disabled: true });
      var economicActivity = this.$store.state.economicActivity;
      economicActivity.forEach(e => {
        data.push({ value: e.id, text: e.economic_activity_type });
      });
      return data;
    },
    professions() {
      var data = [];
      data.push({ value: null, text: "Seleccione", disabled: true });
      var professions = this.$store.state.professions;
      professions.forEach(e => {
        data.push({ value: e.id, text: e.profession });
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
