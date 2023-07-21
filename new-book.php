<?php 
include "includes/_head.php";
include "includes/_functions.php";
?>

<body>
<?php include "includes/_header.php";

// session_start();

$_SESSION['token'] = md5(uniqid(mt_rand(), true));
echo getMsg($msgArray);
?>
<main>
<div id="message" style="display: none;">Votre livre a bien été ajouté.</div>
    <form action="add.php" method="POST" class="form form-js" enctype="multipart/form-data">
        <label for="title">Titre du livre</label>
        <input type="text" id="title" name="title" value="" class="input-js">

        <label for="author">Auteur</label>
        <input type="text" id="author" name="author" class="input-js" value="">

        <label for="image">Sélectionnez une couverture:</label>
        <input type="file" id="image" name="image" accept="image/*">

        <label for="pages">Nombre de page</label>
        <input type="number" id="pages" name="pages" class="input-js" value="">

        <input type="hidden" name="token" value="<?=$_SESSION['token']?>">
        <button class="form__btn">Ajouter</button>
    </form>
</main>


<script type="module" src="js/submit.js"></script>
</body>