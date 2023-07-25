<?php

require "includes/_database.php";
require "includes/_functions.php";

verifyToken();



// Check if the form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //insert author in author table

    $authorName = strip_tags($_POST['author']);
    $query = $dbCo->prepare("SELECT id_author FROM author WHERE author_name = :authorName");
    $isOk2 = $query->execute(["authorName" => $authorName]);
    $author = $query->fetch(PDO::FETCH_ASSOC);

    if ($author) {
        // If the author already exist, take the same id 
        $authorId = $author['id_author'];
    } else {
        // If he doesn't exist, you can add him
        $query = $dbCo->prepare("INSERT INTO author (author_name) VALUES (:author)");
        $isOk2 = $query->execute([
            "author" => $authorName
        ]);

        $authorId = $dbCo->lastInsertId();
    }

    if ($isOk2 && ($author && $author['id_author'] == $authorId)) {
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // Verify image type
            $allowedTypes = [IMAGETYPE_JPEG, IMAGETYPE_PNG];

            $imageFileInfo = @getimagesize($_FILES['image']['tmp_name']);
            if (!$imageFileInfo || !in_array($imageFileInfo[2], $allowedTypes)) {
                // Unauthorized img type, redirection with error msg
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



            // Récupérer les valeurs des cases à cocher cochées à partir du formulaire
            if (isset($_POST['genre']) && is_array($_POST['genre'])) {
                $selectedGenres = $_POST['genre'];
            } else {
                // Gérer le cas où aucune case n'est cochée
                $selectedGenres = []; // ou définir un comportement par défaut
            }

            //Je récupère la valeur dans $_post genre
            $nameGenre = strip_tags($_POST['genre']);

            //Je sélectionne l'id découlant du genre reçu dans le formulaire
            $queryGenresSelected = $dbCo->prepare("SELECT `genre`.`id_genre`
                                                        FROM `genre` 
                                                        JOIN `own` ON `genre`.`id_genre` = `own`.`id_genre`
                                                        JOIN `book` ON `own`.`id_book` = `book`.`id_book`
                                                        WHERE `name_genre` = :nameGenre");
            $isOkGenreName = $queryGenresSelected->execute(["nameGenre" => $nameGenre]);
            //Récupérer les id des genres cochés
            $genres = $queryGenresSelected->fetchAll();



            var_dump($genres);

            // foreach ($selectedGenres as $selectedGenre){
            // $queryGenreInsert = $dbCo->prepare("INSERT INTO own (id_genre) VALUES (:idGenre)");
            // $isOkGenreInsert = $queryGenreInsert->execute([
            //     "genre" => $selectedGenre
            // ]);
            // }


            $query = $dbCo->prepare("INSERT INTO book (title_book, nb_pages, id_author, image_url, release_date, synopsis)  VALUES(:title, :pages, :authorId, :imageUrl, :date, :synopsis)");
            $isOk1 = $query->execute([
                "title" => strip_tags($_POST['title']),
                "pages" => intval(strip_tags($_POST['pages'])),
                "authorId" => $authorId,
                "imageUrl" => $imageUrl,
                "date" => strip_tags($_POST['date']),
                "synopsis" => htmlspecialchars($_POST['synopsis'])
            ]);

            $isOk = $isOk1 && $isOk2;
            var_dump($_REQUEST);
            // header('location: new-book.php?msg=' . ($isOk ? 'ok' : 'ko'));
            // exit;
        }
    }
}
