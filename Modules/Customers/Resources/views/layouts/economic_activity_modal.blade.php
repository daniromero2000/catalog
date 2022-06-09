<!-- The economic activity Modal -->
<div id="economicactivitymodal" class="modal fade">
  <div class="modal-dialog modal-sm  modal-dialog-centered">
    <div class="modal-content">

      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ingresa Actividad Económica</h4>
      </div>

      <div class="modal-body">
        <div class="box">
          <form action="{{ route('admin.customer-economic-activities.store') }}" method="post" class="form"
            enctype="multipart/form-data">
            <div class="box-body">
              @csrf
              <input name="customer_id" id="customer_id" class="hidden" value="{{ $customer->id }}">
              <div id="identity_type_id" class="form-group">
                <label for="economic_activity_type_id">Tipo de Actividad Económica <span
                    class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                  </div>
                  <select name="economic_activity_type_id" id="economic_activity_type_id" class="form-control" enabled>
                    @if(!empty($economic_activity_types))
                    @foreach($economic_activity_types as $economic_activity_type)
                    <option value="{{ $economic_activity_type->id }}">
                      {{ $economic_activity_type->economic_activity_type }}
                    </option>
                    @endforeach
                    @endif
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="entity_name">Nombre de Entidad <span class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-user"></i>
                  </div>
                  <input type="text" name="entity_name" id="entity_name" validation-pattern="name"
                    placeholder="Nombre de Entidad" class="form-control" value="{{ old('entity_name') }}" required>
                </div>
              </div>
              <div class="form-group">
                <label for="professions_list_id" class="">Cargo <span class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-check"></i>
                  </div>
                  <select name="professions_list_id" id="professions_list_id" class="form-control" enabled>
                    @if(!empty($professions_lists))
                    @foreach($professions_lists as $professions_list)
                    <option value="{{ $professions_list->id }}">
                      {{ $professions_list->profession }}</option>
                    @endforeach
                    @endif
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label for="start_date">Fecha de Ingreso <span class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar" aria-hidden="true"></i>
                  </div>
                  <input type="date" name="start_date" id="start_date" min="1915-01-01"
                    max="<?php $hoy=date("Y-m-d"); echo $hoy;?>" placeholder="Fecha de Ingreso" class="form-control"
                    value="{{ old('start_date') }}" required>
                </div>
              </div>
              <div class="form-group">
                <label for="incomes">Ingresos<span class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-money"></i>
                  </div>
                  <input type="text" name="incomes" id="incomes" validation-pattern="number" placeholder="Ingresos"
                    class="form-control" value="{{ old('incomes') }}" required>
                </div>
              </div>
              <div class="form-group">
                <label for="other_incomes">Otros Ingresos<span class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-money"></i>
                  </div>
                  <input type="text" name="other_incomes" id="other_incomes" validation-pattern="number"
                    placeholder="Ingresos" class="form-control" value="{{ old('other_incomes') }}" required>
                </div>
              </div>
              <div class="form-group">
                <label for="other_incomes_source">Fuente Otros Ingresos<span class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-money"></i>
                  </div>
                  <input type="text" name="other_incomes_source" validation-pattern="text" id="other_incomes_source"
                    placeholder="Ingresos" class="form-control" value="{{ old('other_incomes_source') }}" required>
                </div>
              </div>
              <div class="form-group">
                <label for="expenses">Egresos<span class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-clipboard"></i>
                  </div>
                  <input type="text" name="expenses" id="expenses" validation-pattern="text" placeholder="Egresos"
                    class="form-control" value="{{ old('expenses') }}" required>
                </div>
              </div>
              <div class="form-group">
                <label for="entity_address">Dirección Entidad<span class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-map-marker"></i>
                  </div>
                  <input type="text" name="entity_address" id="entity_address" validation-pattern="text"
                    placeholder="Dirección Entidad " class="form-control" value="{{ old('entity_address') }}" required>
                </div>
              </div>
              <div class="form-group">
                <label for="entity_phone">Teléfono Entidad<span class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-phone"></i>
                  </div>
                  <input type="text" name="entity_phone" id="entity_phone" validation-pattern="telephone"
                    placeholder="Teléfono Entidad " class="form-control" value="{{ old('entity_phone') }}" required>
                </div>
              </div>
              <div id="cities" class="form-group">
                <label for="city_id">Ciudad<span class="text-danger">*</span></label>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                  </div>
                  <select name="city_id" id="city_id" class="form-control" enabled>
                    @foreach($cities as $city)
                    <option value="{{ $city->id }}">{{ $city->city }}</option>
                    @endforeach
                  </select>
                </div>
              </div>

            </div>

            <div class="box-footer">
              <div class="btn-group">
                <button type="submit" class="btn btn-primary">Agregar</button>
              </div>
            </div>
          </form>
        </div>

      </div>

    </div>
  </div>
</div>


{{-- <template>
  <div>
    <b-form @submit.stop.prevent="onSubmit">
      <b-form-group id="example-input-group-1" label="Name" label-for="example-input-1">
        <b-form-input
          id="example-input-1"
          name="example-input-1"
          v-model="$v.form.name.$model"
          :state="validateState('name')"
          aria-describedby="input-1-live-feedback"
        ></b-form-input>

        <b-form-invalid-feedback
          id="input-1-live-feedback"
        >This is a required field and must be at least 3 characters.</b-form-invalid-feedback>
      </b-form-group>

      <b-form-group id="example-input-group-2" label="Food" label-for="example-input-2">
        <b-form-select
          id="example-input-2"
          name="example-input-2"
          v-model="$v.form.food.$model"
          :options="foods"
          :state="validateState('food')"
          aria-describedby="input-2-live-feedback"
        ></b-form-select>

        <b-form-invalid-feedback id="input-2-live-feedback">This is a required field.</b-form-invalid-feedback>
      </b-form-group>

      <b-button type="submit" variant="primary">Submit</b-button>
      <b-button class="ml-2" @click="resetForm()">Reset</b-button>
    </b-form>
  </div>
</template> --}}

{{-- <script>
import { validationMixin } from "vuelidate";
import { required, minLength } from "vuelidate/lib/validators";

export default {
  mixins: [validationMixin],
  data() {
    return {
      foods: [
        { value: null, text: "Choose..." },
        { value: "apple", text: "Apple" },
        { value: "orange", text: "Orange" }
      ],
      form: {
        name: null,
        food: null
      }
    };
  },
  validations: {
    form: {
      food: {
        required
      },
      name: {
        required,
        minLength: minLength(3)
      }
    }
  },
  methods: {
    validateState(name) {
      const { $dirty, $error } = this.$v.form[name];
      return $dirty ? !$error : null;
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
      if (this.$v.form.$anyError) {
        return;
      }

      alert("Form submitted!");
    }
  }
};
</script> --}}