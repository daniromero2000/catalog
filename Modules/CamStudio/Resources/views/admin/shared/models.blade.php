@if(Empty(!$models))
<div class="table-responsive">
    <table class="table-striped table align-items-center table-flush table-hover text-center">
        <thead class="thead-light ">
            <tr>
                <td class="text-left">Nombre</td>
                <td>Estado</td>
                <td>Acciones</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($models as $model)
            <tr>
                <td class="text-left">
                    {{ $model->nickname }}
                </td>
                <td>@include('generals::layouts.status', ['status' => $model->is_active])</td>
                <td class="table-actions">
                    <form action="{{ route('admin.cammodels.destroy', $model->id) }}" method="post"
                        class="form-horizontal">
                        @csrf
                        <a href="{{ route('admin.cammodels.edit', $model->id) }}" class="table-action table-action"
                            data-toggle="tooltip" data-original-title="Editar">
                            <i class="fas fa-user-edit"></i>
                        </a>
                        <button onclick="return confirm('¿Estás Seguro?')" type="submit"
                            class="table-action table-action-delete button-reset" data-toggle="tooltip"
                            data-original-title="Borrar">
                            <i class="fas fa-trash"></i>
                        </button>
                        <input type="hidden" name="_method" value="delete">
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endif
