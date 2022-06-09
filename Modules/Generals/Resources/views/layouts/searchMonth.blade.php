<!-- search form -->
<div class="ml-auto justify-content-end d-flex"
    style=" position: absolute; top: 0px; right: 1%; z-index: 99; ">
    <p>
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
                        <div class="col-sm-6 col-md-4 col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="q">
                                    Mes</label>
                                <div class="input-group input-group-merge">
                                    <input type="month" name="month"
                                        id="month" placeholder="YYYY-MM"
                                        class="form-control form-control-sm"
                                        value="{!! request()->input('month') !!}">
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6 col-md-4 col-lg-6">
                            <div class="form-group">
                                <label class="form-control-label" for="q">
                                    Modelo</label>
                                <select class="form-control form-control-sm"
                                name="cammodel_id" id="cammodel_id">
                                    <option selected disabled>
                                        --select an option--</option>
                                    @foreach ($cammodels as $cammodel)
                                        <option value="{{ $cammodel->id }}">
                                            {{ $cammodel->nickname }} /
                                            {{ $cammodel->employee->name }}
                                            {{ $cammodel->employee->last_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        @if (!auth()->guard('employee')->user()->hasRole('studio_admin|studio_manager|operative_leader_aux|partner|subsidiary_supervisor|night_shift_admin'))
                            <div class="col-sm-6 col-md-4 col-lg-6">
                                <div class="form-group">
                                    <label class="form-control-label" for="q">Sede</label>
                                    <select class="form-control form-control-sm" name="subsidiary_id" id="subsidiary_id">
                                        <option selected disabled>--select an option--</option>
                                        <option value="1">Le Femme - Principal</option>
                                        <option value="2">Le Femme - Lago</option>
                                        <option value="3">Le Femme - Santa Monica</option>
                                        <option value="4">Le Femme - Manizales</option>
                                    </select>
                                </div>
                            </div>
                        @endif
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
