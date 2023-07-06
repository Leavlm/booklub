<?php

header('content-type:application/json');

require 'includes/_database.php';

$data = json_decode(file_get_contents('php://input'), true);

if ($data['action'] === 'addBook' && $_SERVER['REQUEST_METHOD'] === 'PUT') {
    $bookTitle = trim(strip_tags($data['bookTitle']));
    $bookAuthor = trim(strip_tags($data['bookAuthor']));
    $bookPages = intval(strip_tags($data['bookPages']));
    $query = $dbCo->prepare("INSERT INTO `book` (title_book, nb_pages) VALUES (:bookTitle, :bookPages)");
    $isOk = $query->execute([
        'bookTitle' => $bookTitle,
        // 'bookAuthor' => $bookAuthor,
        'bookPages' => $bookPages
    ]);
    echo json_encode([
        'result' => $isOk && $query->rowCount() > 0,
        'bookTitle' => $$bookTitle,
        'bookPages' => $bookPages
    ]);
    exit;
}