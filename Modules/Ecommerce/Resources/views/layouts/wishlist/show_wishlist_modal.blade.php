<div class="modal fade" id="covermodal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row w-100">
                    <div class="col-12 text-center">
                        <h2 style="color: #6D7AEB">Datos de registro deseo</h2>
                    </div>
                </div>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="text-sm">
                    <div class="d-flex justify-content-between">
                        <span><b>Nombre de cliente:</b></span>
                        <span>{{$data->customer->name}}
                            {{$data->customer->last_name}}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span><b>Nombre de producto:</b></span>
                        <span>{{$data->product->name}}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span><b>Sku:</b></span>
                        <span>{{ $data->product->sku }}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span><b>Precio:</b></span>
                        <span>$ {{ number_format($data->product->price)}}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span><b>Marca:</b></span>
                        <span></span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span><b>Creación de deseo:</b></span>
                        <span>{{$data->created_at->format('M d, Y h:i a')}}</span>
                    </div>
                    <div class="d-flex justify-content-between">
                        <span><b>Movimiento a carro:</b></span>
                        <span>{{$data->moved_to_cart}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
