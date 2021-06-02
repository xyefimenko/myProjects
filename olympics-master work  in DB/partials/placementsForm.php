

<div class="container" id="formContainer">
    <form method="post" action="editPerson.php">

        <input type="hidden" name="id" value="<?php echo isset($person) ? $person->getId() : null ?>">

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" value="<?php echo isset($person) ? $person->getName() : null ?>" id="name">
        </div>

        <div class="form-group">
            <label for="surname">Surname</label>
            <input type="text" name="surname" value="<?php echo isset($person) ? $person->getSurname() : null ?>" id="surname">
        </div>

        <div class="form-group">
            <label for="ohId">Olympic Game ID</label>
            <input type="number" name="ohId" value="<?php echo isset($person) ? $person->getSurname() : null ?>" id="ohId">
        </div>

        <div class="form-group">
            <label for="placing">Placing</label>
            <input type="number" name="placing" value="<?php echo isset($person) ? $person->getName() : null ?>" id="placing">
        </div>

        <div class="form-group">
            <label for="discipline">Discipline</label>
            <input type="text" name="discipline" value="<?php echo isset($person) ? $person->getSurname() : null ?>" id="discipline">
        </div>

        <input type="submit">
    </form>
</div>
