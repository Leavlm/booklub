<?php
include "includes/_head.php";
include "includes/_header.php";
require "includes/_database.php";
include "includes/_functions.php";

session_unset(); // Effacer toutes les données de session
session_destroy(); // Détruire la session

header('Location: index.php?msg=logout');
exit;
?>