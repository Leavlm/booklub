<?php include "includes/_head.php";
require "includes/_header.php";
require "includes/_database.php";
require "includes/_functions.php"; ?>

<main>
    <section class="form__spacing">
        <h2 class="txt__ttl">Connectez-vous</h2>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Email</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="Mot de passe">
            <label for="floatingPassword">Mot de passe</label>
        </div>
    </section>

    <button class="cta cta__position cta__txt">Inscription</button>
    <p class="txt__little txt__spacing">Vous n'avez pas de compte ? <a href="inscription.php" class="txt__link">Inscrivez-vous</a></p>
</main>


<?php require "includes/_footer.php"; ?>