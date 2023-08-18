<?php
include "includes/_head.php";
include "includes/_header.php";
require "includes/_database.php";
include "includes/_functions.php";

?>
<?php if (!empty($_SESSION)) {
    $query = $dbCo->prepare("SELECT id_users, email, password, firstname, lastname FROM users WHERE id_users = :id_users");
    $query->execute([
        'id_users' => $_SESSION['user_id']
    ]);
    $user = $query->fetch();


    var_dump(isset($_SESSION)); ?>

    <h2 class="txt__ttl txt__spacing">Vos ventes</h2>
    <button class="cta cta__position cta__txt--little cta__position--margin"><a href="sellCopy.php">Vendre un livre</a></button>

    <form class="form__spacing" method="POST" action="">
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

<?php } else if (empty($_SESSION)) { ?>
    

    <p class="txt__center txt__spacing">Connectez vous pour accéder à votre profil</p>


<?php } ?>


<?php require "includes/_footer.php" ?>