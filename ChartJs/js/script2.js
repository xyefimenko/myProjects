var chart = document.getElementById("myChart");


var vyska = {
    label: 'Vyska deti',
    backgroundColor: 'rgb(255, 99, 132)',
    borderColor: 'rgb(323, 5, 1221)',
    hoverBorderColor: 'rgb(1111, 111, 00000  )',
    data: [180, 176, 220, 149, 140, 200, 135],
    borderWidth: 0,
    yAxisID: "y-vyska-deti"
};

var bodStredny = {
    label: 'Stredny bod ziaka',
    data: [3.7, 1.9, 2.8, 1.7, 1.1, 1.0, 5.0],
    backgroundColor: 'rgba(99, 132, 0, 0.6)',
    borderColor: 'rgb(323, 5, 1221)',
    hoverBorderColor: 'rgb(1111, 111, 00000  )',
    borderWidth: 0,
    yAxisID: "y-ich stredny-bod"
};

var ziaci = {
    labels: ['Denis', 'Peter', 'Ivan', 'Michal', 'Zuzana', 'Klaudia', 'Julia'],
    datasets: [vyska, bodStredny]
};

var chartOptions = {
    scales: {
        xAxes: [{
            barPercentage: 1,
            categoryPercentage: 0.6
        }],
        yAxes: [{
            id: "y-vyska-deti"
        }, {
            id: "y-ich stredny-bod"
        }]
    }
};

var barChart = new Chart(chart, {
    type: 'bar',
    data: ziaci,
    options: chartOptions
});
