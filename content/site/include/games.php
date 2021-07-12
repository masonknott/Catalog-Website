<div class="card__container">
<?php
// REG 1801459

    $assocGenresMapping = [
        'str' => 'Strategy',
        'rpg' => 'Role-Playing Game',
        'fps' => 'First-Person Shooter',
        'sim' => 'Simulation'
    ];

    $_strGamesQuery->execute();
    $_strGamesQuery->store_result();
    $results = [];
    while($row = $_strGamesQuery->fetch()){
        $results[] = [
            'genre' => $genre,
            'image' => $image,
            'id' => $id,
            'title' => $title,
            'rating' => $rating
        ];
    }

    for ($i=0; $i < count($results); $i++) {
        $row = $results[$i];
        if (isset($assocGenresMapping[$row['genre']])) {
            $strFullGenre = $assocGenresMapping[$row['genre']];
        }

        if (!$strFullGenre) {
            $strFullGenre = 'Other';
        }
        $strImageURL = $row['image'];
        if (!$strImageURL) {
            //Bad practice but.. its an assignment ;)
            $strImageURL = 'https://pngimage.net/wp-content/uploads/2018/06/unknown-png.png';
        }

        $strFormRemoveBookmark = '';
        if (isset($bIsBookmarks)) {
            $strFormRemoveBookmark = '<form action="/bookmark.php" method="post"><input id="game_id" name="game_id" type="hidden" value="'.$row['id'].'"><button type="submit" class="button button__primary card__bookmark">Remove bookmark</button></form>';
        }

        echo '<a class="card__link" href="/game.php?id='.$row['id'].'"><div class="card"><div class="well well__nomargin"><img class="card__image" src="'.$strImageURL.'"/><h3 class="card__title">'.$row['title'].'</h3></div><div class="tag">'.$strFullGenre.'</div><div class="tag">'.$row['rating'].'%</div>'.$strFormRemoveBookmark.'</div></a>';
    }

    $_strGamesQuery->close();
?>
</div>
