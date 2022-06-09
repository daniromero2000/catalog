 <template>
  <div>
    <b-modal
      id="addEps"
      ref="modal"
      title="Ingresa Eps"
      @show="resetModal"
      @hidden="resetModal"
      hide-footer
      body-class="pt-0"
    >
      <form @submit.stop.prevent="onSubmit">
        <b-form-group label="Eps" label-for="eps_id-input" id>
          <b-form-select
            id="eps_id-input"
            name="eps_id"
            v-model="form.eps_id"
            :state="validateState('eps_id')"
            aria-describedby="input-eps_id"
            :options="epss"
          ></b-form-select>
          <b-form-invalid-feedback id="input-eps_id">Este campo es requerido.</b-form-invalid-feedback>
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
        eps_id: null
      }
    };
  },
  validations: {
    form: {
      eps_id: {
        required
      }
    }
  },
  created() {
    this.$store.dispatch("getEps");
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
      this.$store.dispatch("storeEps", this.form);
      this.closeModal();
    },
    closeModal() {
      this.$bvModal.hide("addEps");
      this.$store.dispatch("getCustomerForId", this.customer.id);
    }
  },
  computed: {
    customer() {
      return this.$store.state.customer;
    },
    epss() {
      let data = [];
      data.push({ value: null, text: "Seleccione", disabled: true });
      let epss = this.$store.state.epss;
      epss.forEach(e => {
        data.push({ value: e.id, text: e.eps });
      });
      return data;
    }
  }
};
</script> 
