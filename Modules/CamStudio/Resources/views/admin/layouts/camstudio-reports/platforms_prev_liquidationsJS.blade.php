<script>
    platformsPrevIncomesChartData = {
        labels:[],
        datasets: [{
            label: 'Quincena anterior',
            data: [],
            fill: false,
            borderColor: 'rgb(54, 162, 235)'
        }]
    };

    platformsPrevArray = Object.values(platformsPrevLiquidations);
    platformsPrevArray.sort(function(a,b) {
        return b['first_month_usd'] - a['first_month_usd'];
    });

    platformsPrevArray.forEach(platformsPrevLiquidations => {
        platformsPrevIncomesChartData.labels.push(platformsPrevLiquidations['platform_name']);
        platformsPrevIncomesChartData.datasets[0].data.push((platformsPrevLiquidations['first_month_usd']).toFixed(3));
    });
    
    document.getElementById("platforms-prev-chart").style.height = (((platformsPrevArray.length / 4) * 250) + 20).toFixed(0) < 200 ?
        '200px' : (((platformsPrevArray.length / 4) * 250) + 20).toFixed(0) + 'px';

    var platformsPrevChartCtx = document.getElementById('prev-platforms-chart').getContext('2d');

    var platformsPrevIncomesChart = new Chart(platformsPrevChartCtx, {
        type: 'horizontalBar',
        data: platformsPrevIncomesChartData,
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
