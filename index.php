<?php include "includes/_head.php";
require "includes/_header.php";
require "includes/_database.php";
require "includes/_functions.php";

$query = $dbCo->prepare("SELECT `title_book`, `author_name`, `image_url`, `book`.`id_book`
                        FROM `book`
                        LEFT JOIN `author` ON `book`.`id_author` = `author`.`id_author`
                        LEFT JOIN `own` ON `book`.`id_book` = `own`.`id_book`
                        LEFT JOIN `genre` ON `own`.`id_genre` = `genre`.`id_genre`");
$query->execute();
$books = $query->fetchAll();


?>

<main>
    <?=getMsg($msgArray);?>
    <section class="intro">
        <article class="intro__wrap">
            <h1 class="intro__ttl">Booklub</h1>
            <p class="intro__txt">Vous en avez marre de chercher <br>votre prochain livre ? <br></p>
            <a class="cta" href="choose-product.php">
                <p class="cta__txt">Aidez moi à choisir</p>
            </a>
        </article>
    </section>

    <section>
        <article class="catalog">
            <h2 class="catalog__title">Notre catalogue</h2>
            <ul class="catalog__lst">
    <?= getCatalog($books)?>
            </ul>

            <!-- <div class="cta__wrap">
                <a class="cta cta__position" href="">
                    <p class="cta__txt--little" style="display: none;">Voir plus</p>
                </a>
            </div> -->

        </article>


    </section>
</main>

<?php require "includes/_footer.php" ?>
<script src="js/search.js"></script>
</body>

</html>