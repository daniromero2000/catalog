 <template>
  <div>
    <b-modal
      id="addPhone"
      ref="modal"
      title="Ingresa Teléfono"
      @show="resetModal"
      @hidden="resetModal"
      hide-footer
      body-class="pt-0"
    >
      <form @submit.stop.prevent="onSubmit">
        <b-form-group label="Tipo Teléfono" label-for="phone_type-input" id>
          <b-form-select
            id="phone_type-input"
            name="phone_type"
            v-model="form.phone_type"
            :state="validateState('phone_type')"
            aria-describedby="input-phone_type"
            :options="options"
          ></b-form-select>
          <b-form-invalid-feedback id="input-phone_type">Este campo es requerido.</b-form-invalid-feedback>
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
        phone_type: null,
        phone: null
      },
      options: [
        { value: null, text: "Seleccione" },
        { value: "Fijo", text: "Fijo" },
        { value: "Móvil", text: "Móvil" }
      ]
    };
  },
  validations: {
    form: {
      phone_type: {
        required
      },
      phone: {
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
    resetForm() {
      this.form = {
        name: null
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
      this.$store.dispatch("storePhone", this.form);
      this.closeModal();
    },
    closeModal() {
      this.$bvModal.hide("addPhone");
    }
  },
  computed: {
    customer() {
      return this.$store.state.customer;
    }
  }
};
</script> 
