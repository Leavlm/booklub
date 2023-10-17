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
    $userData = $queryUser->fetch();

    $q = $dbCo->prepare("SELECT *
                        FROM `book`
                        JOIN `copy` ON `copy`.`id_book` = `book`.`id_book`
                        JOIN `users` ON `copy`.`id_users` = `users`.`id_users`
                        WHERE `users`.id_users = :id_users AND `copy`.`id_copy` = :id_copy");
    $q->execute(['id_users' => $userId,
                 'id_copy' => $copyId]);
    $copyArray = $q->fetchAll();
    var_dump($copyArray);
?>

    <h2 class="txt__ttl txt__spacing">Vos ventes</h2>
    <ul class="catalog__lst">
        <?= getYourCopy($copyArray) ?>
    </ul>

    <form class="form__center form__spacing form-js" action="sell.php" method="POST">
        <div class="form-floating mb-3">
            <input type="text" class="form-control search-js" id="floatingFirstname" placeholder="Titre" name="title" value="">
            <label for="floatingFirstname">Titre</label>
        </div>

        <section class="catalog-dyn">
        </section>

        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingLastname" placeholder="Auteur" name="author" value="">
            <label for="floatingLastname">Auteur</label>
        </div>
        <div class="form-floating mb-3">
            <input type="number" class="form-control" id="floatingPrice" placeholder="Prix" name="price">
            <label for="floatingPrice">Prix</label>
        </div>

        <div class="form-floating">
            <select class="form-select" id="floatingSelect" aria-label="Sélectionnez l'état" name="state">
                <option selected>Sélectionnez l'état</option>
                <option value="Parfait">Parfait</option>
                <option value="Moyen">Moyen</option>
                <option value="Nul">Nul</option>
            </select>
            <label for="floatingSelect">Etat du livre</label>
        </div>

        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
        <button class="cta cta__position cta__txt">Mettre en vente</button>
    </form>


<?php } else if (!$userConnected) { ?>


    <p class="txt__center txt__spacing"><a href="http://localhost/booklub/connexion.php">  Connectez vous </a>pour accéder à votre profil</p>


<?php } ?>


<?php require "includes/_footer.php" ?>