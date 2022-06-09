<script>
    followers_data = [];

    streamingChartData = {
        labels: [],
        datasets: []
    };

    cammodelStreamingStats.forEach(streamingStat => {
        followers_data.push(streamingStat['num_followers']);
        current_date = new Date(streamingStat['created_at']);
        current_day = current_date.getDate();
        streamingChartData.labels.push(current_day);
    });

    streamingChartData.datasets.push({
        label: cammodelStreamingIncomes['0']['cammodel']['name'],
        fillColor: 'rgba(255,138,194,0.2)',
        strokeColor: 'rgb(255,138,194)',
        borderColor: 'rgb(255,138,194)',
        borderWidth: 2,
        pointColor: 'rgb(255,138,194)',
        pointStrokeColor: '#fff',
        pointHighlightFill: '#fff',
        pointBackgroundColor: 'rgb(255,138,194)',
        pointHighlightStroke: 'rgb(255,138,194)',
        data: followers_data
    });

    var ctxstreamings = document.getElementById('streaming-stats-chart').getContext('2d');
    var streamingStatsChart = new Chart(ctxstreamings, {
        type: 'line',
        data: streamingChartData,
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

</script>
