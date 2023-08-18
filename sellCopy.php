<?php
require "includes/_database.php";
include "includes/_functions.php";
include "includes/_head.php";
include "includes/_header.php";

$_SESSION['token'] = md5(uniqid(mt_rand(), true));
echo getMsg($msgArray);
?>
?>

<main>
    <form class="form__spacing" action="sell.php" method="POST">
        <h2 class="txt__ttl">Vendez votre livre</h2>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingFirstname" placeholder="Titre" name="title">
            <label for="floatingFirstname">Titre</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingLastname" placeholder="Auteur" name="author">
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

    <h2 class="txt__ttl">Votre livre n'existe pas ?</h2>

    <form action="add.php" method="POST" class="form form-js form__radius" enctype="multipart/form-data">
        <div class="form-floating mb-3">
            <input type="text" class="form-control" id="floatingTtl" placeholder="Titre" name="title" required>
            <label for="floatingTtl">Titre</label>
        </div>
        <div class="form-floating mb-3">
            <input type="text" class="form-control input-js" id="floatingAuthor" placeholder="Auteur" name="author" required>
            <label for="floatingAuthor">Auteur</label>
        </div>

        <div class="form-floating mb-3">
            <textarea class="form-control" placeholder="Résumé du livre" id="floatingSynopsis" name="synopsis"></textarea>
            <label for="floatingSynopsis">Synopsis</label>
        </div>


        <div class="form-floating mb-3">
            <input type="number" class="form-control input-js" id="floatingPages" placeholder="Nb de pages" name="pages" required>
            <label for="floatingPages">Nombre de pages</label>
        </div>

        <div class="form-floating mb-3">
            <input type="date" class="form-control input-js" id="floatingDate" placeholder="Date de parution" name="date">
            <label for="floatingDate">Date de parution</label>
        </div>


        <label>Genre :</label>
        <div>

            <input type="checkbox" class="btn-check" id="btn-check-1" autocomplete="off" value="Roman (fiction)" name="genre[]">
            <label class="btn btn-outline-secondary btn__spacing" for="btn-check-1">Roman (Fiction)</label>

            <input type="checkbox" class="btn-check" id="btn-check-2" autocomplete="off" value="Policier/Thriller" name="genre[]">
            <label class="btn btn-outline-secondary btn__spacing" for="btn-check-2">Policier/Thriller</label>

            <input type="checkbox" class="btn-check" id="btn-check-3" autocomplete="off" value="Science-fiction" name="genre[]">
            <label class="btn btn-outline-secondary btn__spacing" for="btn-check-3">Science-fiction</label>

            <input type="checkbox" class="btn-check" id="btn-check-4" autocomplete="off" value="Fantasy" name="genre[]">
            <label class="btn btn-outline-secondary btn__spacing" for="btn-check-4">Fantasy</label>

            <input type="checkbox" class="btn-check" id="btn-check-5" autocomplete="off" value="Historique" name="genre[]">
            <label class="btn btn-outline-secondary btn__spacing" for="btn-check-5">Historique</label>

            <input type="checkbox" class="btn-check" id="btn-check-6" autocomplete="off" value="Horreur" name="genre[]">
            <label class="btn btn-outline-secondary btn__spacing" for="btn-check-6">Horreur</label>

            <input type="checkbox" class="btn-check" id="btn-check-7" autocomplete="off" value="Jeunesse" name="genre[]">
            <label class="btn btn-outline-secondary btn__spacing" for="btn-check-7">Jeunesse</label>

            <input type="checkbox" class="btn-check" id="btn-check-8" autocomplete="off" value="Non-fiction" name="genre[]">
            <label class="btn btn-outline-secondary btn__spacing" for="btn-check-8">Non-fiction</label>

            <input type="checkbox" class="btn-check" id="btn-check-9" autocomplete="off" value="Romance" name="genre[]">
            <label class="btn btn-outline-secondary btn__spacing" for="btn-check-9">Romance</label>

            <input type="checkbox" class="btn-check" id="btn-check-8" autocomplete="off" value="Dystopie" name="genre[]">
            <label class="btn btn-outline-secondary btn__spacing" for="btn-check-8">Dystopie</label>
        </div>

        <div class="mb-3 pt-3">
            <label for="formFile" class="form-label">Sélectionnez une couverture:</label>
            <input class="form-control" type="file" id="formFile" name="image" accept="image/*" placeholder="Couverture">
        </div>

        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
        <button class="cta__txt--little form__btn">Ajouter</button>
    </form>