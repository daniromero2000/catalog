 <template>
  <div>
    <b-modal
      id="addReference"
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
            <b-form-group label="Nombre" label-for="name" id>
              <b-form-input
                id="name"
                name="name"
                aria-describedby="input-name"
                :state="validateState('name')"
                v-model="form.name"
                required
              ></b-form-input>

              <b-form-invalid-feedback id="input-name">Este campo es requerido.</b-form-invalid-feedback>
            </b-form-group>

            <b-form-group label="Apellido" label-for="last_name" id>
              <b-form-input
                id="last_name"
                name="last_name"
                aria-describedby="input-last_name"
                :state="validateState('last_name')"
                v-model="form.last_name"
                required
              ></b-form-input>

              <b-form-invalid-feedback id="input-last_name">Este campo es requerido.</b-form-invalid-feedback>
            </b-form-group>

            <b-form-group label="Teléfono" label-for="phone" id>
              <b-form-input
                id="phone"
                name="phone"
                aria-describedby="input-phone"
                :state="validateState('phone')"
                v-model="form.phone"
                required
              ></b-form-input>

              <b-form-invalid-feedback id="input-phone">Este campo es requerido.</b-form-invalid-feedback>
            </b-form-group>

            <b-form-group label="Fecha de Nacimiento" label-for="birthday" id>
              <b-input-group class="mb-3">
                <b-form-input
                  id="birthday"
                  v-model="form.birthday"
                  type="date"
                  placeholder="YYYY-MM-DD"
                  :state="validateState('birthday')"
                  autocomplete="off"
                  aria-describedby="input-start-date"
                ></b-form-input>
                <b-input-group-append>
                  <b-form-datepicker
                    v-model="form.birthday"
                    button-only
                    today-button
                    reset-button
                    close-button
                    right
                    locale="en-ES"
                    aria-controls="birthday"
                  ></b-form-datepicker>
                </b-input-group-append>
                <b-form-invalid-feedback id="input-start-date">Este campo es requerido.</b-form-invalid-feedback>
              </b-input-group>
            </b-form-group>
            <b-form-group label="Escolaridad" label-for="scholarities-input" id>
              <b-form-select
                id="scholarities-input"
                name="scholarity_id"
                v-model="form.scholarity_id"
                :state="validateState('scholarity_id')"
                aria-describedby="input-scholarities"
                :options="scholarities"
              ></b-form-select>
              <b-form-invalid-feedback id="input-scholarities">Este campo es requerido.</b-form-invalid-feedback>
            </b-form-group>
          </b-col>

          <b-col lg="6">
            <b-form-group label="Estado Civil" label-for="civil-input" id>
              <b-form-select
                id="civil-input"
                name="civil_status_id"
                v-model="form.civil_status_id"
                :state="validateState('civil_status_id')"
                aria-describedby="input-civil"
                :options="civilStatuses"
              ></b-form-select>
              <b-form-invalid-feedback id="input-civil">Este campo es requerido.</b-form-invalid-feedback>
            </b-form-group>

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
            <b-form-group label="Parentesco" label-for="city_id" id>
              <b-form-select
                id="relationship_id"
                name="relationship_id"
                v-model="form.relationship_id"
                :state="validateState('relationship_id')"
                aria-describedby="input-relationship_id"
                :options="relationships"
              ></b-form-select>
              <b-form-invalid-feedback id="input-relationship_id">Este campo es requerido.</b-form-invalid-feedback>
            </b-form-group>

            <b-form-group label="Genero" label-for="city_id" id>
              <b-form-select
                id="genre_id"
                name="genre_id"
                v-model="form.genre_id"
                :state="validateState('genre_id')"
                aria-describedby="input-genre_id"
                :options="genres"
              ></b-form-select>
              <b-form-invalid-feedback id="input-genre_id">Este campo es requerido.</b-form-invalid-feedback>
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
  data() {
    return {
      form: {
        customer_id: null,
        name: null,
        last_name: null,
        phone: null,
        birthday: null,
        scholarity_id: null,
        genre_id: null,
        civil_status_id: null,
        relationship_id: null,
        city_id: null
      }
    };
  },
  validations: {
    form: {
      name: {
        required
      },
      last_name: {
        required
      },
      scholarity_id: {
        required
      },
      civil_status_id: {
        required
      },
      birthday: {
        required
      },
      phone: {
        required
      },
      city_id: {
        required
      },
      relationship_id: {
        required
      },
      genre_id: {
        required
      }
    }
  },
  created() {
    this.$store.dispatch("getRelationships");
    this.$store.dispatch("getCivilStatuses");
    this.$store.dispatch("getGenres");
    this.$store.dispatch("getScholarities");
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
      this.$store.dispatch("storeReference", this.form);
      this.closeModal();
    },
    closeModal() {
      this.$bvModal.hide("addReference");
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
    },
    relationships() {
      var data = [];
      data.push({ value: null, text: "Seleccione", disabled: true });
      var relationships = this.$store.state.relationships;
      relationships.forEach(e => {
        data.push({ value: e.id, text: e.relationship });
      });
      return data;
    },
    civilStatuses() {
      var data = [];
      data.push({ value: null, text: "Seleccione", disabled: true });
      var civilStatuses = this.$store.state.civilStatuses;
      civilStatuses.forEach(e => {
        data.push({ value: e.id, text: e.civil_status });
      });
      return data;
    },
    genres() {
      var data = [];
      data.push({ value: null, text: "Seleccione", disabled: true });
      var genres = this.$store.state.genres;
      genres.forEach(e => {
        data.push({ value: e.id, text: e.genre });
      });
      return data;
    },
    scholarities() {
      var data = [];
      data.push({ value: null, text: "Seleccione", disabled: true });
      var scholarities = this.$store.state.scholarities;
      scholarities.forEach(e => {
        data.push({ value: e.id, text: e.scholarity });
      });
      return data;
    }
  }
};
</script> 
