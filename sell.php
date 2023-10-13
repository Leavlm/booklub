<?php
require "includes/_database.php";
include "includes/_functions.php";
include "includes/_head.php";
include "includes/_header.php";


if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $titleReceived = strip_tags($_POST['title']);
    $q = $dbCo->prepare("SELECT id_book FROM book WHERE title_book = :title");
    $isOk2 = $q->execute(["title" => $titleReceived]);
    $ttl = $q->fetch(PDO::FETCH_ASSOC);

    $authorName = strip_tags($_POST['author']);
    $q1 = $dbCo->prepare("SELECT id_author FROM author WHERE author_name = :authorName");
    $isOk3 = $q1->execute(["authorName" => $authorName]);
    $author = $q1->fetch(PDO::FETCH_ASSOC);


    if ($author && $ttl) {
        $authorId = $author['id_author'];
        $bookId = $ttl['id_book'];
        $query = $dbCo->prepare("INSERT INTO `copy` (`state`, `price`, `adding_date`, `id_book`, `id_users`)  VALUES(:state, :price, :date, :idBook, :idUser)");
        $isOk1 = $query->execute([
            "state" => strip_tags($_POST['state']),
            "price" => intval(strip_tags($_POST['price'])),
            "date" => date('y-m-d'),
            "idBook" => $bookId,
            "idUser" => strip_tags($_SESSION['user_id'])
        ]);
    }

    $isOk = $isOk3 && $isOk2;
    header('location: profile.php?msg=' . ($isOk ? 'bookInStore' : 'bookNotInStore'));
    exit;
}
