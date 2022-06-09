<div id="ratingReviews" class="col-11 mx-auto col-sm-12 mt-3 px-1 ">
    <div id="ratingContainer" class="d-flex justify-content-center align-items-center w-100">
        <div id="ratingStarts" class="col-xs-12 col-md-6 text-center">
            <div id='promedioRating' class="rating-num">{{ $promedioRating }}<small> /
                    5</small></div>
            <div class="rating-reviews">
                <i class="far fa-star" aria-hidden="true" data-attr="1" id="rating-review-1"></i>
                <i class="far fa-star" aria-hidden="true" data-attr="2" id="rating-review-2"></i>
                <i class="far fa-star" aria-hidden="true" data-attr="3" id="rating-review-3"></i>
                <i class="far fa-star" aria-hidden="true" data-attr="4" id="rating-review-4"></i>
                <i class="far fa-star" aria-hidden="true" data-attr="5" id="rating-review-5"></i>
            </div>
            <div id="totalVotantes">
                <i class="fa fa-user" aria-hidden="true"></i>
                <span>{{ $cant_reviews }}</span> votos
            </div>
            <div>
                <button type="button" id="moreInfo" class="btn btn-link">Ver m&aacute;s
                    info <i class="fas fa-arrow-right"></i></button>
            </div>
        </div>
        <div id="porcentByRating" class="col-xs-12 col-md-6 porcentrating toast" role="alert" aria-live="assertive"
            aria-atomic="true">
            <div class="toast-header d-flex justify-content-between">
                <small>Porcentajes</small>
                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="toast-body">
                <div class="rating-desc">
                    @if($x5)
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <div class="col-xs-3 col-md-3 text-right sh">
                            <i class="fa fa-star" aria-hidden="true"></i><small>5</small>
                        </div>
                        <div class="col-xs-8 col-md-9 mb-1">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped bg-success" role="progressbar"
                                    aria-valuenow="{{ $x5 }}" aria-valuemin="0" aria-valuemax="100"
                                    style="width: {{ $x5 }}%">
                                    <span class="sr-only">{{ $x5 }}%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($x4)
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <div class="col-xs-3 col-md-3 text-right sh">
                            <i class="fa fa-star" aria-hidden="true"></i><small>4</small>
                        </div>
                        <div class="col-xs-8 col-md-9 mb-1">
                            <div class="progress">
                                <div class="progress-bar progress-bar bg-success" role="progressbar"
                                    aria-valuenow="{{ $x4 }}" aria-valuemin="0" aria-valuemax="100"
                                    style="width: {{ $x4 }}%">
                                    <span class="sr-only">{{ $x4 }}%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($x3)
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <div class="col-xs-3 col-md-3 text-right sh">
                            <i class="fa fa-star" aria-hidden="true"></i><small>3</small>
                        </div>
                        <div class="col-xs-8 col-md-9 mb-1">
                            <div class="progress">
                                <div class="progress-bar progress-bar bg-info" role="progressbar"
                                    aria-valuenow="{{ $x3 }}" aria-valuemin="0" aria-valuemax="100"
                                    style="width: {{ $x3 }}%">
                                    <span class="sr-only">{{ $x3 }}%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($x2)
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <div class="col-xs-3 col-md-3 text-right sh">
                            <i class="fa fa-star" aria-hidden="true"></i><small>2</small>
                        </div>
                        <div class="col-xs-8 col-md-9 mb-1">
                            <div class="progress">
                                <div class="progress-bar progress-bar bg-warning" role="progressbar"
                                    aria-valuenow="{{ $x2 }}" aria-valuemin="0" aria-valuemax="100"
                                    style="width: {{ $x2 }}%">
                                    <span class="sr-only">{{ $x2 }}%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($x1)
                    <div class="d-flex justify-content-between align-items-center w-100">
                        <div class="col-xs-3 col-md-3 text-right sh">
                            <i class="fa fa-star" aria-hidden="true"></i><small>1</small>
                        </div>
                        <div class="col-xs-8 col-md-9 mb-1">
                            <div class="progress">
                                <div class="progress-bar progress-bar-danger" role="progressbar"
                                    aria-valuenow="{{ $x1 }}" aria-valuemin="0" aria-valuemax="100"
                                    style="width: {{ $x1 }}%">
                                    <span class="sr-only">{{ $x1 }}%</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
<div class="col-xl-12 px-1">
    <button type="button" @auth data-toggle="modal" data-target="#produtcReviewModal" @endauth data-backdrop="static"
        data-keyboard="false" id="triggerProductReviewModal" class="btn btn-block bg-warning-reset mx-auto mt-2 ">
        Calificar Producto @auth - <span class="selected-rating valid" ata-attr="">0</span><small> / 5</small>@endauth
    </button>
</div>
<div class="modal fade" id="produtcReviewModal" tabindex="-1" role="dialog" aria-labelledby="produtcReviewModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title ">Calificar Producto </h5>
            </div>
            <div class="modal-body">
                <div class="row" id="rating-ability-wrapper">
                    <label for="comment" class="control-label col-md-12 d-flex justify-content-center mt-2 mb-3">
                        <textarea id='comment' class="w-100" name="comment"
                            placeholder="Comparte tu opinión con el vededor!"></textarea>
                    </label>
                    <label class="col-md-12  control-label d-flex justify-content-center" for="rating">
                        <span class="field-label-header">Que tal te parece este
                            producto</span><br>
                        <span class="field-label-info"></span>
                        <input type="hidden" id="selected_rating" name="selected_rating" value="" required="required">
                        <input type="hidden" id="product_id" name="product_id" value="{{$product->id}}"
                            required="required">
                    </label>
                    <div class="col-md-12 d-flex justify-content-center mt-2 mb-2">
                        <button type="button" class="btnrating btn btn-default btn-lg border-0" data-attr="1"
                            id="rating-star-1">
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btnrating btn btn-default btn-lg border-0" data-attr="2"
                            id="rating-star-2">
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btnrating btn btn-default btn-lg border-0" data-attr="3"
                            id="rating-star-3">
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btnrating btn btn-default btn-lg border-0" data-attr="4"
                            id="rating-star-4">
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </button>
                        <button type="button" class="btnrating btn btn-default btn-lg border-0" data-attr="5"
                            id="rating-star-5">
                            <i class="fa fa-star" aria-hidden="true"></i>
                        </button>
                    </div>
                    <div class="col-md-12 d-flex justify-content-center mt-2">
                        <h2 class="bold rating-header">
                            <span class="selected-rating">0</span><small> / 5</small>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="createProductReview" disabled class="btn button-reset"
                    data-dismiss="modal">Enviar
                    Calificaci&oacute;n</button>
                <button type="button" @guest id="cancelReview" @endguest class="btn btn-secondary"
                    data-dismiss="modal">Cancelar </button>
            </div>
        </div>
    </div>
</div>