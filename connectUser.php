<?php

require "includes/_database.php";
require "includes/_functions.php";

verifyToken();

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $email = htmlspecialchars($_POST['email']);
        $password = $_POST['password'];
    
        // Requête préparée pour sélectionner l'utilisateur en fonction de l'e-mail
        $query = $dbCo->prepare("SELECT id_users, email, password FROM users WHERE email = :email");
        $query->bindParam(":email", $email);
        $query->execute();
        $user = $query->fetch(PDO::FETCH_ASSOC);
        $hachedPwd = $user['password'];
    
        if ($user && password_verify($password, $user['password'])) {
            session_start();
            $_SESSION['user_id'] = $user['id_users'];
            header('Location: connexion.php?msg=connexion'); // Redirect to dashboard after successful login
            exit;
        } else {
            header('Location: connexion.php?msg=userNotFound');
            exit;
        }
    } else {
        header('Location: connexion.php?msg=connexionFailed');
        exit;
    }

