<?php
require "includes/_head.php";
require "includes/_header.php";
require "includes/_database.php";

$_SESSION['token'] = md5(uniqid(mt_rand(), true));
echo getMsg($msgArray);

// ------------------------
// GETTING THE BOOK CLICKED
// ------------------------

if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $query = $dbCo->prepare("SELECT `title_book`, `author_name`, `image_url`, `book`.`id_book`, `synopsis`
                            FROM `book`
                            LEFT JOIN `author` ON `book`.`id_author` = `author`.`id_author`
                            LEFT JOIN `own` ON `book`.`id_book` = `own`.`id_book`
                            LEFT JOIN `genre` ON `own`.`id_genre` = `genre`.`id_genre`
                            WHERE `book`.`id_book` = :id_book");

    $query->bindParam(':id_book', $_GET['id'], PDO::PARAM_INT);
    $query->execute();
    $book = $query->fetch();
} else {
    header('location: index.php?msg=invalidId');
    exit;
}

//---------------------------------------------
// GETTING BOOKS IMGS URL TO PUT IN SUGGESTIONS
//---------------------------------------------

$query2 = $dbCo->prepare("SELECT `image_url` FROM `book`");
$query2->execute();
$books = $query2->fetchAll();


//------------------------
// GETTING COPY BY BOOK ID 
//------------------------

$idBook = $_GET['id'];
// var_dump($idBook);


$queryCopyData = $dbCo->prepare("SELECT *
                                FROM `book`
                                JOIN `copy` ON `copy`.`id_book` = `book`.`id_book`
                                JOIN `users` ON `users`.`id_users` = `copy`.`id_users`
                                WHERE `book`.`id_book` = :idBook");
$queryCopyData->execute([
    'idBook' => $idBook
]);
$copyDataArray = $queryCopyData->fetchAll();


//-------------------------------
// GETTING USER ID IF CONNECTED
//-------------------------------

$userId = $_SESSION['user_id'];
// var_dump($book);

//-------------------
// ADDING BOOK TO FAV
//-------------------

// $queryFavorise = $dbCo->prepare("INSERT INTO favorise (id_book, id_users) VALUES (:idBook, :idUsers) ON DUPLICATE KEY UPDATE id_book = :idBook" );
// $queryFavorise->execute([
//     'idBook' => $idBook,
//     'idUsers' => $userId
// ]);

$queryCheckFavorites = $dbCo->prepare("SELECT id_book, id_users
                                        FROM favorise
                                        WHERE id_users = :idUsers AND id_book = :idBook");
$queryCheckFavorites->execute([
    'idUsers' => $userId,
    'idBook'  => $idBook
]);
$favoritesData = $queryCheckFavorites->fetchAll();

    if (!empty($favoritesData) && $favoritesData[0]['id_book'] == $idBook && $favoritesData[0]['id_users'] == $userId ){
        $filledHeart = 'fa-solid';
    }
    else{
        $filledHeart = 'fa-regular';
    }

//------------------------    
// GETTING REVIEWS BY BOOK
//------------------------

$queryReviews = $dbCo->prepare("SELECT AVG(ranking.note)
                                FROM `ranking`
                                JOIN `book` ON `book`.`id_book` = `ranking`.`id_book`
                                WHERE `ranking`.`id_book` = :idBook");
$queryReviews->bindParam(":idBook", $idBook, PDO::PARAM_INT);
$queryReviews->execute();
$avgRating = $queryReviews->fetchColumn();
$avgWithoutDecimal = ceil($avgRating);



?>


    <section>
        <div class="rating__wrap">
            <img class="rating__img" src="<?= $book['image_url'] ?>" alt="Couverture du livre <?= $book['title_book'] ?>">
            <div class="rating__wrap">
                <?php if($avgWithoutDecimal){ ?>
                <a href="review.php?id=<?= $idBook ?>"><img class="rating__icn" src="img/<?= $avgWithoutDecimal ?>-star.png" alt="note du livre"></a>
                <?php } ?>
            </div>
        </div>

        
        <article class="description">
            <div class="description__wrap">
                <h2 class="description__ttl"><?= $book['title_book'] ?></h2>
                <?php if (!empty($favoritesData)){
                echo '<form method="POST" action="action.php" class="description__icn js-fav-form">
                <button class="btn__reset"><i class="fa-solid btn-js fa-heart empty-heart-js "></i></button>
                <input type="hidden" name="action" value="deleteFav">
        ';}
        else{
                    echo '<form method="POST" action="action.php" class="description__icn js-fav-form ">
                    <button class="btn__reset"><i class="fa-regular btn-js fa-heart empty-heart-js "></i></button>
                    <input type="hidden" name="action" value="addFav">';
                }?>
                <input type="hidden" name="token" value="<?= $_SESSION['token']?>"> 
                <input type="hidden" name="idBook" value="<?= $_GET['id']?>"> 
                </form>
            </div>
            <p class="description__txt"><?= $book['synopsis'] ?></p>
        </article>
    </section>
    <br>
    <br>

    <?php if (!empty($copyDataArray)){ ?>
        <section>
            <article class="listingCopies__wrap listingCopies">
                <h3 class="listingCopies__ttl">Occasions</h2>
                <ul class="">
                    <?= getCopiesByUser($copyDataArray) ?>
                </ul>
            </article>
        </section>
        <?php }
   else{?>
    <p class="txt__medium txt__center">Aucun exemplaire actuellement en vente.</p>
    <?php } ?>
    
    <br>
    <br>
    
    <?php if (!$avgWithoutDecimal){ ?>
    <button class="cta cta__txt--little cta__position"> <a href="review.php?id=<?= $idBook ?>">Noter le livre</a></button>
    <?php } ?>
    <!-- <aside class="suggestions">
        <h2 class="suggestions__ttl">Suggestions</h2>
        <?= getSuggestions($books) ?>
    </aside> -->

</main>

</body>



<?php require "includes/_footer.php" ?>

