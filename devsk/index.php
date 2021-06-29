<?php
require_once "/home/xyefimenko/public_html/devsk/classes/controllers/Controller.php";


$controller = new Controller();
$allBooks = $controller->getAllBooks();
$allAuthors = $controller->getAllAuthors();
//var_dump($allAuthors);


?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
<!--    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">-->
<!--    <meta http-equiv="X-UA-Compatible" content="ie=edge">-->
    <title>Kniznica</title>
    <link rel="stylesheet" href="styles/style.css">
    <script rel="script" src="js/jvaScript.js"></script>
</head>
<body>

<header>
    <h1>Wireframe</h1>
 </header>

<div class="container">
    <h1><b>Knižnica</b></h1>
    <form action="addBook.php" id="add-book" method="post">
        <div class="input-group mb-3">
    <!--        <span class="input-group-text" >Default</span>-->
            <input type="text" class="form-control" name="name" placeholder="Názov knihy" aria-label="Názov knihy" required>
        </div>
        <div class="input-group mb-3">
            <input type="text" class="form-control" placeholder="ISBN" name="isbn" aria-label="ISBN" required>
    <!--        <span class="input-group-text">@</span>-->
            <input type="number" class="form-control" placeholder="Cena" name="price" aria-label="Cena" step="any" required>
        </div>
        <div class="input-group mb-3">
            <select class="form-control" name="category" aria-label="Default select example" required>
                <option value="">Kategoria</option>
                <option value="1">Román</option>
                <option value="2">Triler</option>
                <option value="3">Fantasy</option>
            </select>

            <input type="text" class="form-control" list="listit" placeholder="Autor" onkeyup="suggest(this.value)"  name="author" aria-label="Autor" required>
            <div id="suggest_container" style="display:inline-block;">
                <datalist id="listit">
                    <?php
                        foreach ($allAuthors as $author){
                            echo "<option>".$author["author"]."</option>";
                        }
                    ?>
                </datalist>
            </div>

        </div>

        <button id="expenses" type="submit" class="btn btn-primary">Pridať knihu do knižnice</button>
    </form>
</div>
<br>


<hr>

<div class="container">
    <table class="table" id="table">
        <thead>
        <tr>
            <th>#</th>
            <th scope="col">Názov knihy</th>
            <th scope="col">ISBN</th>
            <th scope="col">Cena</th>
            <th scope="col">Kategoria</th>
            <th scope="col">Autor</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $counter = 1;
        foreach ($allBooks as $book){
            echo "<tr><td>".$counter."</td><td>".$book["name"]."</td><td>".$book["isbn"]."</td><td>".$book["price"]."€</td><td>".$book["category"]."</td><td>".$book["author"]."</td></tr>";
            $counter++;
        }
        ?>
        </tbody>
    </table>

    <form action="download.php">
        <button id="expenses" type="submit" class="btn btn-primary">Stiahnuť JSON</button>
    </form>
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
