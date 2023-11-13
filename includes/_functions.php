<?php
session_start();

// -----------------------------
//   DISPLAY CATALOG
// -----------------------------

function getCatalog(array $array): string
{
    $html = '';
    foreach ($array as $book) {
        $html .= '<li class="card__wrap card-catalog-js">
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

function getHorizontalCatalog(array $array): string
{
    $html = '';
    foreach ($array as $book) {
        $html .= '<li class="card-js card__listItem js-list-item">
                    <img src="' . $book['image_url'] . '" class="card__img" alt="couverture de livre">
                    <h3 class="card__txt limited-characters-js">' . $book['title_book'] . '</h3>
                    </li>';
    }
    return $html;
}

function getTheBooksYoureSelling(array $array): string
{
    $html = '';
    foreach ($array as $book) {
        $html .= '<li class="listingCopies__wrap listingCopies__list--vertical list-js">
        <button class="listingCopies__btn listingCopies__centered"><a href="modifyCopy.php?bookId='. $book['id_book'].'&copyId='.$book['id_copy'].'"><i class="fa-solid fa-pen"></i></a></button>
        <img src="' . $book['image_url'] . '" class="listingCopies__img listingCopies__centered" alt="couverture de livre">
        <div class="listingCopies__txt--vertical listingCopies__wrap--txt">
        <h3 class="limited-characters-js listingCopies__ttl--vertical">' . $book['title_book'] . '</h3>
        <div class="listingCopies__txt--horizontal">
        <p>Etat: '.$book['state'].'</p>
        <p>Prix: '.$book['price'].'€</p>
        </div>
        </div>
        <button class="listingCopies__btn listingCopies__centered"><a href="deleteCopy.php?bookId='. $book['id_book'].'&copyId='.$book['id_copy'].'"><i class="fa-solid fa-xmark"></i></a></button>
                    </li>';
    }
    return $html;
}



function getYourCopy(array $array): string
{
    $html = '';
    foreach ($array as $book) {
        $html .= '<li class="card__wrap card-js-black card__lnk">
                    <img src="' . $book['image_url'] . '" class="card__img" alt="couverture de livre">
                    <h3 class="card__ttl limited-characters-js">' . $book['title_book'] . '</h3>
                    </li>';
    }
    return $html;
}

function getCopiesByUser(array $array) :string
{
    $html = '<li class="listingCopies__txt listingCopies__list">
    <p class="limited-characters-js listingCopies__subttl">Utilisateur</p>
    <p class="limited-characters-js listingCopies__subttl listingCopies__middle">Prix</p>
    <p class="limited-characters-js listingCopies__subttl listingCopies__right">Etat</p>
    </li>';
    foreach ($array as $book) {
        $html .= '<li><a href="market.php"  class="listingCopies__txt listingCopies__list">
                    <p class="limited-characters-js">' . $book['firstname'] . '</p>
                    <p class="limited-characters-js listingCopies__middle">' . $book['price'] . '€</p>
                    <p class="limited-characters-js listingCopies__right">' . $book['state'] . '</p>
                    </a></li>';
    }
    return $html;
}



function getSuggestions(array $array): string
{
    $html = '<ul class="suggestions__lst">';
    foreach ($array as $book){
        $html .= '<li class="suggestions__img"><img  src="'.$book['image_url'].'"></li>';
    }
    return $html .= '</ul>';
}

function displayReview(array $array) :string
{
    $html = '<ul class="">';
    foreach ($array as $book){
        $html .= '<li class="">
        <h3>'.$book['title_ranking'].'</h3>
        <img src="img/'.$book['note'].'-star.png">
        <p>'.$book['comment_ranking'].'</p>';
    }
    return $html .= '</ul>';
}

function avgReview(array $array) :string
{

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
    'userAlreadyExists' => 'Vous possédez déjà un compte',
    'logout' => 'Vous êtes déconnecté',
    'bookInStore' => 'Votre livre est désormais en vente',
    'bookNotInStore' => 'Votre livre n\'a pas pu être mis en vente',
    'copyNotModified' => 'Votre exemplaire n\'a pas pu être modifiée',
    'copyModified' => 'Votre exemplaire a bien été modifié',
    'copyDeleted' => 'Votre exemplaire a bien été supprimé',
    'copyNotDeleted' => 'Votre exemplaire n\'a pas pu être supprimé',
    'reviewAdded' => 'Votre avis a été ajouté',
    'reviewError' => 'Une erreur s\'est produite, veuillez réessayer.'
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

// function verifyToken()
// {
//     if (!array_key_exists('token', $_SESSION) || !array_key_exists('token', $_REQUEST) || $_SESSION['token'] !== $_REQUEST['token']) {
//         header('location: index.php?msg=wrongToken');
//         exit;
//     }
// }

function verifyToken()
{
    $sessionToken = $_SESSION['token'] ?? null;
    $requestToken = $_REQUEST['token'] ?? null;
    
    if (!$sessionToken || $sessionToken !== $requestToken) {
        header('Location: index.php?msg=wrongToken');
        exit;
    }
}
