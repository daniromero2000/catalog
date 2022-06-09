<div role="tabpanel" class="tab-pane" id="combinations">
    <div class="col pl-0 mb-3 d-flex">
        <div>
            <h2>Lista combinaciones</h2>
        </div>
        <div class="ml-auto">
            <button type="button" class="btn btn-primary btn-sm" data-toggle="modal"
                data-target="#exampleModal">
                Crear combinacion
            </button>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12">
            @include('ecommerce::admin.products.attributes',
            compact('productAttributes'))
            <!-- Button trigger modal -->
        </div>
        <div>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Crear
                                combinaciones</h5>
                            <button type="button" class="close" data-dismiss="modal"
                                aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('admin.products.update', $product->id) }}"
                                method="post" class="form" enctype="multipart/form-data"
                                id="form_comb">
                                @csrf
                                <input type="hidden" name="_method" value="put">
                                @include('ecommerce::admin.products.create-attributes',
                                compact('attributes'))
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <div class="row">
        <div class=" ml-auto pb-0">
            <a href="{{ route('admin.product.duplicate', ['id' => $product->id]) }}"
                class="btn btn-info btn-sm">Duplicar</a>
            <a href="{{ route('admin.products.index') }}"
                class="btn btn-default btn-sm">Regresar</a>
        </div>
    </div>
</div>