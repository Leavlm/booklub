

<?php
// Vérifiez si une action est passée en POST

// var_dump($_POST);
if (isset($_POST['action'])) {
    $action = $_POST['action'];
    if ($action === 'add') {
        $queryFavorise = $dbCo->prepare("INSERT INTO favorise (id_book, id_users) VALUES (:idBook, :idUsers) ON DUPLICATE KEY UPDATE id_book = :idBook" );
        $queryFavorise->execute([
            'idBook' => $idBook,
            'idUsers' => $userId]);
        $response = ['success' => true];
    } elseif ($action === 'remove') {
        // Code pour supprimer le livre des favoris
        $queryDeleteFavorite = $dbCo->prepare("DELETE FROM favorise
                                        WHERE id_users = :idUsers AND id_book = :idBook");
$queryDeleteFavorite->execute([
    'idUsers' => $userId,
    'idBook'  => $idBook
]);
        $response = ['success' => true];
    } else {
        $response = ['success' => false, 'message' => 'Action inconnue'];
    }
} else {
    $response = ['success' => false, 'message' => 'Aucune action spécifiée'];
}

// Envoie de la réponse JSON
header('Content-Type: application/json');
echo json_encode($response);