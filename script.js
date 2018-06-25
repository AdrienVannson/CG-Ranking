window.chartColors = [
    'rgb(255, 99, 132)',
    'rgb(255, 159, 64)',
    'rgb(255, 205, 86)',
    'rgb(75, 192, 192)',
    'rgb(54, 162, 235)',
    'rgb(153, 102, 255)',
    'rgb(201, 203, 207)'
];

var chart = new Chart(document.getElementById('chart').getContext('2d'), {
    type: 'line',
    data: {
        //labels: ['1', '2', '3', '4', '5', '6', '7'],
        datasets: []
    },
    options: {
        scales: {
            yAxes: [{
                ticks: {
                    reverse: true
                }
            }]
        },
        tooltips: {
            mode: 'index',
            intersect: false,
        }
    }
});


function addPlayer (name)
{
    const req = new XMLHttpRequest();

    req.onreadystatechange = function(event) {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            var data = JSON.parse(this.responseText);
            var color = window.chartColors[chart.data.datasets.length % window.chartColors.length];

            chart.data.datasets.push({
                label: name,
                data: data,
                backgroundColor: color,
                borderColor: color,
                fill: false
            });
            chart.update();

            M.toast({html: 'Player '+name+' added!'});
        }
    };

    req.open('GET', 'api/ranks.php?pseudo='+name, true);
    req.send(null);



}
