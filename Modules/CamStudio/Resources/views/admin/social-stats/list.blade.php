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
                @if(!$models_stats->isEmpty())
                <div class="card-body">
                    <div class="row">
                        <div class="col-12">
                            <div class="card bg-gradient-default shadow">
                                <div class="card-header bg-transparent">
                                    <div class="row align-items-center">
                                        <div class="col">
                                            <h6 class="text-uppercase text-light ls-1 mb-1">Vista general</h6>
                                            <span class="text-white mb-0">Seguidores En {{ $social_platform }}</span>
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
                                        <canvas id="social-media-chart"></canvas>
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
                @if(!$models_stats->isEmpty())
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
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();
    if(dd<10){
            dd='0'+dd
        }
        if(mm<10){
            mm='0'+mm
        }
    today = yyyy+'-'+mm+'-'+dd;
    document.getElementById("to_date").setAttribute("max", today);
    document.getElementById("from_date").setAttribute("max", today);

    var cammodels_social_stats = JSON.parse('<?php echo json_encode($cammodels_stats)?>');
    var models_stats           = JSON.parse('<?php echo json_encode($models_stats)?>');
    var days                   = JSON.parse('<?php echo json_encode($days)?>');

    if (models_stats != "") {
        total_days      = days['days_number'];
        reference_day   = days['reference_day'];
        followers_data  = [];
        days_labels     = [];
        count           = 0;

        for (let index = 0; index < total_days; index++) {
            day = index + 1;
            days_labels.push(days['days'][index]);
        }

        lineChartData = {
            labels: [],
            datasets: []
        };

        cammodels_social_stats.forEach(cammodel => {
            cammodel.forEach(social_stat => {
                followers_data[social_stat['cammodel_social_media_id']] = [];
            });
        });

        cammodels_social_stats.forEach(cammodel => {
            cammodel.forEach(social_stat => {
                followers_data[social_stat['cammodel_social_media_id']].unshift(social_stat[
                    'followers_count']);
            });

            while (followers_data[cammodel[0]['cammodel_social_media_id']].length < total_days) {
                followers_data[cammodel[0]['cammodel_social_media_id']].unshift(null);
            }

            rgba_color = modelRGBGenerator(cammodel[0]['cammodel_social_media']['id']);

            lineChartData.datasets.push({
                label: cammodel[0]['cammodel_social_media']['profile'],
                fillColor: 'rgba(220,220,220,0.2)',
                strokeColor: rgba_color,
                borderColor: rgba_color,
                borderWidth: 2,
                pointColor: rgba_color,
                pointStrokeColor: '#fff',
                pointHighlightFill: '#fff',
                pointBackgroundColor: rgba_color,
                pointHighlightStroke: rgba_color,
                data: followers_data[cammodel[0]['cammodel_social_media_id']]
            });
        });

        lineChartData.labels = days_labels;

        var ctx = document.getElementById('social-media-chart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: lineChartData,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: false,
                        }
                    }]
                }
            }
        });

        followers_behavior_content = "";
        cammodel_selector_content = '<option value="all" selected>Todas las cuentas</option>';
        for (let index = 0; index < models_stats.length; index++) {

            cammodel_selector_content += '<option value="' + models_stats[index]["cammodel_social_media"]["id"] + '">' +
                models_stats[index]["cammodel_social_media"]["profile"] + '</option>';
        }
        document.getElementById('model-selector').innerHTML = cammodel_selector_content;

        for (let index = 0; index < models_stats.length; index++) {
            icon = '<i class="fas fa-minus mr-3"></i>'
            if (models_stats[index]["bounce_rate"] < 0) {
                icon = '<i class="fas fa-arrow-down text-danger mr-3"></i>';
            }
            if (models_stats[index]["bounce_rate"] > 0) {
                icon = '<i class="fas fa-arrow-up text-success mr-3"></i>';
            }
            followers_behavior_content += '<tr>' +
                '<td class="text-center">' + models_stats[index]["cammodel_social_media"]["profile"] + '</td>' +
                '<td class="text-center">' + models_stats[index]["followers_count"] + '</td>' +
                '<td class="text-center">' + icon + models_stats[index]["bounce_rate"] + '%</td>' +
                '</tr>';
        }
        document.getElementById('followers-behavior').innerHTML = followers_behavior_content;
    }

    function modelRGBGenerator(id) {
        const hue = id * 137.508; // use golden angle approximation
        return `hsl(${hue},50%,75%)`;
    }

    function day_completion(initial_day) {
        switch (initial_day) {
            case 1:
                return 'Lunes';
                break;
            case 2:
                return 'Martes';
                break;
            case 3:
                return 'Miércoles';
                break;
            case 4:
                return 'Jueves';
                break;
            case 5:
                return 'Viernes';
                break;
            case 6:
                return 'Sábado';
                break;
            case 7:
                return 'Domingo';
                break;
        }
    }

    function model_filter() {
        model_id = document.getElementById('model-selector').value;
        if (model_id == "all") {
            all_filler();
        } else {
            model_filler(model_id);
        }
    }

    function all_filler() {
        lineChartData.datasets = [];
        cammodels_social_stats.forEach(cammodel => {
            rgba_color = modelRGBGenerator(cammodel[0]['cammodel_social_media']['id']);

            lineChartData.datasets.push({
                label: cammodel[0]['cammodel_social_media']['profile'],
                fillColor: 'rgba(220,220,220,0.2)',
                strokeColor: rgba_color,
                borderColor: rgba_color,
                borderWidth: 2,
                pointColor: rgba_color,
                pointStrokeColor: '#fff',
                pointHighlightFill: '#fff',
                pointBackgroundColor: rgba_color,
                pointHighlightStroke: rgba_color,
                data: followers_data[cammodel[0]['cammodel_social_media_id']]
            });
        });

        var ctx = document.getElementById('social-media-chart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'line',
            data: lineChartData,
            options: {
                scales: {
                    yAxes: [{
                        ticks: {
                            beginAtZero: true
                        }
                    }]
                }
            }
        });

        followers_behavior_content = "";

        for (let index = 0; index < models_stats.length; index++) {
            icon = '<i class="fas fa-minus mr-3"></i>'
            if (models_stats[index]["bounce_rate"] < 0) {
                icon = '<i class="fas fa-arrow-down text-danger mr-3"></i>';
            }
            if (models_stats[index]["bounce_rate"] > 0) {
                icon = '<i class="fas fa-arrow-up text-success mr-3"></i>';
            }
            followers_behavior_content += '<tr>' +
                '<td class="text-center">' + models_stats[index]["cammodel_social_media"]["profile"] + '</td>' +
                '<td class="text-center">' + models_stats[index]["followers_count"] + '</td>' +
                '<td class="text-center">' + icon + models_stats[index]["bounce_rate"] + '%</td>' +
                '</tr>';
        }
        document.getElementById('followers-behavior').innerHTML = followers_behavior_content;
    }

    function model_filler(model_id) {
        lineChartData.datasets = [];
        rgba_color = modelRGBGenerator(model_id);
        model_profile = $('#model-selector option:selected').text();
        lineChartData.datasets.push({
            label: model_profile,
            fillColor: 'rgba(220,220,220,0.2)',
            strokeColor: rgba_color,
            borderColor: rgba_color,
            borderWidth: 2,
            pointColor: rgba_color,
            pointStrokeColor: '#fff',
            pointHighlightFill: '#fff',
            pointBackgroundColor: rgba_color,
            pointHighlightStroke: rgba_color,
            data: followers_data[model_id]
        });

        datas_array = [];
        for (let index = 0; index < total_days; index++) {
            if (lineChartData.datasets[0].data[index] != null) {
                datas_array.push(parseInt(lineChartData.datasets[0].data[index]));
            }
        }
        myChart.options = {
            scales: {
                yAxes: [{
                    ticks: {
                        suggestedMin: (Math.min(...datas_array) - (Math.min(...datas_array) % 10)) - 2,
                        suggestedMax: (Math.max(...datas_array) - (Math.max(...datas_array) % 10)) + 12,
                        stepSize: 0.5,
                        beginAtZero: false
                    }
                }]
            }
        };
        myChart.data = lineChartData;
        myChart.update();
        followers_behavior_content = "";

        for (let index = 0; index < models_stats.length; index++) {
            icon = '<i class="fas fa-minus mr-3"></i>'

            if (models_stats[index]["bounce_rate"] < 0) {
                icon = '<i class="fas fa-arrow-down text-danger mr-3"></i>';
            }
            if (models_stats[index]["bounce_rate"] > 0) {
                icon = '<i class="fas fa-arrow-up text-success mr-3"></i>';
            }
            if (models_stats[index]["cammodel_social_media"]["id"] == model_id) {
                followers_behavior_content += '<tr>' +
                    '<td class="text-center">' + models_stats[index]["cammodel_social_media"]["profile"] + '</td>' +
                    '<td class="text-center">' + models_stats[index]["followers_count"] + '</td>' +
                    '<td class="text-center">' + icon + models_stats[index]["bounce_rate"] + '%</td>' +
                    '</tr>';
            }
        }
        document.getElementById('followers-behavior').innerHTML = followers_behavior_content;
    }
</script>
@endsection
