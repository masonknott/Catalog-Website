    <?php
    require './include/head.php';
    //Use the prepare method to avoid SQL injection..
    $query = $_con->prepare('SELECT title, image, genre, rating FROM games WHERE id = ?');
    $query->bind_param('s', $_GET['id']);
    $query->execute();
    $query->store_result();

    if ($query->num_rows > 0) {
        $query->bind_result($title, $image, $genre, $rating); //Lazy way to mass-assign vars :)
        $query->fetch();

        //Because both tables have an 'id' field, we need to name one of them differently
        $resultReviews = $_con->query('SELECT users.id as userId, users.*, reviews.* FROM reviews LEFT JOIN users ON reviews.user_id = users.id WHERE game_id = '.$_GET['id']);
    }

    $query->close();

    $bLoggedIn = isset($_SESSION['id']);
?>
<div class="well">
    <?php
        if (isset($title)) {
            if (!isset($image) || $image === '') {
                $image = 'https://pngimage.net/wp-content/uploads/2018/06/unknown-png.png';
            }
            $strFormAddBookmark = '';
            if ($bLoggedIn) {
                $strFormAddBookmark = '<form action="/bookmark.php" method="post"><input id="new" name="new" type="hidden" value="new"><input id="game_id" name="game_id" type="hidden" value="'.$_GET['id'].'"><button type="submit" class="button button__primary">Add bookmark</button></form>';
            }
            echo '<h1>'.$title.'</h1><img src="'.$image.'"></img>'.$strFormAddBookmark;
        } else {
            echo '<h1 class="center">Game not found.</h1>';
        }
    ?>
</div>

<?php
    //This will be set to the id of the review, if a user has already reviewed this game
    //Later we can then decide if its a new POST or an edit PUT
    $idReview = false;

    if (isset($resultReviews) && $resultReviews->num_rows > 0) {
        while($row = $resultReviews->fetch_assoc()) {
            if ($bLoggedIn && $row['user_id'] == $_SESSION['id']) {
                $idReview = $row['id'];
            }

            //VERY important here we use htmlentities($string, ENT_QUOTES | ENT_HTML5, 'UTF-8')
            //We must escape any HTML incase a review was submitted with it#
            //Its considered best practice to escape on output, not input, if you dont need any html (which we dont)

            echo '<div class="well"><h2>'.htmlentities($row['title'], ENT_QUOTES | ENT_HTML5, 'UTF-8').'</h2><p>'.htmlentities($row['review'], ENT_QUOTES | ENT_HTML5, 'UTF-8').'</p><div><div class="tag">Author: '.$row['uname'].'</div><div class="tag">'.htmlentities($row['rating'], ENT_QUOTES | ENT_HTML5, 'UTF-8').'/100</div></div></div>';
        }
    }

    if (isset($bLoggedIn) && $bLoggedIn) {
        $strButton = $idReview ? 'Edit' : 'Submit';
        //We need to send off the review id if we're editing one!
        $strExtraHiddenFields = $idReview ? '<input id="reviewId" name="reviewId" type="hidden" value="'.$idReview.'">' : '';

        echo '<div class="well well__review"><h3>Your review</h3><form action="/review.php" method="post">'.$strExtraHiddenFields.'<input id="gameId" name="gameId" type="hidden" value="'.$_GET['id'].'"><input name="title" type="text" id="inputTitle" placeholder="Review title..." required ><input name="review" type="text" id="inputReview" placeholder="Review text..." required ><input name="rating" type="number" id="inputRating" placeholder="0/100" min="0" max="100" required><button type="submit" class="button button__primary">'.$strButton.' review</button></form>';
    }

    require './include/footer.php';
?>
