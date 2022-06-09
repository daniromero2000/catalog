<div class="modal fade" id="modal-assigne{{ $role->id }}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Asignar acciones al rol <b>{{ $role->name }}</b></h5>
                <button type="button" class="close" role-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="" method="post" class="form">
                @csrf
                @method('PUT')
                <div class="modal-body py-0">
                    @if (array_key_exists($role->id, $listActions))
                        @foreach ($listActions[$role->id] as $permission => $value)
                            <h4 class="mb-3"> {{ $permission }}</h4>
                            <div class="row px-4">
                                @foreach ($value as $action)
                                    <div class="px-2">
                                        <div class="custom-control custom-checkbox mb-3">
                                            <input class="custom-control-input " name="actions[]"
                                                id="{{ $permission . $action->id . $role->id }}" type="checkbox"
                                                value="{{ $action->id }}"
                                                {{ isset($actionsAttached[$role->id]) && in_array($action->id, $actionsAttached[$role->id]) ? 'checked="checked"' : '' }}>
                                            <label class="custom-control-label"
                                                for="{{ $permission . $action->id . $role->id }}">{{ $action->name }}</label>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            <hr class="my-4">
                        @endforeach
                    @else
                    <p class="alert alert-warning">No hay permisos relacionados a este rol</p>
                    @endif
                </div>
                <div class="card-footer text-right">
                    <button type="submit" class="btn btn-primary btn-sm">Actualizar</button>
                    <button type="button" class="btn btn-secondary btn-sm" role-dismiss="modal">Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>
