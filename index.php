<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <title>Accueil
    </title>
</head>

<body>
    <?php require "header.php";
    ?>

    <main>
        <section class="intro">
            <article class="intro__wrap">
                <h1 class="intro__ttl">Booklub</h1>
                <p class="intro__txt">Vous en avez marre de chercher <br>votre prochain livre ? <br></p>
                <a class="cta" href="">
                    <p class="cta__txt">Aidez moi à choisir</p>
                </a>
            </article>
        </section>

        <section>
            <article class="catalog">
                <h2 class="catalog__title">Coups de coeur de l'équipe</h2>
                <ul class="catalog__lst">
                    <li class="card__wrap">
                        <a class="card__lnk" href="">
                            <picture> <source srcset="/img/book-blackwater-lg.jpg" media="(min-width: 769px)">
                            <img src="/img/book-blackwater.jpg" class="card__img" alt="couverture de livre">
                        </picture>
                            <h3 class="card__ttl">Blackwater IV</h3>
                            <p class="card__txt">Michael McDowell</p>
                        </a>
                    </li>
                    <li class="card__wrap">
                        <a class="card__lnk" href="">
                            <picture><source srcset="/img/book-agatha-lg.jpg" media="(min-width: 769px)">
                            <img src="/img/book-agatha.jpg" class="card__img" alt="couverture de livre">
                        </picture>
                            <h3 class="card__ttl">Agatha Raisin 21</h3>
                            <p class="card__txt">M.C Beaton</p>
                        </a>
                    </li>
                    <li class="card__wrap">
                        <a class="card__lnk" href="">
                            <picture><source srcset="/img/book-oneofus-lg.jpg" media="(min-width: 769px)">
                            <img src="/img/book-oneofus.jpg" class="card__img" alt="couverture de livre">
                        </picture>
                            <h3 class="card__ttl">One of us is dead</h3>
                            <p class="card__txt">Jeneva Rose</p>
                        </a>
                    </li>
                    <li class="card__wrap">
                        <a class="card__lnk" href="">
                            <picture><source srcset="/img/book-parfaite-lg.jpg" media="(min-width: 769px)">
                            <img src="/img/book-parfaite.jpg" class="card__img" alt="couverture de livre">
                        </picture>
                            <h3 class="card__ttl">Parfaite</h3>
                            <p class="card__txt">Caroline Kepnes </p>
                        </a>
                    </li>
                    <li class="card__wrap">
                        <a class="card__lnk" href="">
                            <picture><source srcset="/img/book-oneofus-lg.jpg" media="(min-width: 769px)">
                            <img src="/img/book-oneofus.jpg" class="card__img" alt="couverture de livre">
                        </picture>
                            <h3 class="card__ttl">One of us is dead</h3>
                            <p class="card__txt">Jeneva Rose</p>
                        </a>
                    </li>
                    <li class="card__wrap">
                        <a class="card__lnk" href="">
                            <picture><source srcset="/img/book-parfaite-lg.jpg" media="(min-width: 769px)">
                            <img src="/img/book-parfaite.jpg" class="card__img" alt="couverture de livre">
                        </picture>
                            <h3 class="card__ttl">Parfaite</h3>
                            <p class="card__txt">Caroline Kepnes </p>
                        </a>
                    </li>
                    <li class="card__wrap">
                        <a class="card__lnk" href="">
                            <picture> <source srcset="/img/book-blackwater-lg.jpg" media="(min-width: 769px)">
                                <img src="/img/book-blackwater.jpg" class="card__img" alt="couverture de livre">
                            </picture>
                            <h3 class="card__ttl">Blackwater IV</h3>
                            <p class="card__txt">Michael McDowell</p>
                        </a>
                    </li>
                    <li class="card__wrap">
                        <a class="card__lnk" href="">
                            <picture><source srcset="/img/book-agatha-lg.jpg" media="(min-width: 769px)">
                                <img src="/img/book-agatha.jpg" class="card__img" alt="couverture de livre">
                            </picture>
                            <h3 class="card__ttl">Agatha Raisin 21</h3>
                            <p class="card__txt">M.C Beaton</p>
                        </a>
                    </li>
                </ul>

                <div class="cta__wrap">
                    <a class="cta cta__position" href="">
                        <p class="cta__txt--little">Voir plus</p>
                    </a>
                </div>
                
            </article>
    
            
        </section>
    </main>

    <?php require"footer.php" ?>
<script src="script.js"></script>
</body>

</html>