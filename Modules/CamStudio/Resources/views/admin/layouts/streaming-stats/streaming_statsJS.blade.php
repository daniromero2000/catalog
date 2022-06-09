<script>
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth() + 1; //January is 0!
    var yyyy = today.getFullYear();
    if (dd < 10) {
        dd = '0' + dd
    }
    if (mm < 10) {
        mm = '0' + mm
    }
    today = yyyy + '-' + mm + '-' + dd;
    document.getElementById("to_date").setAttribute("max", today);
    document.getElementById("from_date").setAttribute("max", today);

    stats_map = Object.entries(cammodels_streaming_stats);
    cammodelsStats = new Array();
    stats_map.forEach(cammodelStats => {
        cammodelsStats[cammodelStats[0]] = cammodelStats[1];
    });

    if (cammodels_streaming_stats != "") {
        total_days = days['days_number'];
        reference_day = days['reference_day'];
        followers_data = [];
        days_labels = [];
        count = 0;

        for (let index = 0; index < total_days; index++) {
            day = index + 1;
            days_labels.push(days['days'][index]);
        }

        lineChartData = {
            labels: [],
            datasets: []
        };

        cammodel_selector_content = '<option value="all" selected>Todas las cuentas</option>';
        followers_behavior_content = "";

        cammodelsStats.forEach(cammodel => {
            cammodel.forEach(streamingStat => {
                if (!(streamingStat['cammodel_stream_account_id'] in followers_data)) {
                    followers_data[streamingStat['cammodel_stream_account_id']] = [];
                }
                followers_data[streamingStat['cammodel_stream_account_id']].push(streamingStat[
                    'num_followers']);
            });

            while (followers_data[cammodel[0]['cammodel_stream_account_id']].length < total_days) {
                followers_data[cammodel[0]['cammodel_stream_account_id']].unshift(null);
            }

            rgba_color = modelRGBGenerator(cammodel[0]['cammodel_stream_account']['id']);

            lineChartData.datasets.push({
                label: cammodel[0]['cammodel_stream_account']['profile'],
                fillColor: 'rgba(220,220,220,0.2)',
                strokeColor: rgba_color,
                borderColor: rgba_color,
                borderWidth: 2,
                pointColor: rgba_color,
                pointStrokeColor: '#fff',
                pointHighlightFill: '#fff',
                pointBackgroundColor: rgba_color,
                pointHighlightStroke: rgba_color,
                data: followers_data[cammodel[0]['cammodel_stream_account_id']]
            });

            cammodel_selector_content += '<option value="' +
                cammodel[0]["cammodel_stream_account"]["id"] +
                '">' + cammodel[0]["cammodel_stream_account"]["profile"] +
                '</option>';

            bounce_rate = cammodel[0]["num_followers"] == 0 ?
                0 :
                (100 * (cammodel[cammodel.length - 1]["num_followers"] -
                    cammodel[0]["num_followers"]) / cammodel[0]["num_followers"]).toFixed(2);

            icon = '<i class="fas fa-minus mr-3"></i>'
            if (bounce_rate < 0) {
                icon = '<i class="fas fa-arrow-down text-danger mr-3"></i>';
            }
            if (bounce_rate > 0) {
                icon = '<i class="fas fa-arrow-up text-success mr-3"></i>';
            }
            followers_behavior_content += '<tr>' +
                '<td class="text-center">' + cammodel[0]["cammodel_stream_account"]["profile"] + '</td>' +
                '<td class="text-center">' + cammodel[0]["num_followers"] + '</td>' +
                '<td class="text-center">' + icon + bounce_rate + '%</td>' +
                '</tr>';
        });

        lineChartData.labels = days_labels;

        var ctx = document.getElementById('streaming-stats-chart').getContext('2d');
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

        document.getElementById('model-selector').innerHTML = cammodel_selector_content;
        document.getElementById('followers-behavior').innerHTML = followers_behavior_content;
    }

    function modelRGBGenerator(id) {
        const hue = id * 137.508; // use golden angle approximation
        return `hsl(${hue},50%,75%)`;
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
        myChart.options = {
            scales: {
                yAxes: [{
                    ticks: {
                        beginAtZero: false,
                    }
                }]
            }
        };
        myChart.data = lineChartData;
        myChart.update();

        document.getElementById('followers-behavior').innerHTML = followers_behavior_content;
    }

    function model_filler(model_id) {
        cammodelLineChartData = {
            labels: [],
            datasets: []
        };
        cammodelLineChartData.labels = days_labels;
        rgba_color = modelRGBGenerator(model_id);
        model_profile = $('#model-selector option:selected').text();
        cammodelLineChartData.datasets.push({
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
            if (cammodelLineChartData.datasets[0].data[index] != null) {
                datas_array.push(parseInt(cammodelLineChartData.datasets[0].data[index]));
            }
        }

        floorNumber = Math.min(...datas_array) == 0 ? 0 :
            (Math.min(...datas_array) - (Math.min(...datas_array) % 10)) - 2;

        myChart.options = {
            scales: {
                yAxes: [{
                    ticks: {
                        suggestedMin: floorNumber,
                        suggestedMax: (Math.max(...datas_array) - (Math.max(...datas_array) % 10)) + 12,
                        stepSize: 100,
                        beginAtZero: false
                    }
                }]
            }
        };
        myChart.data = cammodelLineChartData;
        myChart.update();
        cammodel_followers_behavior_content = "";

        lastValuePos = cammodelsStats[model_id].length - 1;
        bounce_rate = cammodelsStats[model_id][0]["num_followers"] == 0 ?
            0 :
            (100 * (cammodelsStats[model_id][lastValuePos]["num_followers"] -
                cammodelsStats[model_id][0]["num_followers"]) /
                cammodelsStats[model_id][0]["num_followers"]).toFixed(2);

        icon = '<i class="fas fa-minus mr-3"></i>'
        if (bounce_rate < 0) {
            icon = '<i class="fas fa-arrow-down text-danger mr-3"></i>';
        }
        if (bounce_rate > 0) {
            icon = '<i class="fas fa-arrow-up text-success mr-3"></i>';
        }
        cammodel_followers_behavior_content += '<tr>' +
            '<td class="text-center">' + cammodelsStats[model_id][0]["cammodel_stream_account"]["profile"] + '</td>' +
            '<td class="text-center">' + cammodelsStats[model_id][lastValuePos]["num_followers"] + '</td>' +
            '<td class="text-center">' + icon + bounce_rate + '%</td>' +
            '</tr>';

        document.getElementById('followers-behavior').innerHTML = cammodel_followers_behavior_content;
    }

</script>
