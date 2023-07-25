<?php
include "includes/_head.php";
include "includes/_header.php";
include "includes/_functions.php";



// session_start();

$_SESSION['token'] = md5(uniqid(mt_rand(), true));
echo getMsg($msgArray);
?>
<main>
    <h2 class="form__ttl">Ajouter un livre</h2>
    <form action="add.php" method="POST" class="form form-js" enctype="multipart/form-data">
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
                    <input type="checkbox" id="genre_roman" name="genre[]" value="Roman (Fiction)">
                    <label for="genre_roman">Roman (Fiction)</label>
                </div>

                <div class="form__label">
                    <input type="checkbox" id="genre_policier" name="genre[]" value="Policier / Thriller">
                    <label for="genre_policier">Policier / Thriller</label>
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
                    <input type="checkbox" id="genre_jeunesse" name="genre[]" value="Jeunesse / Jeunes adultes">
                    <label for="genre_jeunesse">Jeunesse / Jeunes adultes</label>
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
    </form>
</main>

<?php require "includes/_footer.php" ?>
<script type="module" src="js/search.js"></script>
</body>