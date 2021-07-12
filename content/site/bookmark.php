<?php
    require 'include/connect.php';
    if (!isset($_SESSION['id'])) {
        return header('Location: index.php');
    }
    if ( !isset($_POST['game_id']) ) {
        //Just redirect if something went wrong
        return header('Location: bookmarks.php?error=There was a problem processing your bookmark');
    }

    if (isset($_POST['new'])){

        //Double check they dont already have this bookmarked
        $query = $_con->prepare('SELECT * FROM bookmarks WHERE game_id = ? AND user_id = ?');
        $query->bind_param('ss', $_POST['game_id'], $_SESSION['id']);
        $query->execute();
        $query->store_result();

        if ($query->num_rows > 0) {
            $query->close();
            return header('Location: bookmarks.php?error=You already have this game bookmarked');
        }

        $queryInsert = $_con->prepare('INSERT INTO bookmarks VALUES (?, ?)');
        $queryInsert->bind_param('ss', $_SESSION['id'], $_POST['game_id']);
        $queryInsert->execute();
        $queryInsert->close();
        return header('Location: bookmarks.php?success=Your bookmark was added');

    } else {
        $queryInsert = $_con->prepare('DELETE FROM bookmarks WHERE game_id = ? and user_id = ?');
        $queryInsert->bind_param('ss', $_POST['game_id'], $_SESSION['id']);
        $queryInsert->execute();
        $queryInsert->close();
        return header('Location: bookmarks.php?success=Your bookmark was removed');
    }
