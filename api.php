<?php

header('content-type:application/json');

require 'includes/_database.php';


$data = json_decode(file_get_contents('php://input'), true);

if ($data['action'] === 'addBook' && $_SERVER['REQUEST_METHOD'] === 'PUT') {
    $bookTitle = trim(strip_tags($data['bookTitle']));
    $bookAuthor = trim(strip_tags($data['bookAuthor']));
    $pageNb = intval(strip_tags($data['pageNb']));

    $query2 = $dbCo->prepare("INSERT INTO `author` (author_name) VALUES (:bookAuthor)");
    $isOk2 = $query2->execute([
        'bookAuthor' => $bookAuthor
    ]);

    if ($isOk2) {
        $id_author = $dbCo->lastInsertId();


        $query = $dbCo->prepare("INSERT INTO `book` (title_book, nb_pages, id_author) VALUES (:bookTitle, :pageNb, :id_author)");
        $isOk = $query->execute([
            'bookTitle' => $bookTitle,
            'pageNb' => $pageNb,
            'id_author' => $id_author
        ]);
    }

    echo json_encode([
        'result' => $isOk && $isOk2 && $query->rowCount() > 0,
        'bookTitle' => $data['bookTitle'],
        'pageNb' => $data['pageNb'],
        'bookAuthor' => $data['bookAuthor']
    ]);
    exit;
}

//-------------------------------------------
// SEARCHING FOR KEYWORDS IN DB
//-------------------------------------------


if ($data['action'] === 'search' && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $request = trim(strip_tags($data['request']));
    $query = $dbCo->prepare("SELECT `title_book`, `author_name` FROM `book` JOIN `author` WHERE `title_book` LIKE :request OR `author_name` LIKE :request ");
    $isOk = $query->execute([
        'request' => "%$request%"
    ]);
    $searchstrings = $query->fetchAll();
    echo json_encode([
        'result' => $isOk,
        'books' => $searchstrings
    ]);

    exit;
}
