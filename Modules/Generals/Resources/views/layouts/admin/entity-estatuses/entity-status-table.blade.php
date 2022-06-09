<tr>
    <td class="text-center">{{ $data->id }}</td>
    <td class="text-center">{{ $data->name }}</td>
    <td class="text-center">
        <span class="badge" style="color: #ffffff; background-color: {{ $data->color }}">
            {{ $data->color }}
        </span>
    </td>
    <td class="text-center">@include('generals::layouts.status', ['status' => $data->is_active])
    </td>
    <td class="text-center">
        @include('generals::layouts.admin.tables.table_options', [$data, 'optionsRoutes' =>
        $optionsRoutes])
    </td>
</tr>
<div class="modal fade" id="modal{{$data->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Actualizar Estado: 
                    <b>{{$data->name}}</b></h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{ route($optionsRoutes . '.update', $data->id) }}" method="post" class="form">
                @csrf
                @method('PUT')
                <div class="modal-body py-0">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="name{{ $data->id }}">Nombre</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="fa fa-font"></i></span>
                                    </div>
                                    <input type="text" name="name" id="name{{ $data->id }}" placeholder="Nombre"
                                        validation-pattern="name" class="form-control" required
                                        value="{{ old('name') ?: $data->name }}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="color">Color</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-palette"></i></span>
                                    </div>
                                    <input type="color" name="color" id="color" placeholder="Ícono"
                                        class="form-control jscolor my-colorpicker1 colorpicker-element"
                                        value="{!! $data->color ?: old('color')  !!}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="icon{{ $data->id }}">Estado</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-check"></i></span>
                                    </div>
                                    @include('generals::layouts.admin.is_active_layout', ['status'
                                    => $data->is_active])
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                    <button type="button" class="btn btn-secondary btn-sm" data-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
