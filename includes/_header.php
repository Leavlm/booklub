

<header class="header">
    <ul class="header__lst">
        <li class="header__logo">
            <a href="index.php">
                <img class="header__img" src="img/petit-logo-blk.png" alt="icône de logo">
            </a>
        </li>
        <li class="header__nav hidden" id="header">
            <i class="fa-solid fa-bars header__icn"></i>
        </li>
    </ul>
    <nav class="nav hide" id="nav">
        <i class="hidden fa-solid fa-xmark header__icn nav__icn " id="nav__close"></i>
        <ul class="nav__lst">
            <li class="nav__itm"><a href="index.php">Accueil</a></li>
            <li class="nav__itm"><a href="new-book.php">Ajouter un livre</a></li>
            <li class="nav__itm">Boite à livres</li>
            <li class="cta__txt--little"> <?php if(empty($_SESSION)){ ?><a href="connexion.php">Connexion</a> <?php } else if (!empty($_SESSION)){?><a href="logout.php">Déconnexion</a><?php } ?></li>

            <?php if (!empty($_SESSION)) { ?><div class="nav__wrap">
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