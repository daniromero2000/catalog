<script>
    doughnutChartData = {
        labels:[
            'Acumulado',
            'Restante para la meta'
        ],
        datasets: []
    };

    actual = (cammodelStreamingIncomes['0']['usd_cammodel'] / 2).toFixed(2);
    goal = cammodelStreamingIncomes['0']['cammodel']['shift']['goal']['usd_goal'] * 1;
    remaining = actual >= goal ? 0 : (goal - actual).toFixed(2);
    fill_color = actual < 90 ? 'rgb(250,75,75)' : (actual < 220 ? 'rgb(255,184,77)' : (actual < goal ? 'rgb(255,255,128)': 'rgb(140,255,102)'));

    doughnutChartData.datasets.push({
        data: [actual, remaining],
        borderAlign: 'center',
        borderColor: ['#cccccc','#cccccc'],
        backgroundColor: [fill_color,'rgb(220,220,220)'],
        borderWidth: 2,
    });

    var ctxincomes = document.getElementById('streaming-incomes-chart').getContext('2d');
    ctxincomes.fillStyle = "red";
    ctxincomes.textAlign = "center";
    ctxincomes.fillText("Hello World", document.getElementById('streaming-incomes-chart').width/2, document.getElementById('streaming-incomes-chart').height/2);
    var myChart = new Chart(ctxincomes, {
        type: 'doughnut',
        data: doughnutChartData,
        options: {
            cutoutPercentage: 50,
        }
    });

    barChartData = {
        labels:[],
        datasets: [{
            data: [],
            backgroundColor: [],
            hoverBackgroundColor: []
        }]
    };

    bestPlatform = cammodelStreamingIncomes['0']['incomes']['0'];
    worstPlatform = cammodelStreamingIncomes['0']['incomes']['0'];

    cammodelStreamingIncomes['0']['incomes'].forEach(element => {
        if(parseFloat(element['accumulated_dollars']) > parseFloat(bestPlatform['accumulated_dollars'])){
            bestPlatform = element;
        }
        if(parseFloat(element['accumulated_dollars']) < parseFloat(worstPlatform['accumulated_dollars'])){
            worstPlatform = element;
        }
        barChartData.labels.push(element['cammodel_stream_account']['streaming']['streaming']);
        barChartData.datasets[0].data.push(element['accumulated_dollars']/2);
        barChartData.datasets[0].backgroundColor.push(modelRGBGenerator(2 * element['cammodel_stream_account']['streaming']['id']));
        barChartData.datasets[0].hoverBackgroundColor.push(modelRGBGenerator(3 * element['cammodel_stream_account']['streaming']['id']));
    });

    document.getElementById('best-platform').innerHTML = bestPlatform['cammodel_stream_account']['streaming']['streaming'];
    if (bestPlatform['cammodel_stream_account']['streaming']['streaming'] == worstPlatform['cammodel_stream_account']['streaming']['streaming']) {
        document.getElementById('worst-platform').innerHTML = '----';
    } else{
        document.getElementById('worst-platform').innerHTML = worstPlatform['cammodel_stream_account']['streaming']['streaming'];
    }

    var ctx2 = document.getElementById('streamings-incomes-chart').getContext('2d');
    var myChart2 = new Chart(ctx2, {
        type: 'bar',
        data: barChartData,
        options: {
        }
    });

    function modelRGBGenerator(id) {
        const hue = id * 137.508;
        return `hsl(${hue},80%,65%)`;
    }
</script>