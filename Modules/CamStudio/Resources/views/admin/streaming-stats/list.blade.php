@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.list_breadcrumb')
@section('content')
<section class="content">
    @include('generals::layouts.errors-and-messages')
    <div class="card p-0 m-0">
        <div class="row">
            <div class="col-xl-8">
                <div class="card-header border-0 pb-0">
                    <div class="row">
                        @include('generals::layouts.admin.module_name')
                    </div>
                </div>
                @if(!$cammodels_stats->isEmpty())
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card bg-gradient-default shadow">
                                <div class="card-header bg-transparent">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="text-uppercase text-light ls-1 mb-1">Vista general</h6>
                                            <span class="text-white mb-0">Seguidores En Chaturbate</span>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label class="form-control-label text-white" style="font-size: 12px; font-weight: normal;" for="q">Cuentas</label>
                                                <div class="input-group input-group-merge">
                                                    <select class="form-control form-control-sm " id="model-selector"
                                                        onchange="model_filter()">
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card_body p-3">
                                    <div class="chart">
                                        <canvas id="streaming-stats-chart"></canvas>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                @else
                <div class="card-body">
                    <span class="text-danger">No existen registros en estas fechas</span>
                </div>
                @endif
            </div>
            <div class="col-xl-4 pl-0">
                <div class="card-header border-0 pb-0">
                    <div class="row">
                        <div class="col-12 text-right">
                            @include('camstudio::admin.layouts.search', ['route' => route($optionsRoutes . '.index')])
                        </div>
                    </div>
                </div>
                @if(!$cammodels_stats->isEmpty())
                <div class="card-body pl-0 pt-3">
                    <div class="row">
                        <div class="col-xl-12 pl-0">
                            <div class="card shadow pl-0">
                                <div class="card-header border-0">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h3 class="mb-0">Comportamiento # seguidores</h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table-striped table align-items-center table-flush table-hover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th class="text-center" scope="col">Cuenta Modelo</th>
                                                <th class="text-center" scope="col">Seguidores</th>
                                                <th class="text-center" scope="col">Tasa de variación</th>
                                            </tr>
                                        </thead>
                                        <tbody id="followers-behavior">
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script>
    var cammodels_streaming_stats = JSON.parse('<?php echo json_encode($cammodels_stats)?>');
    var days                      = JSON.parse('<?php echo json_encode($days)?>');

</script>
@include('camstudio::admin.layouts.streaming-stats.streaming_statsJS')
@endsection
