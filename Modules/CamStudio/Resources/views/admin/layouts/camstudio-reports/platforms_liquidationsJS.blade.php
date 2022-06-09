<script>
    platformsIncomesChartData = {
        labels:[],
        datasets: [{
            label: periodMonths[3],
            data: [],
            borderColor: 'rgb(255, 99, 132)',
            backgroundColor: 'rgba(255, 99, 132, 0.2)'
        }, {
            label: periodMonths[2],
            data: [],
            fill: false,
            borderColor: 'rgb(54, 162, 235)'
        }]
    };

    platformsArray = Object.values(platformsLiquidations);
    platformsArray.sort(function(a,b) {
        return b['second_month_usd'] - a['second_month_usd'];
    });

    platformsArray.forEach(platformsLiquidations => {
        platformsIncomesChartData.labels.push(platformsLiquidations['platform_name']);
        platformsIncomesChartData.datasets[0].data.push((platformsLiquidations['first_month_usd']).toFixed(3));
        platformsIncomesChartData.datasets[1].data.push((platformsLiquidations['second_month_usd']).toFixed(3));
    });
    
    document.getElementById("platforms-chart").style.height = (((platformsArray.length / 4) * 250) + 20).toFixed(0) < 200 ?
        '200px' : (((platformsArray.length / 4) * 250) + 20).toFixed(0) + 'px';

    var platformsChartCtx = document.getElementById('months-platforms-chart').getContext('2d');

    var platformsIncomesChart = new Chart(platformsChartCtx, {
        type: 'horizontalBar',
        data: platformsIncomesChartData,
        options: {
            maintainAspectRatio: false,
            scales: {
                xAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }],
            }
        }
    });

</script>
