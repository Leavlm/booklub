<?php
session_start();

// -----------------------------
//   DISPLAY CATALOG
// -----------------------------

function getCatalog(array $array): string
{
    $html = '';
    foreach ($array as $book) {
        $html .= '<li class="card__wrap">
                    <a class="card__lnk" href="http://localhost/booklub/product-page.php?id=' . $book['id_book'] . '">
                    <img src="' . $book['image_url'] . '" class="card__img" alt="couverture de livre">
                    <h3 class="card__ttl limited-characters-js">' . $book['title_book'] . '</h3>
                    </a>
                    </li>';
                }
                return $html;
            }
            
            // <p class="card__txt">' . $book['author_name'] . '</p>
// <picture>
// <source srcset="' . $book['image_url'] . '" media="(min-width: 769px)">
// </picture>





function getSuggestions(array $array): string
{
    $html = '<ul class="suggestions__lst">';
    foreach ($array as $book){
        $html .= '<li class="suggestions__img"><img  src="'.$book['image_url'].'"></li>';
    }
    return $html .= '</ul>';
}
// -----------------------------
//   GET VALIDATION OR FAIL MSG 
// -----------------------------


$msgArray = [
    'ok' => 'Votre livre a bien été ajouté ! 🥳',
    'ko' => 'Votre livre n\'a pas pu être ajouté ! 😱',
    'wrongToken' => 'Le token est erroné ! 😱',
    'invalidImg' => 'Le format de votre image n\'est pas pris en charge',
    'invalidId' => 'Le livre que vous avez demandé n\'est pas disponible',
    'userAdded' => 'L\'utilisateur a été créé',
    'invalidAddedUser' => 'L\'utilisateur n\'a pas pu être créé',
    'connexion' => 'Vous êtes connecté',
    'connexionFailed' => 'Impossible de se connecter',
    'userNotFound' => 'L\'utilisateur n\'existe pas',
    'userAlreadyExists' => 'Vous possédez déjà un compte'
];


function getMsg(array $array): string
{
    $msg = $_GET['msg'] ?? '';
    if (array_key_exists($msg, $array)) {
        return '<div class="alert alert-dark text-center" role="alert">
        '.$array[$msg].'
      </div>';
    }
    return '';
};



//---------------
//   VERIFY TOKEN 
//---------------

function verifyToken()
{
    if (!array_key_exists('token', $_SESSION) || !array_key_exists('token', $_REQUEST) || $_SESSION['token'] !== $_REQUEST['token']) {
        header('location: index.php?msg=wrongToken');
        exit;
    }
}
