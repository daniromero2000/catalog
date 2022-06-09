<div class="w-100">
    <div class="card">
        <div class="card-body">
            <div class="w-100 d-flex justify-content-between">
                <div class="my-auto">
                    <h6>Direcciones</h6>
                </div>
                <div class="my-auto">
                    <button type="submit" class="btn btn-sm btn-primary" data-toggle="modal"
                        data-target="#exampleModal">Agregar Dirección</button>
                </div>
            </div>
            @if(!empty($addresses->toArray()))
            <div class="table-responsive">
                <table class="table-striped table  mt-3 text-center">
                    <thead class="text-sm">
                        <th>Dirección</th>
                        <th>Dirección de facturación</th>
                        <th>Dirección de entrega</th>
                    </thead>
                    <tbody class="text-sm">
                        @foreach($addresses as $key => $address)
                        <tr>
                            <td><span id="address{{$address->id}}">
                                    {{ $address->customer_address }}
                                </span>
                                <br />
                                @if(!is_null($address->province))
                                {{ $address->city->city }} {{ $address->province->name }} <br />
                                @endif
                                <span id="city{{$address->id}}">{{ $address->city->city }}
                                    {{ $address->state_code }}</span>
                                <br>
                                {{ $address->zip }}
                            </td>
                            <td>
                                <label class="col-md-6 col-md-offset-3">
                                    <input type="radio" value="{{ $address->id }}" name="billing_address"
                                        @if($billingAddress->id ==
                                    $address->id) checked="checked" @endif>
                                </label>
                            </td>
                            <td>
                                @if($billingAddress->id == $address->id)
                                <label for="sameDeliveryAddress">
                                    <input type="checkbox" id="sameDeliveryAddress" checked="checked"> Igual
                                    que
                                    la facturación
                                </label>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                    <tbody style="display: none" id="sameDeliveryAddressRow">
                        @foreach($addresses as $key => $address)
                        <tr>
                            <td>{{ $address->alias }}</td>
                            <td>
                                {{ $address->customer_address }} <br />
                                @if(!is_null($address->province))
                                {{ $address->city->city }} {{ $address->province->name }} <br />
                                @endif
                                {{ $address->city->city }} {{ $address->state_code }} <br>
                                {{ $address->zip }}
                            </td>
                            <td></td>
                            <td>
                                <label class="col-md-6 col-md-offset-3">
                                    <input type="radio" value="{{ $address->id }}" name="delivery_address"
                                        @if(old('')==$address->id)
                                    checked="checked" @endif>
                                </label>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
            <div class="alert alert-info py-2 px-3 mt-2" role="alert">
                ¡No tienes direcciones registradas!. Por favor selecciona la opción "Agregar Dirección" para
                registrar la dirección de envío y poder continuar con el proceso de compra.
            </div>
            @endif
        </div>
    </div>
</div>
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Agregar dirección</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route('customer.address.store', $customer->id) }}" method="post" class="form"
                enctype="multipart/form-data">
                <div class="modal-body">

                    <input type="hidden" name="default_address" value="1">
                    <div class="card-body p-2">
                        @csrf
                        <div class="form-group">
                            <label for="customer_address">Dirección <span class="text-danger">*</span></label>
                            <input type="text" required name="customer_address" id="customer_address"
                                placeholder="Dirección" class="form-control" value="{{ old('customer_address') }}">
                        </div>
                        <div class="form-group">
                            <label for="country_id">País </label>
                            <select name="country_id" id="country_id" required class="form-control select2">
                                <option value="">Selecciona</option>
                                @foreach($countries as $country)
                                <option @if(env('SHOP_COUNTRY_ID')==$country->id) selected="selected" @endif
                                    value="{{ $country->id }}">{{ $country->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div id="provinces" class="form-group" style="display: none;"></div>
                        <div id="cities" class="form-group" style="display: none;"></div>
                        <div class="form-group">
                            <label for="phone">Tu Teléfono </label>
                            <input type="text" name="phone" id="phone" required placeholder="Teléfono"
                                class="form-control" value="{{ old('phone') }}">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                    <button type="submmit" class="btn btn-primary btn-sm">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
