/*if(typeof(EventSource) !== "undefined") {
    var source = new EventSource("http://vmzakova.fei.stuba.sk/sse/sse.php");

    source.addEventListener("message", function(e) {
        var data = JSON.parse(e.data);
        //document.getElementById("result").innerHTML = e.data;


        console.log(data);
    }, false);

} else {
    document.getElementById("result").innerHTML = "Sorry, your browser does not support server-sent events...";
}*/


document.addEventListener("DOMContentLoaded",  (e) => {
    var ctx = document.getElementById('myChart').getContext('2d');
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',
        // The data for our dataset
        data: {
            labels: [],
            datasets: [{
                label: false,
                backgroundColor: 'rgb(124, 66, 23)',
                borderColor: 'rgb(387, 34, 55)',
                data: [],
                fill: false,
                hidden: false
            }, {
                label: 'My First dataset',
                backgroundColor: 'rgb(111, 222, 56)',
                borderColor: 'rgb(12, 2, 345)',
                data: [],
                fill: false
            }]
        },

        // Configuration options go here
        options: {
            legend: {
                display: false
            },
            plugins: {
                zoom: {
                    // Container for pan options
                    pan: {
                        // Boolean to enable panning
                        enabled: true,

                        // Panning directions. Remove the appropriate direction to disable
                        // Eg. 'y' would only allow panning in the y direction
                        // A function that is called as the user is panning and returns the
                        // available directions can also be used:
                        //   mode: function({ chart }) {
                        //     return 'xy';
                        //   },
                        mode: 'xy',

                        rangeMin: {
                            // Format of min pan range depends on scale type
                            x: null,
                            y: null
                        },
                        rangeMax: {
                            // Format of max pan range depends on scale type
                            x: null,
                            y: null
                        },

                        // On category scale, factor of pan velocity
                        speed: 20,

                        // Minimal pan distance required before actually applying pan
                        threshold: 10,

                        // Function called while the user is panning
                        onPan: function({chart}) { console.log(`I'm panning!!!`); },
                        // Function called once panning is completed
                        onPanComplete: function({chart}) { console.log(`I was panned!!!`); }
                    },

                    // Container for zoom options
                    zoom: {
                        // Boolean to enable zooming
                        enabled: true,

                        // Enable drag-to-zoom behavior
                        drag: true,

                        // Drag-to-zoom effect can be customized
                        // drag: {
                        // 	 borderColor: 'rgba(225,225,225,0.3)'
                        // 	 borderWidth: 5,
                        // 	 backgroundColor: 'rgb(225,225,225)',
                        // 	 animationDuration: 0
                        // },

                        // Zooming directions. Remove the appropriate direction to disable
                        // Eg. 'y' would only allow zooming in the y direction
                        // A function that is called as the user is zooming and returns the
                        // available directions can also be used:
                        //   mode: function({ chart }) {
                        //     return 'xy';
                        //   },
                        mode: 'xy',

                        rangeMin: {
                            // Format of min zoom range depends on scale type
                            x: null,
                            y: null
                        },
                        rangeMax: {
                            // Format of max zoom range depends on scale type
                            x: null,
                            y: null
                        },

                        // Speed of zoom via mouse wheel
                        // (percentage of zoom on a wheel event)
                        speed: 0.1,

                        // Minimal zoom distance required before actually applying zoom
                        threshold: 2,

                        // On category scale, minimal zoom level before actually applying zoom
                        sensitivity: 3,

                        // Function called while the user is zooming
                        onZoom: function({chart}) { console.log(`I'm zooming!!!`); },
                        // Function called once zooming is completed
                        onZoomComplete: function({chart}) { console.log(`I was zoomed!!!`); }
                    }
                }
            }
        }
    });
    sinCheckBox(chart);
    cosCheckBox(chart);
    //chart.data.datasets[0].hidden = !chart.data.datasets[0].hidden;
    if(typeof(EventSource) !== "undefined") {
        var source = new EventSource("http://vmzakova.fei.stuba.sk/sse/sse.php");
        sinCheckBox(chart);
        cosCheckBox(chart);
        source.addEventListener("message", (e) => {
            sinCheckBox(chart);
            cosCheckBox(chart);
            if(stopValue === true){
                return false;
            } else {
                var data = JSON.parse(e.data);
                document.getElementById("result").innerHTML = e.data;
                if(document.getElementById('defaultCheck1').checked){
                    chart.data.labels.push(data.x);
                    chart.data.datasets[0].data.push((data.y1) * (document.getElementById('slidervalue').value));
                    chart.data.datasets[1].data.push((data.y2) * (document.getElementById('slidervalue').value));
                    chart.update();
                    sinCheckBox(chart);
                    cosCheckBox(chart);
                } else if(document.getElementById('defaultCheck2').checked) {
                    chart.data.labels.push(data.x);
                    chart.data.datasets[0].data.push((data.y1) * (document.getElementById('slidervalue').value));
                    chart.data.datasets[1].data.push((data.y2) * (document.getElementById('slidervalue').value));
                    chart.update();
                    sinCheckBox(chart);
                    cosCheckBox(chart);
                } else {
                    chart.data.labels.push(data.x);
                    //chart.data.labels.push(data.y);
                    chart.data.datasets[0].data.push(data.y1);
                    chart.data.datasets[1].data.push(data.y2);
                    chart.update();
                    sinCheckBox(chart);
                    cosCheckBox(chart);
                }
            }
        }, false);

    } else {
        document.getElementById("result").innerHTML = "Sorry, your browser does not support server-sent events...";
    }

});

function sinCheckBox(chart){
    const value = document.getElementById('inlineCheckbox1');
    if(value.checked){
        chart.data.datasets[0].hidden = false;
    } else {
        chart.data.datasets[0].hidden = true;
       // chart.data.datasets.visibility = 'none'
    }
}
function cosCheckBox(chart){
    const value = document.getElementById('inlineCheckbox2');
    if(value.checked){

    } else {
        chart.data.datasets[1].hidden = !chart.data.datasets[1].hidden;
        // chart.data.datasets.visibility = 'none'
    }
}

var stopValue = false;
function stopButton(){
    if(stopValue === false){
        stopValue = true;
    } else {
        stopValue = false;
    }
}

function numCheck(){
    const value = document.getElementById('defaultCheck1');
    if(value.checked){
        document.getElementById('numberInput').style.display = 'block';
    } else {
        document.getElementById('numberInput').style.display = 'none';
    }
}

function slideCheck(){
    const value = document.getElementById('defaultCheck2');
    if(value.checked){
        document.getElementById('sliderInput').style.display = 'block';
    } else {
        document.getElementById('sliderInput').style.display = 'none';
    }
}


