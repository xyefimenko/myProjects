
<div class="container" id="ttt">
    <h1 style="text-align: center; padding-top: 200px">Change Info</h1>
    <form method="post" action="editPerson.php">

        <input type="hidden" name="id" value="<?php echo isset($person) ? $person->getId() : null ?>">

        <label for="name">Name</label>
        <input type="text" name="name" value="<?php echo isset($person) ? $person->getName() : null ?>" id="name">

        <label for="surname">Surname</label>
        <input type="text" name="surname" value="<?php echo isset($person) ? $person->getSurname() : null ?>" id="surname">

        <input class="btn btn-dark" type="submit">
    </form>


</div>
