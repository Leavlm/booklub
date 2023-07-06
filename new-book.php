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
    <form action="add.php" method="post" class="form">
        <label for="title">Titre du livre</label>
        <input type="text" id="title" name="title">

        <label for="author">Auteur</label>
        <input type="text" id="author" name="author">

        <!-- <label for="date">Date de parution</label>
        <input id="date" type="date"> -->

        <label for="pages">Nombre de page</label>
        <input type="number" id="pages" name="pages">

        <input type="hidden" name="token" value="<?=$_SESSION['token']?>">
        <button class="form__btn">Ajouter</button>
    </form>
</main>



</body>