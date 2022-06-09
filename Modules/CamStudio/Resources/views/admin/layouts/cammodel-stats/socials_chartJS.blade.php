<script>
    if(cammodelSocialStats != 0){

        followers_data2 = [];

        socialChartData = {
            labels: [],
            datasets: []
        };

        cammodelSocialStats.forEach(socialStat => {
            followers_data2.push(socialStat['followers_count']);
            current_date = new Date(socialStat['created_at']);
            current_day = current_date.getDate();
            socialChartData.labels.push(current_day);
        });

        socialChartData.datasets.push({
            label: cammodelStreamingIncomes['0']['cammodel']['name'],
            fillColor: 'rgba(138,255,236,0.2)',
            strokeColor: 'rgb(138,255,236)',
            borderColor: 'rgb(138,255,236)',
            borderWidth: 2,
            pointColor: 'rgb(138,255,236)',
            pointStrokeColor: '#fff',
            pointHighlightFill: '#fff',
            pointBackgroundColor: 'rgb(138,255,236)',
            pointHighlightStroke: 'rgb(138,255,236)',
            data: followers_data2
        });

        var ctxsocials = document.getElementById('social-stats-chart').getContext('2d');
        var socialStatsChart = new Chart(ctxsocials, {
            type: 'line',
            data: socialChartData,
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
    }

</script>
