<?php
require "includes/_database.php";
include "includes/_head.php";
include "includes/_header.php";

$_SESSION['token'] = md5(uniqid(mt_rand(), true));
echo getMsg($msgArray);

$userConnected = isset($_SESSION['user_id']);
$userId = $_SESSION['user_id'];
$copyId = $_GET['copyId'];

if ($userConnected) {
    $queryUser = $dbCo->prepare("SELECT *
                        FROM `users`
                        WHERE `users`.id_users = :id_users");
    $queryUser->execute(['id_users' => $userId]);
    $userData = $queryUser->fetchAll();

    $q = $dbCo->prepare("SELECT *
                        FROM `book`
                        JOIN `copy` ON `copy`.`id_book` = `book`.`id_book`
                        JOIN `users` ON `copy`.`id_users` = `users`.`id_users`
                        WHERE `users`.id_users = :id_users AND `copy`.`id_copy` = :id_copy");
    $q->execute([
        'id_users' => $userId,
        'id_copy' => $copyId
    ]);
    $copyArray = $q->fetchAll();
    var_dump($copyArray);

    if (is_array($copyArray)) {
        $idAuthor = $copyArray[0]['id_author'];
        $qAuthor = $dbCo->prepare("SELECT *
                                    FROM `author`
                                    WHERE `id_author` = :idAuthor");
        $qAuthor->execute(['idAuthor' => $idAuthor]);
        $authorData = $qAuthor->fetch();
    }


?>

    <h2 class="txt__ttl txt__spacing">Vos ventes</h2>
    <ul class="catalog__lst">
        <?= getYourCopy($copyArray) ?>
    </ul>

    <form class="form__center form__spacing form-js" action="sell.php" method="POST">
        <div class="form-floating mb-3">
            <input type="text" class="form-control search-js" id="floatingFirstname" placeholder="Titre" name="title" value="<?= $copyArray[0]['title_book'] ?>">
            <label for="floatingFirstname">Titre</label>
        </div>

        <section class="catalog-dyn">
        </section>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingLastname" placeholder="Auteur" name="author" value="<?= $authorData['author_name'] ?>">
            <label for="floatingLastname">Auteur</label>
        </div>
        <div class="form-floating mb-3">
            <input type="number" class="form-control" id="floatingPrice" placeholder="Prix" name="price" value="<?= $copyArray[0]['price'] ?>">
            <label for="floatingPrice">Prix</label>
        </div>

        <div class="form-floating">
            <select class="form-select" id="floatingSelect" aria-label="Sélectionnez l'état" name="state">
                <option value="Sélectionnez l'état">Sélectionnez l'état</option>
                <option value="Parfait" <?= ($copyArray[0]['state'] == 'Parfait') ? 'selected' : '' ?>>Parfait</option>
                <option value="Moyen" <?= ($copyArray[0]['state'] == 'Moyen') ? 'selected' : '' ?>>Moyen</option>
                <option value="Nul" <?= ($copyArray[0]['state'] == 'Nul') ? 'selected' : '' ?>>Nul</option>
            </select>
            <label for="floatingSelect">Etat du livre</label>
        </div>


        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
        <button class="cta cta__position cta__txt">Mettre en vente</button>
    </form>


<?php } else if (!$userConnected) { ?>


    <p class="txt__center txt__spacing"><a href="http://localhost/booklub/connexion.php"> Connectez vous </a>pour accéder à votre profil</p>


<?php } ?>


<?php require "includes/_footer.php" ?>