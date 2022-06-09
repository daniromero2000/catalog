 <template>
  <div>
    <b-modal
      id="addEmail"
      ref="modal"
      title="Ingresa Email"
      @show="resetModal"
      @hidden="resetModal"
      hide-footer
      body-class="pt-0"
    >
      <form @submit.stop.prevent="onSubmit">
        <b-form-group label="Email" label-for="email" id>
          <b-form-input
            id="email"
            name="email"
            aria-describedby="input-email"
            :state="validateState('email')"
            v-model="form.email"
            required
          ></b-form-input>

          <b-form-invalid-feedback id="input-email">Este campo es requerido.</b-form-invalid-feedback>
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
        email: null
      }
    };
  },
  validations: {
    form: {
      email: {
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
      this.$store.dispatch("storeEmail", this.form);
      this.closeModal();
    },
    closeModal() {
      this.$store.dispatch("getCustomerForId", this.customer.id);
      this.$bvModal.hide("addEmail");
    }
  },
  computed: {
    customer() {
      return this.$store.state.customer;
    }
  }
};
</script> 
