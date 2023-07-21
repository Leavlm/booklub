<?php 
session_start();

// -----------------------------
//   DISPLAY CATALOG
// -----------------------------

function getCatalog(array $array) :string{
    foreach($array as $book){
    return '<li class="card__wrap">
                    <a class="card__lnk" href="">
                        // <picture>
                        //     <source srcset="img/book-blackwater-lg.jpg" media="(min-width: 769px)">
                        //     <img src="img/book-blackwater.jpg" class="card__img" alt="couverture de livre">
                        // </picture>
                        <h3 class="card__ttl">'.$book['title_book'].'</h3>
                        <p class="card__txt">'.$book['author_name'].'</p>
                    </a>
                </li>';}
}




// -----------------------------
//   GET VALIDATION OR FAIL MSG 
// -----------------------------


$msgArray = [
    'ok' => 'Vôtre livre a bien été ajouté ! 🥳',
    'ko' => 'Vôtre livre n\'a pas pu être ajouté ! 😱',
    'wrongToken' => 'Le token est erroné ! 😱'
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

function verifyToken(){
    if(!array_key_exists('token', $_SESSION) || !array_key_exists('token', $_REQUEST) || $_SESSION['token'] !== $_REQUEST['token'] ){
        header('location: new-book.php?msg=wrongToken');    
        exit;
    }
}
