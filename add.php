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


            $genreName = $_POST['genre'];
            if (is_array($genreName)) {
                // Tableau pour stocker les résultats
                $genreResults = [];

                // Parcourir les éléments de $genreName
                foreach ($genreName as $genre) {
                    // Préparer la requête
                    $queryGenre = $dbCo->prepare("SELECT id_genre FROM genre WHERE name_genre = :nameGenre");

                    // Exécuter la requête avec le nom de genre actuel
                    $isOkGenre = $queryGenre->execute(["nameGenre" => $genre]);

                    // Récupérer les résultats pour le genre actuel
                    $genres = $queryGenre->fetch(PDO::FETCH_ASSOC);

                    if ($genres) {
                        $genreId = $genres['id_genre'];
                    }

                    $query = $dbCo->prepare("INSERT INTO book (title_book, nb_pages, id_author, image_url, release_date, synopsis)  VALUES(:title, :pages, :authorId, :imageUrl, :date, :synopsis)");
                    $isOk1 = $query->execute([
                        "title" => strip_tags($_POST['title']),
                        "pages" => intval(strip_tags($_POST['pages'])),
                        "authorId" => $authorId,
                        "imageUrl" => $imageUrl,
                        "date" => strip_tags($_POST['date']),
                        "synopsis" => htmlspecialchars($_POST['synopsis'])
                    ]);
                    
                    if ($isOk1) {
                        $bookId = $dbCo->lastInsertId();
                        $queryInsertOwn = $dbCo->prepare("INSERT INTO own (id_book, id_genre) VALUES (:idBook, :idGenre)");
                        $isOwnInserted = $queryInsertOwn->execute(["idBook" => $bookId, "idGenre" => $genreId]);
                    }

                    $isOk = $isOk1 && $isOk2;
                    header('location: new-book.php?msg=' . ($isOk ? 'ok' : 'ko'));
                    exit;
                    // Ajouter les résultats au tableau de résultats
                    // $genreResults[] = $genres;
                }
                
            }






            // $queryGenre = $dbCo->prepare("SELECT id_genre FROM genre WHERE name_genre = :nameGenre");
            // $isOkGenre = $queryGenre->execute(["nameGenre" => $genreName]);
            // $genres = $queryGenre->fetch(PDO::FETCH_ASSOC);
            // var_dump($genres);

            //Je récupère la valeur dans $_post genre
            // $nameGenre = $_POST['genre'];

            // //Je sélectionne l'id découlant du genre reçu dans le formulaire
            // $queryGenresSelected = $dbCo->prepare("SELECT `genre`.`id_genre`
            //                                             FROM `genre` 
            //                                             WHERE `name_genre` = :nameGenre");
            // $isOkGenreName = $queryGenresSelected->execute([
            //     "nameGenre" => $nameGenre
            // ]);
            // //Récupérer les id des genres cochés
            // $genres = $queryGenresSelected->fetch();
            // var_dump($genres);






            // $queryGenresAssociated = $dbCo->prepare("INSERT INTO own (id_genre, id_book) VALUES(:idGenre, :idBook)");
            // $isOkGenresAssociated = $queryGenresAssociated->execute([
            //     "idGenre" => $genres,
            //     "idBook" => $dbCo->lastInsertId()
            // ]);



        }
    }
}
