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
                    <a class="card__lnk" href="">
                    <img src="' . $book['image_url'] . '" class="card__img" alt="couverture de livre">
                    <h3 class="card__ttl">' . $book['title_book'] . '</h3>
                    <p class="card__txt">' . $book['author_name'] . '</p>
                    </a>
                    </li>';
                }
                return $html;
            }
            
            // <picture>
            // <source srcset="' . $book['image_url'] . '" media="(min-width: 769px)">
            // </picture>



// -----------------------------
//   GET VALIDATION OR FAIL MSG 
// -----------------------------


$msgArray = [
    'ok' => 'Vôtre livre a bien été ajouté ! 🥳',
    'ko' => 'Vôtre livre n\'a pas pu être ajouté ! 😱',
    'wrongToken' => 'Le token est erroné ! 😱',
    'invalidImg' => 'Le format de votre image n\'est pas pris en charge'
];


function getMsg(array $array): string
{
    $msg = $_GET['msg'] ?? '';
    if (array_key_exists($msg, $array)) {
        return $array[$msg];
    }
    return '';
};

//---------------
//   VERIFY TOKEN 
//---------------

function verifyToken()
{
    if (!array_key_exists('token', $_SESSION) || !array_key_exists('token', $_REQUEST) || $_SESSION['token'] !== $_REQUEST['token']) {
        header('location: new-book.php?msg=wrongToken');
        exit;
    }
}
