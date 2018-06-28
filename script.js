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
        datasets: []
    },
    options: {
        scales: {
            xAxes: [{
                type: 'time',
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Date'
                }
            }],
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

M.Modal.init(document.getElementById('about'), {});
M.Modal.init(document.getElementById('filters'), {});
document.addEventListener('DOMContentLoaded', function() {
    M.FormSelect.init(document.querySelectorAll('select'));
});


function addPlayer (name)
{
    const req = new XMLHttpRequest();

    req.onreadystatechange = function(event) {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            var data = JSON.parse(this.responseText);
            var color = window.chartColors[chart.data.datasets.length % window.chartColors.length];

            var points = [];
            data.forEach (function (info) {
                points.push({
                    x: info['date'],
                    y: info['rank']
                });
            });

            if (points.length == 0) {
                M.toast({html: 'Player '+name+' not found!'});
            }
            else {
                chart.data.datasets.push({
                    label: name,
                    data: points,
                    backgroundColor: color,
                    borderColor: color,
                    fill: false,
                    lineTension: 0
                });
                chart.update();

                M.toast({html: 'Player '+name+' added!'});
            }
        }
    };

    req.open('GET', 'api/ranks.php?pseudo='+name, true);
    req.send(null);
}
