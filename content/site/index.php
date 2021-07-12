 
<?php
    require './include/head.php';
?>

<div class="well well__search">
    <form action="/index.php" method="get" id="search">
        <input id="title" name="title" type="text" value="" placeholder="Game title...">
        <button type="submit" class="button button__primary">By title</button>
    </form>

    <form action="/index.php" method="get" id="searchG">
        <select id="genre" name="genre" form="searchG">
            <option value="" disabled selected hidden>Genre...</option>
            <option value="str">Strategy</option>
            <option value="rpg">Role-Playing Game</option>
            <option value="fps">First Person Shooter</option>
            <option value="sim">Simulation Game</option>
            <option value="???">Other</option>
        </select>
        <button type="submit" class="button button__primary">By genre</button>
    </form>
</div>

<?php

    //If i had more time, i would research dynamically assigning variables to prepared statements
    //So a user could filter by both title AND genre at the same time
    if (isset($_GET['title']) && $_GET['title'] !== '') {
        //It seems %'s are handled really strangely in prepared statements
        //It won't work unless I use the concat method - i guess theyre not being escaped properly?
        $_strGamesQuery = $_con->prepare('SELECT * FROM games WHERE title LIKE CONCAT(\'%\',?,\'%\')');
        $_strGamesQuery->bind_param('s', $_GET['title']);
    } else if (isset($_GET['genre']) && $_GET['genre'] !== '') {
        $_strGamesQuery = $_con->prepare('SELECT * FROM games WHERE genre = ?');
        $_strGamesQuery->bind_param('s', $_GET['genre']);
    } else {
        $_strGamesQuery = $_con->prepare('SELECT * FROM games');
    }

    $_strGamesQuery->bind_result($id, $title, $image, $genre, $rating);

    require './include/games.php';
    if (isset($_SESSION['is_admin'])) {
        echo '<div class="well well__search"><h2>Admin - Add a game</h2><form action="/addgame.php" method="post" id="formAdd"><input id="inputTitle" name="title" type="text" value="" placeholder="Game title..."><input id="inputImage" name="image" type="text" value="" placeholder="Image URL..."><select id="genre" name="genre" form="formAdd"><option value="str">Strategy</option><option value="rpg">Role-Playing Game</option><option value="fps">First Person Shooter</option><option value="sim">Simulation Game</option><option value="???">Other</option></select><input name="rating" type="number" id="inputRating" placeholder="0/100" min="0" max="100" required><button type="submit" class="button button__primary">Add</button></form></div>';
    }
    require './include/footer.php';
?>
