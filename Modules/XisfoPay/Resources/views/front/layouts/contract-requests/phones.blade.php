<!-- Phones -->
<div class="col-md-6">
    <div class="card">
        <div class="card-body">
            <div class="row align-items-center mb-3">
                <div class="col text-center">
                    <h3 class="mb-0" style="color: #1C4293"><i class="fas fa-phone-alt"></i> Teléfono(s)</h3>
                    <div class="col text-right">
                        <a href="#" data-toggle="modal" data-target="#customerPhones" class="btn btn-primary btn-sm"><i
                                class="fa fa-edit"></i>
                            Agregar teléfono</a>
                    </div>
                </div>
                <div class="modal fade" id="customerPhones" tabindex="-1" role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Agregar Teléfono</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                                <div class="modal-body py-0">
                                    <form action="{{ route('account.customer-phones.store') }}" method="POST" class="form"
                                        onsubmit="disable_button('create_button_')">
                                        <div class="modal-body py-0">
                                            @csrf
                                            <input id="customer_id" name="customer_id" value="{{ $customer->id }}" hidden>
                                            <div class="row">
                                                <div class="col-sm-12 px-0">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="phone">Teléfono<span
                                                            class="text-danger">*</span></label>
                                                        <div class="input-group input-group-merge">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                                            </div>
                                                            <input type="text" class="form-control" name="phone" id="phone" placeholder="Teléfono" required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 px-0">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="relationship_id">Tipo de teléfono<span
                                                            class="text-danger">*</span></label>
                                                        <div class="input-group input-group-merge">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fa fa-mobile-alt"></i></span>
                                                            </div>
                                                            <select name="phone_type" id="phone_type" class="form-control" onchange="prefixSelector('phone_type')" required>
                                                                <option value="Móvil" selected>Móvil</option>
                                                                <option value="Fijo">Fijo</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12 px-0" id="prefix_select" style="display: none;">
                                                    <div class="form-group">
                                                        <label class="form-control-label" for="relationship_id">Prefijo<span
                                                            class="text-danger">*</span></label>
                                                        <div class="input-group input-group-merge">
                                                            <div class="input-group-prepend">
                                                                <span class="input-group-text"><i class="fa fa-phone"></i></span>
                                                            </div>
                                                            <select name="prefix" id="prefix" class="form-control">
                                                                <option disabled selected value> -- select an option -- </option>
                                                                @foreach ($provinces as $province)
                                                                    <option class="text-between" value="{{ $province->prefix }}"> {{ $province->province }} +{{ $province->prefix }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer text-right">
                                            <button type="submit" class="btn btn-primary btn-sm" id="create_button_">Agregar</button>
                                            <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                                        </div>
                                    </form>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w-100">
                <div class="table-responsive">
                    @if($customer->customerPhones->isNotEmpty())
                    <table class="table-striped table align-items-center table-flush table-hover text-center">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" scope="col">Tipo Teléfono</th>
                                <th class="text-center" scope="col">Teléfono</th>
                                <th class="text-center" scope="col">Fecha Registro</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach ($customer->customerPhones as $customer_phone)
                            <tr>
                                <td class="text-center">{{ $customer_phone->phone_type}}
                                </td>
                                <td class="text-center">+{{ $customer_phone->prefix }} 
                                    {{ str_repeat("*", strlen($customer_phone->phone)-4) . substr($customer_phone->phone, -4) }}</td>
                                <td class="text-center">{{ $customer_phone->created_at->format('M d, Y h:i a')}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <span class="text-sm"><strong>Aún no</strong> tiene Teléfonos</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@include('xisfopay::layouts.contract_requests.phonesJS')
