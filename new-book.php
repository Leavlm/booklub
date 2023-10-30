<?php
include "includes/_head.php";
include "includes/_header.php";


$_SESSION['token'] = md5(uniqid(mt_rand(), true));
echo getMsg($msgArray);
?>
<main>
    <h2 class="form__ttl">Ajouter un livre</h2>
    <form action="add.php" method="POST" class="form form-js" enctype="multipart/form-data">
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


        <label class="label-js">Genre :</label>
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
            <label for="formFile" class="form-label label-js">Sélectionnez une couverture:</label>
            <input class="form-control" type="file" id="formFile" name="image" accept="image/*" placeholder="Couverture">
        </div>

        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
        <input type="hidden" name="action" value="addBook">

        <button class="cta__txt--little form__btn">Ajouter</button>
    </form>
    <!-- <form action="add.php" method="POST" class="form form-js" enctype="multipart/form-data">
        <div class=" form__wrap--grid">
            <div class="form__wrap">
                <label for="title" class="form__label">Titre</label>
                <input type="text" id="title" name="title" value="" class="input-js form__input" required>
            </div>

            <div class="form__wrap">
                <label for="author" class="form__label">Auteur</label>
                <input type="text" id="author" name="author" class="input-js form__input" value="" required>
            </div>
        </div>

        <div class="form__wrap form__textarea">
            <label for="synopsis" class="form__label">Synopsis</label>
            <textarea name="synopsis" id="synopsis" class="form__textarea"></textarea>
        </div>

        <div class="form__wrap">
            <label for="image" class="form__label">Sélectionnez une couverture:</label>
            <input type="file" id="image" name="image" accept="image/*">
        </div>

        <div class=" form__wrap--grid">
            <div class="form__wrap">
                <label for="pages" class="form__label">Nb de pages</label>
                <input type="number" id="pages" name="pages" class="input-js form__input" value="">
            </div>

            <div class="form__wrap">
                <label for="date" class="form__label">Date de parution</label>
                <input type="date" id="date" name="date" class="input-js form__input">
            </div>
        </div>

            <div class="form__wrap">
                <label>Genre :</label>
                <div class="form__label">
                    <input type="checkbox" id="genre_roman" name="genre[]" value="Roman (fiction)">
                    <label for="genre_roman">Roman (Fiction)</label>
                </div>

                <div class="form__label">
                    <input type="checkbox" id="genre_policier" name="genre[]" value="Policier/Thriller">
                    <label for="genre_policier">Policier/Thriller</label>
                </div>

                <div class="form__label">
                    <input type="checkbox" id="genre_sf" name="genre[]" value="Science-fiction">
                    <label for="genre_sf">Science-fiction</label>
                </div>

                <div class="form__label">
                    <input type="checkbox" id="genre_fantasy" name="genre[]" value="Fantasy">
                    <label for="genre_fantasy">Fantasy</label>
                </div>

                <div class="form__label">
                    <input type="checkbox" id="genre_historique" name="genre[]" value="Historique">
                    <label for="genre_historique">Historique</label>
                </div>

                <div class="form__label">
                    <input type="checkbox" id="genre_horreur" name="genre[]" value="Horreur">
                    <label for="genre_horreur">Horreur</label>
                </div>

                <div class="form__label">
                    <input type="checkbox" id="genre_jeunesse" name="genre[]" value="Jeunesse">
                    <label for="genre_jeunesse">Jeunesse</label>
                </div>

                <div class="form__label">
                    <input type="checkbox" id="genre_nonfiction" name="genre[]" value="Non-fiction">
                    <label for="genre_nonfiction">Non-fiction</label>
                </div>

                <div class="form__label">
                    <input type="checkbox" id="genre_romance" name="genre[]" value="Romance">
                    <label for="genre_romance">Romance</label>
                </div>

                <div class="form__label">
                    <input type="checkbox" id="genre_dystopie" name="genre[]" value="Dystopie">
                    <label for="genre_dystopie">Dystopie</label>
                </div>


            <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
            <button class="cta__txt--little form__btn">Ajouter</button>
    </form> -->
</main>

<?php require "includes/_footer.php" ?>
</body>