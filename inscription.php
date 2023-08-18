<?php 
require "includes/_database.php";
require "includes/_functions.php"; 
include "includes/_head.php";
require "includes/_header.php";
$_SESSION['token'] = md5(uniqid(mt_rand(), true));
?>

<main>
    <form class="form__spacing" action="addUser.php" method="POST"> 
        <h2 class="txt__ttl">Inscrivez-vous</h2>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingFirstname" placeholder="Maurice" name="firstname">
            <label for="floatingFirstname">Prénom</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingLastname" placeholder="Dupont" name="lastname">
            <label for="floatingLastname">Nom</label>
        </div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com" name="email">
            <label for="floatingInput">Email</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="ao78çkd" name="password">
            <label for="floatingPassword">Mot de passe</label>
        </div>
        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
        <button class="cta cta__position cta__txt">Inscription</button>
</form>

</main>


<?php require "includes/_footer.php"; ?>