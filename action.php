<?php
require "includes/_database.php";
include "includes/_head.php";
include "includes/_header.php";

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
    
// }