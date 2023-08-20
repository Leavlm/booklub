<?php require "includes/_functions.php";

?>

<header class="header">
    <ul class="header__lst">
        <li class="header__logo">
            <a href="index.php">
                <img class="header__img logo-js" src="img/petit-logo-blk.png" alt="icône de logo">
            </a>
        </li>
        <li class="form-check form-switch header__switch">
            <input class="form-check-input" type="checkbox" role="switch" id="dark-mode-toggle">
            <label class="form-check-label " for="dark-mode-toggle"><i class="fa-solid fa-moon toggle-icon-js"></i></label>
        </li>
        <li class="header__nav hidden" id="header">
            <i class="fa-solid fa-bars header__icn"></i>
        </li>
    </ul>
    <nav class="nav hide light__nav" id="nav">
        <i class="hidden fa-solid fa-xmark header__icn nav__icn " id="nav__close"></i>
        <ul class="nav__lst light__nav">
            <li class="nav__itm"><a href="index.php">Accueil</a></li>
            <li class="nav__itm"><a href="new-book.php">Ajouter un livre</a></li>
            <!-- <li class="nav__itm">Boite à livres</li> -->
            <li class="cta__txt--little"> <?php if (!array_key_exists('user_id', $_SESSION)) { ?><a href="connexion.php">Connexion</a> <?php } else if (isset($_SESSION) && array_key_exists('user_id', $_SESSION)) { ?><a href="logout.php">Déconnexion</a><?php } ?></li>

            <?php if (array_key_exists('user_id', $_SESSION) && isset($_SESSION)) { ?><div class="nav__wrap">
                    <li class="nav__itm">
                        <a href="profile.php">
                            <i class="fa-solid fa-user header__icn"></i>
                        </a>
                    </li> <?php } ?>
                <li class="nav__itm">
                    <a href="recherche.php">
                        <i class="fa-solid fa-magnifying-glass header__icn"></i>
                    </a>
                </li>
                </div>
        </ul>
    </nav>
</header>