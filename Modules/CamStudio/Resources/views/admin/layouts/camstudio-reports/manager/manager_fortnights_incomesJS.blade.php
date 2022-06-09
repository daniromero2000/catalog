<script>
    managerDailyIncomesChartData = {
        labels:[],
        datasets: [{
            data: [],
            backgroundColor: [],
            hoverBackgroundColor: []
        }]
    };

    managerDailyIncomesChartData.labels = Object.keys(managerDailyIncomes);

    Object.values(managerDailyIncomes).forEach(element => {
        managerDailyIncomesChartData.datasets[0].data.push((element/2).toFixed(3));
        fillColor = element/2 > (managerKpi / 13) ? 'rgb(100,255,80)' : 'rgb(255,100,80)';
        managerDailyIncomesChartData.datasets[0].backgroundColor.push(fillColor);
        managerDailyIncomesChartData.datasets[0].hoverBackgroundColor.push('rgb(100,158,255)');
    });

    var managerDailyIncomesCtx = document.getElementById('daily-incomes-chart').getContext('2d');
    var managerDailyIncomesChart = new Chart(managerDailyIncomesCtx, {
        type: 'bar',
        data: managerDailyIncomesChartData,
        options: {
        }
    });

    managerFortnightsIncomesChartData = {
        labels:[],
        datasets: [{
            axis: 'y',
            data: [],
            backgroundColor: [],
            hoverBackgroundColor: []
        }]
    };

    fortnightsCount = 0;
    
    Object.values(managerFortnightsIncomes).forEach(fortnightIncomes => {
        managerFortnightsIncomesChartData.datasets[0].data.unshift((fortnightIncomes / 2).toFixed(3));
        if (fortnightsCount == 0) {
            managerFortnightsIncomesChartData.labels.unshift('Actual');
        } else{
            managerFortnightsIncomesChartData.labels.unshift('Pasada');
        }
        fortnightsCount = fortnightsCount + 1;
    });

    var ctxmanagerFortnightsIncomes = document.getElementById('fortnights-incomes-chart').getContext('2d');
    var managerFortnightsIncomesChart = new Chart(ctxmanagerFortnightsIncomes, {
        type: 'bar',
        data: managerFortnightsIncomesChartData,
        options: {
            indexAxis: 'y',
        }
    });

</script>