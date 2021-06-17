var ctx1 = document.getElementById('positionsToUserChart');
var ctx2 = document.getElementById('subjectsToUserChart');
var myChart1 = new Chart(ctx1, {
    type: 'doughnut',
    data: {
      labels: ['OK', 'WARNING', 'CRITICAL', 'UNKNOWN'],
      datasets: [{
        label: '# of Tomatoes',
        data: [12, 19, 3, 5],
        backgroundColor: [
          'rgba(255, 99, 132, 0.5)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)'
        ],
      }]
    },
    options: {
         //cutoutPercentage: 40,
      responsive: true,
  
    }
});

var myChart2 = new Chart(ctx2, {
    type: 'doughnut',
    data: {
      labels: ['OK', 'WARNING', 'CRITICAL', 'UNKNOWN'],
      datasets: [{
        label: '# of Tomatoes',
        data: [12, 19, 3, 5],
        backgroundColor: [
          'rgba(255, 99, 132, 0.5)',
          'rgba(54, 162, 235, 0.2)',
          'rgba(255, 206, 86, 0.2)',
          'rgba(75, 192, 192, 0.2)'
        ],
      }]
    },
    options: {
         //cutoutPercentage: 40,
      responsive: true,
  
    }
});