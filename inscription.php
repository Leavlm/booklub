<?php 
require "includes/_database.php";
// require "includes/_functions.php"; 
include "includes/_head.php";
require "includes/_header.php";

$bookId = isset($_GET['bookId']) ? $_GET['bookId'] : null;



    $query = $dbCo->prepare("SELECT `title_book`, `author_name`, `image_url`, `book`.`id_book`
                             FROM `book`
                             LEFT JOIN `author` ON `book`.`id_author` = `author`.`id_author`");
    $query->execute();
    $books = $query->fetchAll();



$_SESSION['token'] = md5(uniqid(mt_rand(), true));
echo getMsg($msgArray);


?>

<main>
    <form class="form__center form-js" action="addUser.php" method="POST"> 
        <h2 class="form__ttl ttl-js">Inscrivez-vous</h2>
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
        

        <h2 class="form__ttl ttl-js">Vos goûts</h2>
        <p class="txt__subttl ttl-js">Tes livres favoris</p>
        <ul class="card__wrap--horizontal card-wrap-js">
        <?= getHorizontalCatalog($books) ?>
        </ul>
        <section class="catalog-dyn">
        </section>
        <p class="txt__subttl ttl-js">Tes genres favoris</p>

        <p class="txt__subttl ttl-js">Tu n'aimes pas</p>


        

        <input type="hidden" name="token" value="<?= $_SESSION['token'] ?>">
        <button class="cta cta__position cta__txt">Inscription</button>
</form>

</main>


<?php require "includes/_footer.php"; ?>