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
//CRUD ADD FAVORITE
//-----------------

$idBook = $_POST['idBook'];
$userId = $_SESSION['user_id'];

// var_dump($idBook, $userId);
// exit;


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