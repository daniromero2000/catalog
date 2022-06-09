<script>
    dailyIncomesChartData = {
        labels:[],
        datasets: [{
            data: [],
            backgroundColor: [],
            hoverBackgroundColor: []
        }]
    };

    dailyIncomesChartData.labels = Object.keys(dailyIncomes);

    Object.values(dailyIncomes).forEach(element => {
        dailyIncomesChartData.datasets[0].data.push((element/2).toFixed(3));
        dailyIncomesChartData.datasets[0].backgroundColor.push('rgb(178,94,237)');
        dailyIncomesChartData.datasets[0].hoverBackgroundColor.push('rgb(158,74,217)');
    });

    var ctxDailyIncomes = document.getElementById('daily-incomes-chart').getContext('2d');
    var dailyIncomesChart = new Chart(ctxDailyIncomes, {
        type: 'bar',
        data: dailyIncomesChartData,
        options: {
        }
    });

    fortnightsIncomesChartData = {
        labels:[],
        datasets: [{
            axis: 'y',
            data: [],
            backgroundColor: [],
            hoverBackgroundColor: []
        }]
    };

    fortnightsCount = 0;

    Object.values(fortnightsIncomes).forEach(fortnightIncomes => {
        if (Object.values(fortnightIncomes).length > 0) {
            fortnightsIncomesChartData.datasets[0].data.push((fortnightIncomes[0]['total_usd_cammodel']).toFixed(3));
            if (fortnightsCount == 0) {
                fortnightsIncomesChartData.labels.unshift('Actual');
            } else{
                fortnightsIncomesChartData.labels.unshift('Pasada');
            }
            fortnightsCount = fortnightsCount + 1;
        }
    });

    var ctxFortnightsIncomes = document.getElementById('fortnights-incomes-chart').getContext('2d');
    var fortnightsIncomesChart = new Chart(ctxFortnightsIncomes, {
        type: 'bar',
        data: fortnightsIncomesChartData,
        options: {
            indexAxis: 'y',
        }
    });

    newData = fortnightsIncomesChartData.datasets[0].data;

    newProgressChartData = {
        labels:[],
        datasets: [{
            label: 'Progreso',
            data: [],
            fill: false,
            borderColor: 'rgb(169, 255, 162)',
            backgroundColor: 'rgb(169, 255, 162)',
            borderWidth: 2,
            tension: 0.1
        },
        {
            label: 'Esperado',
            data: [0, 50, 90, 220, 440],
            fill: false,
            borderColor: 'rgb(201, 255, 251)',
            backgroundColor: 'rgb(201, 255, 251)',
            borderWidth: 2,
            tension: 0.1
        }]
    };

    newProgressChartData.datasets[0].data = [0].concat(newData);
    newProgressChartData.datasets[0].data.backgroundColor = 'rgba(0, 0, 0, 0.0)';
    newProgressChartData.labels = ['0', '15', '30', '45', '60'];

    var newProgressCtx = document.getElementById('60-progress-chart').getContext('2d');
    var newProgressChart = new Chart(newProgressCtx, {
        type: 'line',
        data: newProgressChartData,
        options: {
            indexAxis: 'y',
        }
    });

    function changeGraph(showElement, hideElement){
        document.getElementById(showElement).style.display = 'inline';
        document.getElementById(hideElement).style.display = 'none';
    }

</script>
