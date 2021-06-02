var barChartData = {
    labels: ["a","b","c","d","e","f","g"],
    datasets: [{
        type: 'bar',
        label: 'Label 1',
        backgroundColor: 'rgb(255, 99, 132)',
        borderColor: 'rgb(323, 5, 1221)',
        hoverBorderColor: 'rgb(1111, 111, 00000  )',
        data: [5, 6, 7, 8, 9, 10, 11],
        borderWidth: 1,
        pointRadius: 0,
        fill: true,
        yAxisID: 'y-axis-1'
    }, {
        type: 'line',
        label: 'Label 2',
        backgroundColor: 'rgba(99, 132, 0, 0.6)',
        borderColor: 'rgb(323, 5, 1221)',
        hoverBorderColor: 'rgb(1111, 111, 00000  )',
        data:
            [43, 92, 44, 52, 68, 71, 84],
        options: {
            scales: {
                xAxes: [{
                    ticks: {
                        max: 10,
                        min: 0,
                        stepSize: 0.5
                    }
                }]
            }
        },
        borderWidth: 1,
        pointRadius: 0,
        fill: true,
        yAxisID: 'y-axis-2'
    }, ]
};
window.onload = function() {
    var ctx = document.getElementById("myChart").getContext("2d");
    window.myBar = new Chart(ctx, {
        type: 'bar',
        data: barChartData,
        options: {
            legend: {
                display: true,
            },
            responsive: true,
            tooltips: {
                mode: 'label'
            },
            elements: {
                line: {
                    fill: false
                }
            },
            scales: {
                xAxes: [{
                    display: true,
                    gridLines: {
                        display: false
                    },
                    labels: {
                        show: true,
                    }
                }],
                yAxes: [{
                    type: "linear",
                    display: true,
                    position: "left",
                    id: "y-axis-1",
                    gridLines:{
                        display: true
                    },
                    labels: {
                        show: true,

                    }
                }, {
                    type: "linear",
                    display: true,
                    position: "right",
                    id: "y-axis-2",
                    gridLines:{
                        display: false
                    },
                    labels: {
                        show: true,

                    }
                }]
            }
        }
    });
};
