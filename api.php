<?php

header('content-type:application/json');

require 'includes/_database.php';

$data = json_decode(file_get_contents('php://input'), true);

if ($data['action'] === 'addBook' && $_SERVER['REQUEST_METHOD'] === 'PUT') {
    $bookTitle = trim(strip_tags($data['bookTitle']));
    $bookAuthor = trim(strip_tags($data['bookAuthor']));
    $pageNb = intval(strip_tags($data['pageNb']));
    $query = $dbCo->prepare("INSERT INTO `book` (title_book, nb_pages) VALUES (:bookTitle, :pageNb)");
    $isOk = $query->execute([
        'bookTitle' => $bookTitle,
        'pageNb' => $pageNb
    ]);
    $query2 = $dbCo->prepare("INSERT INTO `author` (author_name) VALUES (:author) WHERE `id_author` = :id_author");
    $isOk = $query->execute([
        'bookAuthor' => $bookAuthor,
        'id_author' => $id_author
    ]);

    echo json_encode([
        'result' => $isOk && $isOk2 && $query->rowCount() > 0,
        'bookTitle' => $data['bookTitle'],
        'pageNb' => $data['pageNb'],
        'bookAuthor' => $data['bookAuthor']
    ]);
    exit;
}