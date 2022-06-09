<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row align-items-center mb-3">
                <div class="col">
                    <h3 class="mb-0">Referencias</h3>
                </div>
                <div class="col text-right">
                    <a href="#" data-toggle="modal" data-target="#customerReferences" class="btn btn-primary btn-sm"><i
                            class="fa fa-edit"></i>
                        Agregar referencias</a>
                </div>
                <div class="modal fade" id="customerReferences" tabindex="-1" role="dialog"
                    aria-labelledby="modelTitleId" aria-hidden="true">
                    <div class="modal-dialog modal-sm" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Agregar Referencia</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body py-0">
                                <form action="{{ route('admin.customer-references.store') }}" method="POST" class="form"
                                    enctype="multipart/form-data" onsubmit="disable_button('create_button_')">
                                    <div class="modal-body py-0">
                                        @csrf
                                        <input id="customer_id" name="customer_id" value="{{ $customer->id }}" hidden>
                                        <div class="row">
                                            <div class="col-sm-12 px-0">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="name">Nombre</label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-font"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" name="name" id="name"
                                                            placeholder="Nombre" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 px-0">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="last_name">Apellido</label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-font"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" name="last_name"
                                                            id="last_name" placeholder="Apellido" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 px-0">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="phone">Teléfono</label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-phone"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" name="phone" id="phone"
                                                            placeholder="Teléfono" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12 px-0">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="email">Correo
                                                        electrónico</label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fas fa-at"></i></span>
                                                        </div>
                                                        <input type="text" class="form-control" name="email" id="email"
                                                            placeholder="example@example.com" required>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12 px-0">
                                                <div class="form-group">
                                                    <label class="form-control-label" for="relationship_id">Tipo de
                                                        referencia</label>
                                                    <div class="input-group input-group-merge">
                                                        <div class="input-group-prepend">
                                                            <span class="input-group-text"><i
                                                                    class="fa fa-user-tag"></i></span>
                                                        </div>
                                                        <select name="relationship_id" id="relationship_id"
                                                            class="form-control" required>
                                                            @foreach($relationships as $relationship)
                                                            <option selected="selected" value="{{ $relationship->id }}">
                                                                {{ $relationship->relationship }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer text-right">
                                        <button type="submit" class="btn btn-primary btn-sm"
                                            id="create_button_">Agregar</button>
                                        <button type="button" class="btn btn-secondary btn-sm"
                                            data-dismiss="modal">Cerrar</button>
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
                    @if($customer->customerReferences->isNotEmpty())
                    <table class="table-striped table align-items-center table-flush table-hover text-center">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" scope="col">Nombres</th>
                                <th class="text-center" scope="col">Apellidos</th>
                                <th class="text-center" scope="col">Teléfono</th>
                                <th class="text-center" scope="col">Email</th>
                                <th class="text-center" scope="col">Tipo de Contacto</th>
                                <th class="text-center" scope="col">Fecha Registro</th>
                                <th class="text-center" scope="col">Acciones</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach ($customer->customerReferences as $customer_reference)
                            <tr>
                                <td class="text-center">{{ $customer_reference->name }}</td>
                                <td class="text-center">{{ $customer_reference->last_name }}</td>
                                <td class="text-center">{{ $customer_reference->phone }}</td>
                                <td class="text-center">{{ $customer_reference->email }}</td>
                                <td class="text-center">{{ $customer_reference->relationship->relationship }}</td>
                                <td class="text-center">{{ $customer_reference->created_at->format('M d, Y h:i a') }}
                                </td>
                                <td class="text-center">
                                    <a data-toggle="modal" data-target="#referencemodal{{$customer_reference->id}}"
                                        href="" class="table-action table-action" data-toggle="tooltip"
                                        data-original-title="">
                                        <i class="fas fa-user-edit"></i></a>
                                    <a href="" class=" table-action table-action" data-toggle="tooltip"
                                        data-original-title="">
                                        <i class=""></i>
                                    </a>
                                </td>
                            </tr>
                            <!-- Modal -->
                            <div class="modal fade" id="referencemodal{{$customer_reference->id}}" tabindex="-1"
                                role="dialog" aria-labelledby="modelTitleId" aria-hidden="true">
                                <div class="modal-dialog modal-sm" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Actualizar referencia</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body py-0">
                                            <form
                                                action="{{ route('admin.customer-references.update', $customer_reference->id) }}"
                                                method="post" class="form">
                                                <div class="modal-body py-0">
                                                    @csrf
                                                    @method('PUT')
                                                    <input id="customer_id" name="customer_id"
                                                        value="{{ $customer_reference->customer_id }}" hidden>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label"
                                                                    for="name">Nombre</label>
                                                                <div class="input-group input-group-merge">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i
                                                                                class="fas fa-user"></i></span>
                                                                    </div>
                                                                    <input type="text" class="form-control" name="name"
                                                                        id="name" placeholder="" required
                                                                        value="{{$customer_reference->name}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label"
                                                                    for="last_name">Apellido</label>
                                                                <div class="input-group input-group-merge">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i
                                                                                class="fas fa-user-plus"></i></span>
                                                                    </div>
                                                                    <input type="text" class="form-control"
                                                                        name="last_name" id="last_name" placeholder=""
                                                                        required
                                                                        value="{{$customer_reference->last_name}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label"
                                                                    for="phone">Teléfono</label>
                                                                <div class="input-group input-group-merge">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i
                                                                                class="fas fa-phone"></i></span>
                                                                    </div>
                                                                    <input type="text" class="form-control" name="phone"
                                                                        id="phone" placeholder="" required
                                                                        value="{{$customer_reference->phone}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label" for="email">Correo
                                                                    electrónico</label>
                                                                <div class="input-group input-group-merge">
                                                                    <div class="input-group-prepend">
                                                                        <span class="input-group-text"><i
                                                                                class="fas fa-at"></i></span>
                                                                    </div>
                                                                    <input type="text" class="form-control" name="email"
                                                                        id="email" placeholder="" required
                                                                        value="{{$customer_reference->email}}">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-sm-12">
                                                            <div class="form-group">
                                                                <label class="form-control-label"
                                                                    for="relationship_id">Tipo de referencia</label>
                                                                <div class="input-group">
                                                                    <select name="relationship_id" id="relationship_id"
                                                                        class="form-control" required
                                                                        value="{{$customer_reference->relationship->relationship}}">
                                                                        @foreach($relationships as $relationship)
                                                                        @if($customer_reference->relationship->id ==
                                                                        $relationship->id)
                                                                        <option selected="selected"
                                                                            value="{{ $relationship->id }}">
                                                                            {{ $relationship->relationship }}</option>
                                                                        @else
                                                                        <option
                                                                            value="{{ $relationship->id }}">
                                                                            {{ $relationship->relationship }}</option>
                                                                        @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-footer text-right">
                                                    <button type="submit"
                                                        class="btn btn-primary btn-sm">Actualizar</button>
                                                    <button type="button" class="btn btn-secondary btn-sm"
                                                        data-dismiss="modal">Cerrar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </tbody>
                    </table>
                    @else
                    <span class="text-sm"><strong>Aún no</strong> tiene referencias</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
