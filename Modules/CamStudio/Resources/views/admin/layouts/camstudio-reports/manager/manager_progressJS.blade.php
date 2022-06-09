<script>
    progressChartData = {
        labels:[
            'Acumulado',
            'Restante para la meta'
        ],
        datasets: []
    };

    actual     = (managerFortnightsIncomes[0] / 2).toFixed(2);
    goal       = parseFloat(managerKpi);
    remaining  = actual >= goal ? 0 : (goal - actual).toFixed(2);
    fill_color = actual < 90 ? 'rgb(250,75,75)' : (actual < 220 ? 'rgb(255,184,77)' : (actual < goal ? 'rgb(255,255,128)': 'rgb(140,255,102)'));

    progressChartData.datasets.push({
        data: [actual, remaining],
        borderAlign: 'center',
        borderColor: ['#cccccc','#cccccc'],
        backgroundColor: [fill_color,'rgb(220,220,220)'],
        borderWidth: 2,
    });

    var managerProgressCtx = document.getElementById('manager-progress-chart').getContext('2d');
    var myChart = new Chart(managerProgressCtx, {
        type: 'doughnut',
        data: progressChartData,
        options: {
            cutoutPercentage: 50,
        }
    });
    
</script>