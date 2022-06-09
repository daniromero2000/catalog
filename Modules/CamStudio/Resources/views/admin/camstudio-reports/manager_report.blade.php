@extends('generals::layouts.admin.app')
@include('generals::layouts.admin.breadcrumbs.no_link_breadcrumb')
@section('content')
<style>
    .circular-image {
        display: inline-block;
        overflow: hidden;
        border-radius: 50%;
        max-width: 200px;
        max-height: 200px;
    }
</style>
<section class="content">
    @include('generals::layouts.errors-and-messages')
    @if ($manager)
    <div class="card">
        <div class="card_body p-3">
            <span class="h3">Información Manager:
                {{ $manager->name.' '.$manager->last_name }}
            </span>
            <span>{{ 'desde: '.$liquidation_period['0'].', hasta: '.$liquidation_period['1'] }} </span>
            @include('generals::layouts.searchFortnights', ['route' => route($optionsRoutes . '.manager.report', $manager->id)])
            <div class="row mt-2">
                <div class="col-lg-3 text-center h-100">
                    <div class="card bg-gradient-secondary d-block mx-0">
                        <br>
                        <div class="card-body p-0 text-center" style="overflow: hidden">
                            <div class="circular-image text-center">
                                @if ($manager->avatar != "No
                                Avatar")
                                <img src="{{ asset("storage/".$manager->avatar) }}"
                                    style="max-width: 100%; max-height: 300px;"
                                    alt="Foto {{ $manager->name.' '.$manager->last_name }}">
                                @else
                                <img src="https://cdn.pixabay.com/photo/2014/04/02/14/10/female-306407__340.png"
                                    style="max-width: 100%; max-height: 300px;"
                                    alt="Foto {{ $manager->name.' '.$manager->last_name }}">
                                @endif
                            </div>
                        </div>
                        <span class="text-sm">
                            {{ $manager->name }}
                            {{ $manager->last_name }}
                            <br>
                            Sede: {{ $manager->subsidiary->name }}
                            <br>
                        </span>
                    </div>
                </div>
                <div class="col-lg-3 p-lg-0 mx-0 text-center">
                    <div class="card mb-3 d-block py-2">
                        <span class="h3">Progreso de Ventas</span>
                        <br>
                        <span class="h4">{{ number_format($managerFortnightsIncomes[0] / 2, 2) }}
                            / {{ intval($managerKpi) }} (USD)</span>
                        <div style="position: relative;">
                            <span>{{ number_format(((($managerFortnightsIncomes[0] / 2) * 100) /
                                (intval($managerKpi))), 2) }} %</span>
                        </div>
                        <div class="chart" style="height: 250px">
                            <canvas id="manager-progress-chart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 pr-lg-3 text-center">
                    <div class="card mb-3 mx-0 d-block p-2">
                        <span class="h3">Ventas quincena actual (USD)</span>
                        <div class="chart" style="height: 299px">
                            <canvas id="daily-incomes-chart"></canvas>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 pr-lg-0 text-center">
                    <div class="card mb-3 mx-0 d-block p-2">
                        <span class="h3">Comparación Quincenas (USD)</span>
                        <div class="chart" style="height: 250px">
                            <canvas id="fortnights-incomes-chart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @else
    <div class="card btn">
        <span class="h2">El manager aún no cuenta con ingresos registrados</span>
    </div>
    @endif
</section>
@endsection
@section('scripts')
<script>
    var managerFortnightsIncomes = JSON.parse('<?php echo json_encode($managerFortnightsIncomes)?>');
    var managerDailyIncomes      = JSON.parse('<?php echo json_encode($managerDailyIncomes)?>');
    var managerKpi               = JSON.parse('<?php echo json_encode($managerKpi)?>');
</script>
@if($manager)
    @include('camstudio::admin.layouts.camstudio-reports.manager.manager_progressJS')
    @include('camstudio::admin.layouts.camstudio-reports.manager.manager_fortnights_incomesJS')
@endif
@endsection
