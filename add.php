<?php

require "includes/_database.php";
require "includes/_functions.php";

verifyToken();



// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //insert author in author table
    $query = $dbCo->prepare("INSERT INTO author (author_name) VALUES (:author)");
    $isOk2 = $query->execute([
        "author" => strip_tags($_POST['author'])
    ]);


    $authorId = $dbCo->lastInsertId();
    //associating author from author table to book table by id_author
    $query = $dbCo->prepare("SELECT * FROM author WHERE id_author = :authorId");
    $query->execute(["authorId" => $authorId]);
    $author = $query->fetch(PDO::FETCH_ASSOC);

    if ($isOk2 && ($author && $author['id_author'] == $authorId)) {
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
                // Vérifier le type d'image
                $allowedTypes = array(IMAGETYPE_JPEG, IMAGETYPE_PNG);
            
                $imageFileInfo = @getimagesize($_FILES['image']['tmp_name']);
                if (!$imageFileInfo || !in_array($imageFileInfo[2], $allowedTypes)) {
                    // Type d'image non autorisé, rediriger avec un message d'erreur
                    header('location: new-book.php?msg=invalidImg');
                    exit;
                }


            $imageFileName = ($_FILES['image']['name']);
            $imageTmpPath = ($_FILES['image']['tmp_name']);

            
            // Save the image to a permanent location on the server
            $uploadDir = 'uploads/'; // Change this to your desired directory
            $newFileName = uniqid() . '_' . $imageFileName; // Create a unique filename
            $uploadFilePath = $uploadDir . $newFileName;
            move_uploaded_file($imageTmpPath, $uploadFilePath);
            
            // Generate the URL for the uploaded image
            $imageUrl = 'http://localhost/booklub/' . $uploadFilePath; // Change 'example.com' to your domain name
            


            $query = $dbCo->prepare("INSERT INTO book (title_book, nb_pages, id_author, image_url)  VALUES(:title, :pages, :authorId, :imageUrl)");
            $isOk1 = $query->execute([
                "title" => strip_tags($_POST['title']),
                "pages" => intval(strip_tags($_POST['pages'])),
                "authorId" => $authorId,
                "imageUrl" => $imageUrl
            ]);

            $isOk = $isOk1 && $isOk2;
            header('location: new-book.php?msg=' . ($isOk ? 'ok' : 'ko'));
            exit;
        }
    }
}
