<?php
    require './include/head.php';
    if (!isset($_SESSION['id'])) {
        return header('Location: index.php');
    }
    $_strGamesQuery = $_con->prepare('SELECT * FROM games WHERE id IN (SELECT game_id FROM bookmarks WHERE user_id = ?)');
    $_strGamesQuery->bind_param('s', $_SESSION['id']);
    $_strGamesQuery->bind_result($id, $title, $image, $genre, $rating);

    $bIsBookmarks = true;
    require './include/games.php';
    require './include/footer.php';
?>
