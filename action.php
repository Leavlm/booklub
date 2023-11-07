<?php
require "includes/_database.php";
include "includes/_head.php";
include "includes/_header.php";

verifyToken();

// -------------------------------------
// CRUD UPDATE COPY OF A BOOK
// -------------------------------------

if($_POST['action'] == "updateCopy"){
    $_SESSION['token'] = md5(uniqid(mt_rand(), true));
    echo getMsg($msgArray);
    
        $idCopy= strip_tags($_GET['copyId']);
    
        $queryUpdate = $dbCo->prepare("UPDATE `copy` SET `state` = :state, `price` = :price WHERE id_copy = :idCopy ");
        $isOk = $queryUpdate->execute([
            'state' => strip_tags($_REQUEST['state']),
            'price' => intval(strip_tags($_REQUEST['price'])),
            'idCopy' => $idCopy
        ]);
    
        header("Location: modifyCopy.php?copyId=" . $idCopy . "&msg=" . ($isOk ? 'copyModified' : 'copyNotModified'));
            exit;
        
}

//----------------------------
// CRUD DELETE COPY OF A BOOK
//----------------------------

if ($_POST['action'] == "deleteCopy") {
    $idCopy = strip_tags($_GET['copyId']);

    $queryDelete = $dbCo->prepare("DELETE FROM `copy` WHERE `id_copy` = :idCopy");
    $isOk = $queryDelete->execute([
        'idCopy' => $idCopy
    ]);
    header("Location: profile.php?msg=" . ($isOk ? 'copyDeleted' : 'copyNotDeleted'));
    exit;
}


//-----------------
//ADD FAVORITE
//-----------------

$idBook = $_POST['idBook'];
$userId = $_SESSION['user_id'];


if ($_POST['action'] == 'addFav'){
    $queryFavorise = $dbCo->prepare("INSERT INTO favorise (id_book, id_users) VALUES (:idBook, :idUsers) ON DUPLICATE KEY UPDATE id_book = :idBook" );
    $queryFavorise->execute([
            'idBook' => $idBook,
            'idUsers' => $userId]);
    header("Location: product-page.php?id=" . $idBook);
    exit;
}

if ($_POST['action'] == 'deleteFav'){
    $queryDeleteFavorite = $dbCo->prepare("DELETE FROM `favorise`
                                        WHERE `id_users` = :idUsers AND `id_book` = :idBook");
    $queryDeleteFavorite->execute([
    'idUsers' => $userId,
    'idBook'  => $idBook
]);
    header("Location: product-page.php?id=" . $idBook);
    exit;
}


//------------
// ADD REVIEW
//------------

// RAPPEL: la variable idBook est initiée dans ADD FAVORITE 
$id_users = $_SESSION['user_id'];
$date = date('Y-m-d');

if ($_POST['action'] == 'addReview'){
    $queryAddReview = $dbCo->prepare("INSERT INTO `ranking` (id_book, id_users, note, comment_ranking, title_ranking, date_ranking) VALUES (:id_book, :id_users, :note, :comment_ranking, :title_ranking, :date_ranking)");
    $isOk = $queryAddReview->execute([
        'id_book' => $idBook,
        'id_users' => $id_users,
        'note' => $_POST['note'],
        'comment_ranking' => htmlspecialchars($_POST['comment_ranking']),
        'title_ranking' => htmlspecialchars($_POST['title_ranking']),
        'date_ranking' => $date
    ]);
    header("Location: review.php?id=" . $idBook . "&msg=" . ($isOk ? 'reviewAdded' : 'reviewError'));
    exit;
}