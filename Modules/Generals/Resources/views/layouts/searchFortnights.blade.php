<!-- search form -->
<div class="ml-auto justify-content-end d-flex"
    style="position: absolute; top: 0px; right: 1%; z-index: 99; ">
    <p class="mt-2">
        <a class="btn btn-primary btn-sm" data-toggle="collapse"
            href="#contentId" aria-expanded="false"
            aria-controls="contentId">
            <i class="fas fa-filter"></i> Filtrar
        </a>
    </p>
</div>
<div class="collapse mt-3" id="contentId">
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-0"
                style=" box-shadow: 0 0 2rem 0 rgba(0, 0, 0, .0) !important;">
                <form action="{{$route}}" method="get" id="admin-search">
                    <div class="row d-flex justify-content-end">
                        <div class="col-sm-6 col-md-4 col-lg-3">
                            <div class="form-group">
                                <label class="form-control-label" for="from">Día de quincena</label>
                                <div class="input-group input-group-merge">
                                    <input type="date" name="from" class="form-control form-control-sm "
                                        value="{!! request()->input('from') !!}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="col-12 d-flex">
                                <span class="input-group-btn ml-auto btn-pr">
                                    <form action="{{$route}}" method="get" id="admin-search">
                                        @if (request()->input() != null)
                                        <span class="input-group-btn">

                                            <a title="Recuperar" href="{{$route}}" id="recover"
                                                class="btn btn-danger btn-sm">Restaurar</a>
                                        </span>
                                        @endif
                                    </form>
                                    <button type="submit" id="search-btn" class="btn btn-primary btn-sm"><i
                                            class="fa fa-search"></i>
                                        Buscar
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
