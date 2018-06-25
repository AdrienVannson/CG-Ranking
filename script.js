window.chartColors = {
  red: 'rgb(255, 99, 132)',
  orange: 'rgb(255, 159, 64)',
  yellow: 'rgb(255, 205, 86)',
  green: 'rgb(75, 192, 192)',
  blue: 'rgb(54, 162, 235)',
  purple: 'rgb(153, 102, 255)',
  grey: 'rgb(201, 203, 207)'
};

var myChart = new Chart(document.getElementById('chart').getContext('2d'), {
  type: 'line',
  data: {
    labels: ['1', '2', '3', '4', '5', '6', '7'],
    datasets: [
      {
        label: 'Player 1',
        data: [12, 19, 3, 5, 2, 3, 7],
        backgroundColor: window.chartColors.red,
        borderColor: window.chartColors.red,
        fill: false
      },
      {
        label: 'Player 2',
        data: [1, 5, 9, 10, 15, 10, 12],
        backgroundColor: window.chartColors.blue,
        borderColor: window.chartColors.blue,
        fill: false
      }
    ]
  },
  options: {
    scales: {
      yAxes: [{
        ticks: {
          reverse: true
        }
      }]
    }
  }
});


function addPlayer (name)
{
    M.toast({html: 'Player '+name+' added!'});
}
