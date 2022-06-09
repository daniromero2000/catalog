<script>
    monthsIncomesChartData = {
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

    liquidationsArray = Object.values(compoundLiquidations);
    liquidationsArray.sort(function(a,b) {
        return b['actual_month_usd'] - a['actual_month_usd'];
    });

    liquidationsArray.forEach(cammodelLiquidations => {
        monthsIncomesChartData.labels.push(cammodelLiquidations['cammodel']['nickname']);
        monthsIncomesChartData.datasets[0].data.push((cammodelLiquidations['past_month_usd']).toFixed(3));
        monthsIncomesChartData.datasets[1].data.push((cammodelLiquidations['actual_month_usd']).toFixed(3));
    });
    
    document.getElementById("liquidations-chart").style.height = (((liquidationsArray.length / 8) * 250) + 20).toFixed(0) < 200 ?
        '200px' : (((liquidationsArray.length / 8) * 250) + 20).toFixed(0) + 'px';

    var ctx = document.getElementById('months-liquidations-chart').getContext('2d');

    var monthsIncomesChart = new Chart(ctx, {
        type: 'horizontalBar',
        data: monthsIncomesChartData,
        options: {
            maintainAspectRatio: false,
            scales: {
                xAxes: [{
                    position: 'top',
                }],
            }
        }
    });

</script>
