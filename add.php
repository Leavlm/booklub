<?php

require "includes/_database.php";
require "includes/_functions.php";

verifyToken();

$query = $dbCo->prepare("INSERT INTO author (author_name) VALUES (:author)");
$isOk2 = $query->execute([
    "author" => strip_tags($_POST['author'])
]);


$authorId = $dbCo->lastInsertId();

$query = $dbCo->prepare("SELECT * FROM author WHERE id_author = :authorId");
$query->execute(["authorId" => $authorId]);
$author = $query->fetch(PDO::FETCH_ASSOC);


if($isOk2 && ($author && $author['id_author'] == $authorId)){
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
