<?php
    require 'include/connect.php';
    if (!isset($_SESSION['id'])) {
        return header('Location: index.php');
    }
    if ( !isset($_POST['title'], $_POST['review'], $_POST['rating'], $_POST['gameId']) ) {
        //Just redirect if something went wrong
        return header('Location: game.php?id='.$_POST['gameId'].'&error=There was a problem posting your review');
    }

    if (isset($_POST['reviewId'])){

        //Find the existing one - and double check the user actually owns this review before editing
        //This is incase a malicious user would send off a request themselves
        $query = $_con->prepare('SELECT * FROM reviews WHERE id = ? AND user_id = ?');
        $query->bind_param('ss', $_POST['reviewId'], $_SESSION['id']);
        $query->execute();
        $query->store_result();

        if ($query->num_rows > 0) {
            $queryUpdate = $_con->prepare('UPDATE reviews SET title = ?, review = ?, rating = ? WHERE id = ?');
            $queryUpdate->bind_param('ssis', $_POST['title'], $_POST['review'], $_POST['rating'], $_POST['reviewId']);
            $queryUpdate->execute();
            $queryUpdate->close();
            return header('Location: game.php?id='.$_POST['gameId'].'&success=Your review was edited');
        }
        //No matching review - very strange...
        return header('Location: game.php?id='.$_POST['gameId'].'&error=There was a problem editing your review');

    } else {
        //This is a new review
        //Check if the user already posted a review
        $query = $_con->prepare('SELECT * FROM reviews WHERE game_id = ? AND user_id = ?');
        $query->bind_param('ss', $_POST['gameId'], $_SESSION['id']);
        $query->execute();
        $query->store_result();

        if ($query->num_rows > 0) {
            //Theoretically somebody may fire a post request manually, without a reviewId, even tho they already have a review
            //In which case, we need to stop
            return header('Location: game.php?id='.$_POST['gameId'].'&error=There was a problem posting your review');
        }

        $queryInsert = $_con->prepare('INSERT INTO reviews (user_id, game_id, rating, title, review) VALUES (?, ?, ?, ?, ?)');
        $queryInsert->bind_param('iiiss', $_SESSION['id'], $_POST['gameId'], $_POST['rating'], $_POST['title'], $_POST['review']);
        $queryInsert->execute();
        $queryInsert->close();
        return header('Location: game.php?id='.$_POST['gameId'].'&success=Your review was posted');
    }
