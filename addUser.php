<?php

require "includes/_database.php";
require "includes/_functions.php";

verifyToken();

if ($_SERVER['REQUEST_METHOD'] === 'POST' ) {
$q = $dbCo->prepare("SELECT email FROM users");
$isOK2 = $q->execute();
$existingEmails = $q->fetchAll(PDO::FETCH_COLUMN);

$enteredEmail = strip_tags($_POST['email']);
if (in_array($enteredEmail, $existingEmails)) {
    header('Location: connexion.php?msg=userAlreadyExists');
    exit;
}

    $query = $dbCo->prepare("INSERT INTO users (firstname, lastname, email, password)  VALUES(:firstname, :lastname, :email, :password)");
    $isOk = $query->execute([
        "firstname" => strip_tags($_POST['firstname']),
        "lastname" => strip_tags($_POST['lastname']),
        "email" => $enteredEmail,
        "password" => password_hash($_POST['password'], PASSWORD_DEFAULT)
    ]);


    header('location: connexion.php?msg=' . ($isOk ? 'userAdded' : 'invalidAddedUser'));
    exit;
}
