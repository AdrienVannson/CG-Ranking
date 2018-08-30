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
                },
                time: {
                    unit: 'day'
                }
            }],
            yAxes: [{
                ticks: {
                    reverse: true,
                    min: 1
                }
            }]
        },
        tooltips: {
            mode: 'index',
            intersect: false,
            callbacks: {
                label: function (tooltipItems, data) {
                    var playerIndex = tooltipItems.datasetIndex;
                    var rankIndex = tooltipItems.index;

                    var rank = data.datasets[playerIndex].data[rankIndex].y;
                    var pseudo = data.datasets[playerIndex].label;

                    var res = pseudo + ': ' + rank;
                    if (document.getElementById('showAgentID').checked) {
                        res += ' (' + agentsIDs[playerIndex][rankIndex] + ')';
                    }
                    return res;
                },
            }
        }
    }
});

var agentsIDs = [];
var players = [];

document.addEventListener('DOMContentLoaded', function() {
    M.Modal.init(document.getElementById('about'), {});
    M.Modal.init(document.getElementById('filters'), {});

    M.FormSelect.init(document.querySelectorAll('select'));

    M.FloatingActionButton.init(document.querySelectorAll('.fixed-action-btn'));
});


function addPlayer (name)
{
    if (players.indexOf(name) != -1) {
        M.toast({html: 'Player '+name+' is already displayed!'});
        return;
    }

    const req = new XMLHttpRequest();

    req.onreadystatechange = function(event) {
        if (this.readyState === XMLHttpRequest.DONE && this.status === 200) {
            var data = JSON.parse(this.responseText);
            var color = window.chartColors[chart.data.datasets.length % window.chartColors.length];

            playerAgentsIDs = [];

            var points = [];
            data.forEach (function (info) {
                points.push({
                    x: info['date'],
                    y: info['rank']
                });

                playerAgentsIDs.push(info['agentID']);
            });

            if (points.length == 0) {
                M.toast({html: 'Player '+name+' not found!'});
            }
            else {
                agentsIDs.push(playerAgentsIDs);

                chart.data.datasets.push({
                    label: name,
                    data: points,
                    backgroundColor: color,
                    borderColor: color,
                    fill: false,
                    lineTension: 0,
                    pointRadius: 0
                });
                chart.update();

                players.push(name);

                M.toast({html: 'Player '+name+' added!'});
            }
        }
    };

    var game = document.getElementById('game').value;
    var hideInProgress = document.getElementById('hideInProgress').checked;

    req.open('GET', 'api/ranks.php?pseudo=' + name
                               + '&game=' + game
                               + '&hideInProgress=' + hideInProgress,
    true);

    req.send(null);
}
