<?php
    require 'include/connect.php';
    if (!isset($_SESSION['id'])) {
        return header('Location: index.php');
    }
    if ( !isset($_POST['title'], $_POST['image'], $_POST['genre'], $_POST['rating']) ) {
        //Just redirect if something went wrong
        return header('Location: index.php?error=There was a problem adding your game');
    }

    //Double check this user is an admin - they could quite easily send this request themselves
    $query = $_con->prepare('SELECT * FROM users WHERE id = ? AND is_admin = 1');
    $query->bind_param('s', $_SESSION['id']);
    $query->execute();
    $query->store_result();

    if ($query->num_rows > 0) {
        $queryUpdate = $_con->prepare('INSERT INTO games (title, image, genre, rating) VALUES (?, ?, ?, ?)');
        $queryUpdate->bind_param('sssi', $_POST['title'], $_POST['image'], $_POST['genre'], $_POST['rating']);
        $queryUpdate->execute();
        $queryUpdate->close();
        return header('Location: index.php?success=Your game was added');
    }
    //No matching user - caught em...
    return header('Location: index.php?error=There was a problem adding your game');
