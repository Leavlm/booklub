<?php include "includes/_head.php";
require "includes/_header.php";
require "includes/_database.php";
require "includes/_functions.php"; ?>

<main>
    <section class="form__spacing">
        <h2 class="txt__ttl">Inscrivez-vous</h2>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingFirstname" placeholder="Maurice">
            <label for="floatingFirstname">Prénom</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingLastname" placeholder="Dupont">
            <label for="floatingLastname">Nom</label>
        </div>
        <div class="form-floating mb-3">
            <input type="email" class="form-control" id="floatingInput" placeholder="name@example.com">
            <label for="floatingInput">Email</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control" id="floatingPassword" placeholder="ao78çkd">
            <label for="floatingPassword">Mot de passe</label>
        </div>
    </section>

    <button class="cta cta__position cta__txt">Connexion</button>
</main>


<?php require "includes/_footer.php"; ?>