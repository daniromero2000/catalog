<div class="modal fade" id="modal{{$contractRequestStreamAccountCommission->id}}" tabindex="-1" role="dialog" aria-labelledby="modelTitleId"
    aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <div class="row row-reset w-100">
                    <div class="col-12 text-center">
                        <h5 class="modal-title">Actualizar <b>{{$contractRequestStreamAccountCommission->name}}</b></h5>
                    </div>
                </div>
            </div>
            <form action="{{ route($optionsRoutes . '.update', $contractRequestStreamAccountCommission->id) }}" method="post"  class="form">
                @csrf
                @method('PUT')
                <div class="modal-body py-0">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label class="form-control-label" for="amount">Monto</label>
                                <div class="input-group input-group-merge">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"> <i class="fa fa-hashtag"></i></span>
                                    </div>
                                    <input class="form-control" type="text" id="amount" name="amount"
                                        value="{{ $contractRequestStreamAccountCommission->amount }}">
                                    <div class="input-group-append">
                                        <span class="input-group-text">COP</span>
                                    </div>
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