@if(!$productAttributes->isEmpty())
<p class="alert alert-info">Solo puede establecer 1 combinación como predeterminada</p>
<ul class="list-unstyled">
    <li>
        <div class="table-responsive">
            <table class="table-striped table align-items-center table-flush table-hover">
                <thead class="thead-light text-center">
                    <tr>
                        <th>Cantidad</th>
                        <th>Precio Normal</th>
                        <th>Precio oferta</th>
                        <th>Atributos</th>
                        <th>Por Defecto?</th>
                        <th>Remover</th>
                    </tr>
                </thead>
                <tbody class="text-center">
                    @foreach($productAttributes as $pa)
                    <tr>
                        <td>{{ $pa->quantity }}</td>
                        <td>${{ number_format($pa->price, 0) }}</td>
                        <td>${{ number_format($pa->sale_price,0) }}</td>
                        <td>
                            <ul class="list-unstyled">
                                @foreach($pa->attributesValues as $item)
                                <li>{{ $item->attribute->name }} : {{ $item->value }}</li>
                                @endforeach
                            </ul>
                        </td>
                        <td>
                            @if($pa->default == 1)
                            <button class="btn btn-sm btn-success"><i class="fa fa-check"></i></button>
                            @else
                            <button class="btn btn-sm btn-danger"><i class="fas fa-times"></i></button>
                            @endif
                        </td>
                        <td class="table-actions">
                            <a data-toggle="modal" data-target="#product-attribute{{$pa->id}}" href=""
                                class="table-action table-action" data-toggle="tooltip" data-original-title="Editar">
                                <i class="fas fa-user-edit"></i></a>

                            <a onclick="return confirm('¿Estás Seguro?')"
                                href="{{ route('admin.products.edit', [$product->id, 'combination' => 1, 'delete' => 1, 'pa' => $pa->id]) }}"
                                class="table-action table-action-delete button-reset" data-toggle="tooltip"
                                data-original-title="Borrar">
                                <i class="fas fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                    <!-- Modal -->
                    <div class="modal fade" id="product-attribute{{$pa->id}}" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Editar
                                        combinación {{$pa->id}}</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <form action="{{ route('admin.products.update', $product->id) }}" method="post"
                                    class="form" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="_method" value="put">
                                    <div class="modal-body">

                                        <div class="form-group text-left">
                                            <div class="row">
                                                @foreach($attributes as $attribute)

                                                <div class="col-sm-6">
                                                    <div class="custom-control custom-checkbox mb-3">
                                                        <input class="custom-control-input pAattribute"
                                                            name="pAattribute[]"
                                                            id="pAattribute{{$pa->id}}{{ $attribute->id }}"
                                                            type="checkbox"
                                                            onclick="inputActive({{$pa->id}}{{ $attribute->id }})"
                                                            value="{{ $attribute->id }}">
                                                        <label class="custom-control-label"
                                                            for="pAattribute{{$pa->id}}{{ $attribute->id }}">{{ $attribute->name }}</label>
                                                    </div>
                                                    {{$pa->attributes_value}}
                                                    <label for="pAattributeValue{{$pa->id}}{{ $attribute->id }}"
                                                        style="display: none; visibility: hidden"></label>
                                                    @if(!$attribute->values->isEmpty())
                                                    <select name="pAattributeValue[]"
                                                        id="pAattributeValue{{$pa->id}}{{$attribute->id }}"
                                                        class="form-control select2" style="width: 100%" disabled>
                                                        @foreach($attribute->values as $attr)
                                                        @php $data = ''; foreach ($pa->attributesValues as $key =>
                                                        $value) {
                                                        $value->value == $attr->value ? $data = $attr->value : '';
                                                        }
                                                        @endphp
                                                        <option value="{{ $attr->id }}"
                                                            {{$data == $attr->value ? 'selected' : '' }}>
                                                            {{ $attr->value }}</option>
                                                        @endforeach
                                                    </select>
                                                    @endif
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="row">

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="pAQuantity" class="form-control-label">Cantidad
                                                        <span class="text text-danger">*</span></label>
                                                    <input type="text" name="pAQuantity" id="pAQuantity"
                                                        class="form-control"
                                                        value="{!! $pa->quantity ?: old('quantity')  !!}">
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="pAPrice" class="form-control-label">Precio
                                                        Normal</label>
                                                    <div class="input-group">
                                                        <input type="text" name="pAPrice" id="pAPrice"
                                                            class="form-control"
                                                            value="{!! $pa->price ?: old('price')  !!}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="pASalePrice" class="form-control-label">Precio
                                                        Oferta</label>
                                                    <div class="input-group">
                                                        <input type="text" name="pASalePrice" id="pASalePrice"
                                                            class="form-control"
                                                            value="{!! $pa->sale_price ?: old('sale_price')  !!}">
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="attributeId" value="{{$pa->id}}">
                                        </div>
                                        <div class="card-footer text-right">
                                            <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                                            <button type="button" class="btn btn-secondary btn-sm"
                                                data-dismiss="modal">Cerrar</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </li>
</ul>
@else
<p class="alert alert-warning">No hay combinaciones aún.</p>
@endif
