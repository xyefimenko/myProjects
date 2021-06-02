<?php
    require_once "classes/controller/ActionsController.php";
    $actionController = new ActionsController();
    $users = $actionController->getAllUsers();
    $lectures = $actionController->getAllLectures();
//    $actionController->howManyStudentOnLecture(17);
//    foreach ($users as $us){
//        echo $actionController->getLectureMinutes($us). " ";
//    }
//    $userAdam = $actionController->getUser(5500);
//    $actions = $actionController->getLectureMinutes($userAdam);
//    $actionController->findLastLeftTime();
foreach ($lectures as $l){
//    echo $actionController->howManyStudentOnLecture($l->getId()).", ";

}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Zadanie4PHP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.6.0/dist/umd/popper.min.js" integrity="sha384-KsvD1yqQ1/1+IA7gi3P0tyJcT3vR+NdBTt13hSJ2lnve8agRGXTTyNaBYmCR/Nwi" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.min.js" integrity="sha384-nsg8ua9HAw1y0W1btsyWgBklPnCUAFLuTMS2G72MMONqmOymq585AcH49TLBQObG" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="styles/style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script rel="script" src="js/jvaScript.js"></script>
    <link rel="stylesheet" href="styles/Chart.min.css">
    <script rel="script" src="js/Chart.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
    <script src="http://www.chartjs.org/assets/Chart.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>

    <link href="/css/bootstrap.min.css" rel="stylesheet">
        <script src="/jquery.min.js"></script>
    <link href="css/fileinput.css" media="all" rel="stylesheet" type="text/css"/>
        <script src="js/fileinput.min.js" rel="script"></script>
    <script>
        function getUpdateDbResponse(){
            document.querySelector("#loading").style.display = "block";
            fetch('updateDb.php')
                .then(
                    function(response) {
                        if (response.status !== 200) {
                            console.log('Looks like there was a problem. Status Code: ' +
                                response.status);
                            return;
                        }

                        // Examine the text in the response
                        response.json().then(function(data) {
                            console.log(data);
                            document.querySelector("#loading").style.display = "none";
                        });
                    }
                )
                .catch(function(err) {
                    console.log('Fetch Error :-S', err);
                });
        }
    </script>
</head>
<body>


<header>
    <h1>Zadanie 4 PHP</h1>
</header>

<div class="container">

    <div id="graph">
        <canvas id="myChart" ></canvas>
    </div>
    <script>
        var ctx = document.getElementById('myChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
                datasets: [{
                    label: '# of Votes',
                    data: [12, 19, 3, 5, 2, 3],
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>




    <h2>Table</h2>
    <button onclick="getUpdateDbResponse()">Update</button>
    <table class="table">
        <thead>
        <tr>

            <th scope="col">Name & Surname</th>
            <?php
                foreach ($lectures as $lecture){
                        echo "<th>".$lecture->getTimestamp()."</th>";
                }
            ?>
            <th scope="col">Celkovy pocet ucasti na prednaskaach</th>
            <th scope="col">Count of visits</th>

        </tr>
        </thead>
        <tbody>
            <?php
            //header("Location: index.php");
                foreach ($users as $user){
                    echo "<tr><td>".$user->getName()."</td>".$actionController->getLectureMinutes($user)."</tr>\n";
                        //<td>".$user->getTimestamp()."</td>
                }
            ?>
        </tbody>
    </table>

    <div id="loading" class="w-full h-full fixed hidden top-0 left-0 bg-white opacity-75 z-50">
        <span class="text-green-500 opacity-75 top-1/2 my-0 mx-auto block relative w-0 h-0" style="top: 50%"></span>
        <i class="fas fa-circle-notch fa-spin fa-5x"></i>
    </div>




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
