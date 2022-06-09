<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row align-items-center mb-3">
                <div class="col">
                    <h3 class="mb-0">Comentarios</h3>
                </div>
                <div class="col text-right">
                    <a href="#commentModal" data-toggle="modal" data-target="#commentModal" class="btn btn-primary btn-sm"><i
                            class="fa fa-edit"></i>
                        Agregar Comentario</a>
                </div>
            </div>
            <div class="w-100">
                <div class="table-responsive">
                    @if($commentaries->isNotEmpty())
                    <table
                        class="table table-striped align-items-center table-flush table-hover text-center table-borderless table-sm">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" scope="col">Comentario</th>
                                <th class="text-center" scope="col">Usuario</th>
                            </tr>
                        </thead>
                        <tbody class="list">
                            @foreach($commentaries as $data)
                            <tr>
                                <td class="text-center">{{ $data->commentary }}</td>
                                <td class="text-center">{{ $data->user }}</td>
                            </tr>
                            @endforeach
                        <tbody>
                    </table>
                    @else
                    <span class="text-sm"><strong>Aún no</strong> tiene comentarios</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>