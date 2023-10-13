<?php
require "includes/_database.php";
include "includes/_head.php";
include "includes/_header.php";

$_SESSION['token'] = md5(uniqid(mt_rand(), true));
echo getMsg($msgArray);

$userConnected = isset($_SESSION['user_id']);
$userId = $_SESSION['user_id'];
var_dump($userConnected);

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
                        WHERE `users`.id_users = :id_users
                        GROUP BY id_copy");
    $q->execute(['id_users' => $userId]);
    $copiesArray = $q->fetchAll();


?>

    <h2 class="txt__ttl txt__spacing">Vos ventes</h2>
    <ul class="catalog__lst">
        <?= getCatalog($copiesArray) ?>
    </ul>
    <button class="cta cta__position cta__txt--little cta__position--margin"><a href="sellCopy.php">Vendre un livre</a></button>

    <form class="form__spacing form-js" method="POST" action="">
        <h2 class="txt__ttl">Votre profil</h2>
        <div class="form-floating mb-3">
            <input type="firstname" class="form-control" id="floatingInput" value="<?= is_array($userData) ? $userData['firstname'] : "" ?>" name="firstname">
            <label for="floatingInput">Votre prénom</label>
        </div>
        <div class="form-floating mb-3">
            <input type="lastname" class="form-control" id="floatingInput" value="<?= is_array($userData) ? $userData['lastname'] : "" ?>" name="lastname">
            <label for="floatingInput">Votre nom</label>
        </div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput" value="<?= is_array($userData) ? $userData['email'] : "" ?>" name="email">
            <label for="floatingInput">Votre email</label>
        </div>
        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
        <button class="cta cta__position cta__txt cta__position--margin">Modifier</button>
        <a class="txt__little txt__center txt__link" href="logout.php">Déconnexion</a>
    </form>

<?php } else if (!$userConnected) { ?>



    <p class="txt__center txt__spacing"><a href="http://localhost/booklub/connexion.php">  Connectez vous </a>pour accéder à votre profil</p>


<?php } ?>


<?php require "includes/_footer.php" ?>