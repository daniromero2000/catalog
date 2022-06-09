 <template>
  <div>
    <b-modal
      id="addProfession"
      ref="modal"
      title="Ingresa Actividad Económica"
      @show="resetModal"
      @hidden="resetModal"
      hide-footer
      body-class="pt-0"
    >
      <form @submit.stop.prevent="onSubmit">
        <b-form-group label="Tipo" label-for="professions-input" id>
          <b-form-select
            id="professions-input"
            name="professions_list_id"
            v-model="form.professions_list_id"
            :state="validateState('professions_list_id')"
            aria-describedby="input-professions"
            :options="professions"
          ></b-form-select>
          <b-form-invalid-feedback id="input-professions">Este campo es requerido.</b-form-invalid-feedback>
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
        professions_list_id: null
      }
    };
  },
  validations: {
    form: {
      professions_list_id: {
        required
      }
    }
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
      this.$store.dispatch("storeProfession", this.form);
      this.closeModal();
    },
    closeModal() {
      this.$bvModal.hide("addProfession");
      this.$store.dispatch("getCustomerForId", this.customer.id);
    }
  },
  computed: {
    customer() {
      return this.$store.state.customer;
    },
    professions() {
      var data = [];
      data.push({ value: null, text: "Seleccione", disabled: true });
      var professions = this.$store.state.professions;
      professions.forEach(e => {
        data.push({ value: e.id, text: e.profession });
      });
      return data;
    }
  }
};
</script> 
