<div class="col-md-12">
    <div class="card">
        <div class="card-body">
            <div class="row align-items-center mb-3">
                <div class="col">
                    <h3 class="mb-0">Comentarios <i class="fas fa-comments"></i></h3>
                </div>
                <div class="col text-right">
                    <a href="#myModal" data-toggle="modal" data-target="#commentmodal" class="btn btn-primary btn-sm">
                        <i class="fa fa-edit"></i>
                        Agregar comentario</a>
                </div>
            </div>
            <div class="w-100">
                <div class="table-responsive">
                    @if($datas->isNotEmpty())
                    <table class="table-striped table align-items-center table-flush table-hover text-center">
                        <thead class="thead-light">
                            <tr>
                                <th class="text-center" scope="col">Usuario</th>
                                <th class="text-center" scope="col">Fecha</th>
                                <th class="text-center" scope="col">Comentario</th>
                            </tr>
                        </thead>
                        @foreach ($datas as $data)
                        <tr>
                            <td>{{ $data->user }}</td>
                            <td>{{ $data->created_at->format('M d, Y h:i a') }}</td>
                            <td>{{ $data->commentary }}</td>
                            <td class="text-center">@include('generals::layouts.status', ['status' =>
                                $data->status])
                            </td>
                        </tr>
                        @endforeach
                    </table>
                    @else
                    <span class="text-sm"><strong>Aún no</strong> tiene comentarios</span>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
