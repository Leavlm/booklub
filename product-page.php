<?php
require "includes/_head.php";
require "includes/_header.php";
require "includes/_database.php";
require "includes/_functions.php";

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
?>


<main>

    <section>
        <div class="rating__wrap">
            <img class="rating__img" src="<?= $book['image_url'] ?>" alt="Couverture du livre <?= $book['title_book'] ?>">
            <img class="rating__icn" src="img/etoile.png" alt="note du livre">
        </div>

        <article class="description">
            <div class="description__wrap">
                <h1 class="description__ttl"><?= $book['title_book'] ?></h1>
                <img class="description__icn" src="img/coeur.png" alt="coeur cliquable">
            </div>
            <p class="txt"><?= $book['synopsis'] ?></p>
        </article>
    </section>


    <aside class="suggestions">
        <h2 class="suggestions__ttl">Suggestions</h2>
        <?= getSuggestions($books) ?>
    </aside>

</main>

</body>



<?php require "footer.php" ?>

</html>