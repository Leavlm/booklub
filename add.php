<?php

require "includes/_database.php";
require "includes/_functions.php";
// session_start();
verifyToken();

$query = $dbCo->prepare("INSERT INTO author (author_name) VALUES (:author)");
$isOk2 = $query->execute([
    "author" => strip_tags($_POST['author'])
]);

if($isOk2){
$query = $dbCo->prepare("INSERT INTO book (title_book, nb_pages, id_author)  VALUES(:title, :pages, :authorId)");                     
$isOk1 = $query->execute([
    "title" => strip_tags($_POST['title']),
    "pages" => intval(strip_tags($_POST['pages'])),
    "authorId" => $dbCo->lastInsertId()
]);
}

$isOk = $isOk1 && $isOk2;
header('location: new-book.php?msg='.($isOk? 'ok' : 'ko'));
exit;
