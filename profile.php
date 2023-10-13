<?php
require "includes/_database.php";
include "includes/_head.php";
include "includes/_header.php";

$_SESSION['token'] = md5(uniqid(mt_rand(), true));
echo getMsg($msgArray);


if (array_key_exists('user_id', $_SESSION)) {
    $query = $dbCo->prepare("SELECT `users`.`id_users`, `email`, `password`, `firstname`, `lastname`, `title_book`, `image_url`, `book`.`id_book` 
                            FROM `users` 
                            JOIN `copy` ON `copy`.`id_users` = `users`.`id_users`
                            JOIN `book` ON `book`.`id_book` = `copy`.`id_book`
                            WHERE `users`.`id_users` = :id_users");
    $query->execute([
        'id_users' => $_SESSION['user_id']
    ]);
    $user = $query->fetch();
    $result = $query->fetchAll();

    $q = $dbCo->prepare("SELECT *
                        FROM `copy`
                        JOIN `book` ON `book`.`id_book` = `copy`.`id_book`
                        WHERE id_users = :id_users
                        GROUP BY id_copy");
    $q->execute(['id_users' => $_SESSION['user_id']]);
    $copiesArray = $q->fetchAll();
    // var_dump($copiesArray);


?>

    <h2 class="txt__ttl txt__spacing">Vos ventes</h2>
    <ul class="catalog__lst">
        <?= getCatalog($copiesArray) ?>
    </ul>
    <button class="cta cta__position cta__txt--little cta__position--margin"><a href="sellCopy.php">Vendre un livre</a></button>

    <form class="form__spacing form-js" method="POST" action="">
        <h2 class="txt__ttl">Votre profil</h2>
        <div class="form-floating mb-3">
            <input type="firstname" class="form-control" id="floatingInput" value="<?= $user['firstname'] ?>" name="firstname">
            <label for="floatingInput">Votre prénom</label>
        </div>
        <div class="form-floating mb-3">
            <input type="lastname" class="form-control" id="floatingInput" value="<?= $user['lastname'] ?>" name="lastname">
            <label for="floatingInput">Votre nom</label>
        </div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput" value="<?= $user['email'] ?>" name="email">
            <label for="floatingInput">Votre email</label>
        </div>
        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
        <button class="cta cta__position cta__txt cta__position--margin">Modifier</button>
        <a class="txt__little txt__center txt__link" href="logout.php">Déconnexion</a>
    </form>

<?php } else if (!array_key_exists('user_id', $_SESSION)) { ?>


    <p class="txt__center txt__spacing">Connectez vous pour accéder à votre profil</p>


<?php } ?>


<?php require "includes/_footer.php" ?>