<?php
require "includes/_head.php";
require "includes/_header.php";
require "includes/_database.php";

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
// var_dump($copyDataArray);

?>


<main>

    <section>
        <div class="rating__wrap">
            <img class="rating__img" src="<?= $book['image_url'] ?>" alt="Couverture du livre <?= $book['title_book'] ?>">
            <div class="rating__wrap">
                <img class="rating__icn" src="img/etoile.png" alt="note du livre">
            </div>
        </div>

        <article class="description">
            <div class="description__wrap">
                <h2 class="description__ttl"><?= $book['title_book'] ?></h1>
                <img class="description__icn" src="img/coeur.png" alt="coeur cliquable">
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

    <aside class="suggestions">
        <h2 class="suggestions__ttl">Suggestions</h2>
        <?= getSuggestions($books) ?>
    </aside>

</main>

</body>



<?php require "includes/_footer.php" ?>

