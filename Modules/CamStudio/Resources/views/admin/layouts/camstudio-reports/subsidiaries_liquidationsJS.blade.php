<script>
    subsidiaryIncomesChartData = {
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

    subsidiariesArray = Object.values(subsidiaryLiquidations);
    subsidiariesArray.sort(function(a,b) {
        return b['second_month_usd'] - a['second_month_usd'];
    });

    subsidiariesArray.forEach(subsidiaryLiquidations => {
        subsidiaryIncomesChartData.labels.push(subsidiaryLiquidations['subsidiary_name']);
        subsidiaryIncomesChartData.datasets[0].data.push((subsidiaryLiquidations['first_month_usd']).toFixed(3));
        subsidiaryIncomesChartData.datasets[1].data.push((subsidiaryLiquidations['second_month_usd']).toFixed(3));
    });
    
    document.getElementById("subsidiary-chart").style.height = (((subsidiariesArray.length / 4) * 250) + 20).toFixed(0) < 200 ?
        '200px' : (((subsidiariesArray.length / 4) * 250) + 20).toFixed(0) + 'px';

    var subsidiaryChartCtx = document.getElementById('months-subsidiary-chart').getContext('2d');

    var monthsIncomesChart = new Chart(subsidiaryChartCtx, {
        type: 'horizontalBar',
        data: subsidiaryIncomesChartData,
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
