<?php
require "includes/_database.php";
include "includes/_head.php";
require "includes/_header.php";

$idBook = htmlspecialchars($_GET['id']);

$queryBook = $dbCo->prepare("SELECT `title_book`, `image_url`, `id_book`
                            FROM `book`
                            WHERE `id_book` = $idBook");
$queryBook->execute();
$book = $queryBook->fetch();

$queryReviews = $dbCo->prepare("SELECT *
                                FROM `ranking`
                                WHERE `id_book` = $idBook");
$queryReviews->execute();
$reviews = $queryReviews->fetchAll();


?>



<section>
    <article class="description">
        <div class="description__wrap">
            <img class="rating__img" src="<?= $book['image_url'] ?>" alt="Couverture du livre <?= $book['title_book'] ?>">
        </div>
        <h2 class="description__ttl"><?= $book['title_book'] ?></h2>

        <form method="POST" action="action.php" class="form form__wrap">
        <div>

            <input type="radio" class="btn-check" id="btn-check-1" autocomplete="off" value="1" name="note">
            <label class="btn btn-outline-secondary btn__spacing" for="btn-check-1"><img src="img/red-star.png"></label>

            <input type="radio" class="btn-check" id="btn-check-2" autocomplete="off" value="2" name="note">
            <label class="btn btn-outline-secondary btn__spacing" for="btn-check-2"><img src="img/orange-star.png"></label>

            <input type="radio" class="btn-check" id="btn-check-3" autocomplete="off" value="3" name="note">
            <label class="btn btn-outline-secondary btn__spacing" for="btn-check-3"><img src="img/yellow-star.png"></label>

            <input type="radio" class="btn-check" id="btn-check-4" autocomplete="off" value="4" name="note">
            <label class="btn btn-outline-secondary btn__spacing" for="btn-check-4"><img src="img/light-green-star.png"></label>

            <input type="radio" class="btn-check" id="btn-check-5" autocomplete="off" value="5" name="note">
            <label class="btn btn-outline-secondary btn__spacing" for="btn-check-5"><img src="img/dark-green-star.png"></label>

        </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="floatingInput" placeholder="Génial !" name="title_ranking">
                <label class="label-js form-label" for="floatingInput">Titre</label>
            </div>

            <div class="form-floating">
                <textarea class="form-control" placeholder="Laissez un commentaire ici" id="floatingTextarea" name="comment_ranking"></textarea>
                <label class="label-js form-label" for="floatingTextarea">Commentaire</label>
            </div>
            <input type="hidden" name="action" value="addReview">
        </form>
    </article>



    <?php if (!empty($reviews)) { ?>
        <article class="listingCopies__wrap listingCopies">
            <h3 class="listingCopies__ttl">Notes</h2>
            </h3>
        </article>

    <?php } else { ?>
        <p class="txt__medium txt__center">Ce livre ne possède pas encore de note.</p>
    <?php } ?>

    <?php require "includes/_footer.php" ?>