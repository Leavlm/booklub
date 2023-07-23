<?php 
include "includes/_head.php";
include "includes/_header.php";
include "includes/_functions.php";



// session_start();

$_SESSION['token'] = md5(uniqid(mt_rand(), true));
echo getMsg($msgArray);
?>
<main>
<div id="message" style="display: none;">Votre livre a bien été ajouté.</div>
    <form action="add.php" method="POST" class="form form-js" enctype="multipart/form-data">
        <div class=" form__wrap--inline">
        <div class="form__wrap">
        <label for="title" class="form__label">Titre</label>
        <input type="text" id="title" name="title" value="" class="input-js" required>
        </div>

        <div class="form__wrap">
        <label for="author" class="form__label">Auteur</label>
        <input type="text" id="author" name="author" class="input-js" value="" required>
        </div>
        </div>

        <div class="form__wrap">
        <label for="synopsis" class="form__label">Synopsis</label>
        <textarea name="synopsis" id="synopsis" cols="58" rows="5"></textarea>
        </div>

        <div class="form__wrap">
        <label for="image" class="form__label">Sélectionnez une couverture:</label>
        <input type="file" id="image" name="image" accept="image/*">
        </div>

        <div class=" form__wrap--inline">
        <div class="form__wrap">
        <label for="pages" class="form__label">Nombre de page</label>
        <input type="number" id="pages" name="pages" class="input-js" value="">
        </div>

        <div class="form__wrap">
        <label for="date" class="form__label">Date de parution</label>
        <input type="date" id="date" name="date" class="input-js">
        </div>
        </div>


        <input type="hidden" name="token" value="<?=$_SESSION['token']?>">
        <button class="form__btn">Ajouter</button>
    </form>
</main>

<?php require "includes/_footer.php"?>
<script type="module" src="js/search.js"></script>
</body>