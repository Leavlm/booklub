<?php
require "includes/_database.php";
include "includes/_head.php";
include "includes/_header.php";

$_SESSION['token'] = md5(uniqid(mt_rand(), true));
echo getMsg($msgArray);

$userConnected = isset($_SESSION['user_id']);
$userId = $_SESSION['user_id'];
$copyId = $_GET['copyId'];

if ($userConnected) {
    $queryUser = $dbCo->prepare("SELECT *
                        FROM `users`
                        WHERE `users`.id_users = :id_users");
    $queryUser->execute(['id_users' => $userId]);
    $userData = $queryUser->fetchAll();

    $q = $dbCo->prepare("SELECT *
                        FROM `book`
                        JOIN `copy` ON `copy`.`id_book` = `book`.`id_book`
                        JOIN `users` ON `copy`.`id_users` = `users`.`id_users`
                        WHERE `users`.id_users = :id_users AND `copy`.`id_copy` = :id_copy");
    $q->execute([
        'id_users' => $userId,
        'id_copy' => $copyId
    ]);
    $copyArray = $q->fetchAll();}
?>

<h2 class="txt__ttl txt__spacing">Vos ventes</h2>
<ul class="catalog__lst">
    <?= getYourCopy($copyArray) ?>
</ul>

<form class="form__center form__spacing form-js" action="action.php?copyId=<?= $copyArray[0]['id_copy'] ?>&bookId=<?= $copyArray[0]['id_book'] ?>" method="POST">
    <h2 class="txt__ttl txt__spacing">Etes vous sûr de vouloir supprimer cette copie ?</h2>
    <button class="cta cta__position cta__txt">Oui</button>
    <input type="hidden" name="action" value="deleteCopy">
</form>