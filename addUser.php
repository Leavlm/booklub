<?php

require "includes/_database.php";
require "includes/_functions.php";

verifyToken();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $query = $dbCo->prepare("INSERT INTO users (firstname, lastname, email, password)  VALUES(:firstname, :lastname, :email, :password)");
    $isOk = $query->execute([
        "firstname" => strip_tags($_POST['firstname']),
        "lastname" => strip_tags($_POST['lastname']),
        "email" => strip_tags($_POST['email']),
        "password" => password_hash($_POST['password'], PASSWORD_DEFAULT)
    ]);

    header('location: connexion.php?msg=' . ($isOk ? 'userAdded' : 'invalidAddedUser'));
    exit;
}
