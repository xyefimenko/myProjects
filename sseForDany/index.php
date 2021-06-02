<?php
require_once "controllers/Controller.php";
session_start();

$controller = new Controller();
$controller->insertSessionDataWithType(session_id(), 1, "All");
//$session = $controller->getSession(session_id());
//echo $session['num']. " ";
//var_dump($_SESSION);
//var_dump($_POST);
if (!empty($_POST)){
    $_SESSION["select"] = $_POST["select"];
    $controller->updateSessionType(session_id(), $_POST["select"]);
} else {
    $_POST["select"] = $controller->getSessionType(session_id());
}
//var_dump($_SESSION);
//
//print_r($_COOKIE);
//echo session_id();

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<!--    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">-->
<!--    <meta http-equiv="X-UA-Compatible" content="ie=edge">-->
    <title>Zadanie5PHP</title>
    <link rel="stylesheet" href="styles/style.css">
</head>
<body>

<header>
    <h1>Zadanie 3 PHP</h1>
</header>

<div id="formContainer">
    <h1>Graph paints for <?php if (!empty($_POST)){echo $_POST["select"];} else{echo "ALL";}?> function(s)</h1>
    <div id="result"></div>

    <div class="form-group">
        <input type="number" name="newParameter" id="newPar" class="form-control" placeholder="Enter your parameter">
    </div>
    <button id="sendParameter" type="submit"  class="btn btn-primary">Send Parameter</button>
    <div id="out"></div>

    <form method="post">
        <select id="select" name="select">
            <option>All</option>
            <option>Y1</option>
            <option>Y2</option>
            <option>Y3</option>
        </select>
        <button id="sendSelect" type="submit" class="btn btn-dark">Submit Function</button>
    </form>

</div>

<div class="container">

    <div>
        <canvas id="myChart"></canvas>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.5.0/Chart.min.js"></script>-->

    <script rel="script">
        document.addEventListener("DOMContentLoaded",  (e) => {
            var ctx = document.getElementById("myChart");
            var chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: [],
                    datasets: [{
                        label: "Y1 = sin2 (ax)",
                        backgroundColor: 'rgb(124, 66, 23)',
                        borderColor: 'rgb(387, 34, 55)',
                        data: [],
                        fill: false,
                        hidden: false
                    }, {
                        label: "Y2 = cos2 (ax)",
                        backgroundColor: 'rgb(111, 222, 56)',
                        borderColor: 'rgb(12, 22, 35)',
                        data: [],
                        fill: false
                    }, {
                        label: "Y3 = sin(ax)*cos(ax)",
                        backgroundColor: 'rgb(387, 34, 55)',
                        borderColor: 'rgb(12, 2, 345)',
                        data: [],
                        fill: false
                    }]
                },
                options: {
                    scales: {
                        yAxes: [{
                            ticks: {
                                beginAtZero:true
                            }
                        }]
                    }
                }
            });

            let select = "<?php echo $_POST["select"]; ?>";

            var source = new EventSource("sse.php");
            source.addEventListener('webteEvent', function (event) {

                let data = JSON.parse(event.data);
                console.log(data);
                document.getElementById("result").innerHTML = "id: " + data.id + "<br>";
                document.getElementById("result").innerHTML = "x: " + data.id + "<br>";
                document.getElementById("result").innerHTML = "sin: " + data.sin + "<br>";
                document.getElementById("result").innerHTML += "cos: " + data.cos + "<br>";
                document.getElementById("result").innerHTML = "parameter: " + data.parameter + "<br>";

                switch (select){
                    case 'All':
                        chart.data.labels.push(data.y1);
                        chart.data.labels.push(data.y2);
                        chart.data.labels.push(data.y3);

                        chart.data.datasets[0].data.push(data.y1);
                        chart.data.datasets[1].data.push(data.y2);
                        chart.data.datasets[2].data.push(data.y3);
                        chart.update();
                        break;
                    case 'Y1':
                        chart.data.labels.push(data.y1);

                        chart.data.datasets[0].data.push(data.y1);
                        chart.update();
                        break;
                    case 'Y2':
                        chart.data.labels.push(data.y2);

                        chart.data.datasets[1].data.push(data.y2);
                        chart.update();
                        break;
                    case 'Y3':
                        chart.data.labels.push(data.y3);

                        chart.data.datasets[2].data.push(data.y3);
                        chart.update();
                        break;
                }
            });

            document.querySelector("#sendParameter").addEventListener('click', () =>{
                let inputData = document.querySelector("#newPar").value;
                // document.querySelector("#out").innerHTML = inputData;

                let data ={
                    parameter: inputData,
                };

                fetch("parameter.php",{
                    method: 'POST',
                    body: JSON.stringify(data)
                }).then(response => response.json())
                    .then(data => {
                        console.log('Success:', data);
                    })
            });
        });
    </script>

</div>


<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<br><br><br><br>
<footer>
    @Created by Denys Yefimenko
</footer>

</body>
</html>
