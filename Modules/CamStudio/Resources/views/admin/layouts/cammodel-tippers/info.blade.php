<div class="card-body pt-0 px-3">
    <div class="row">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-header d-flex">
                    <div class="col">
                        <span class="h4">
                            Información básica
                        </span>
                    </div>
                    <div class="col text-right">
                        <button type="button" class="btn btn-primary btn-sm text-white" data-toggle="modal"
                            data-target="#modal{{ $cammodelTipper->id }}">
                            <span>
                                <i class="fas fa-edit"></i>
                                Editar Tipper
                            </span>
                        </button>
                    </div>
                </div>
                <div class="table text-center">
                    <table class="table">
                        <thead class="thead-light">
                            <tr>
                                <th>Nombre</th>
                                <th>Apodos</th>
                                <th>Plataforma</th>
                                <th>Cumpleaños</th>
                                <th>Ubicación</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $cammodelTipper->profile }}</td>
                                <td>{{ $cammodelTipper->nickname }}</td>
                                <td>{{ $cammodelTipper->streaming->streaming }}</td>
                                <td>{{ $cammodelTipper->birthday }}</td>
                                <td>{{ $cammodelTipper->location }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header">
                    <span class="h4">
                        Gustos
                    </span>
                </div>
                <div class="card-body">
                    <span class="text-sm">
                        {{ $cammodelTipper->pleasures }}
                    </span>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header">
                    <span class="h4">
                        Observaciones
                    </span>
                </div>
                <div class="card-body">
                    <span class="text-sm">
                        {{ $cammodelTipper->observations }}
                    </span>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card">
                <div class="card-header">
                    <span class="h4">
                        Modelos que sigue
                    </span>
                </div>
                <div class="table text-center">
                    <table class="table table-sm">
                        <tbody>
                            @foreach ($cammodelTipper->cammodels as $cammodel)
                            <tr>
                                <td>{{ $cammodel->nickname }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>