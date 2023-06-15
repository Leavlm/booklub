<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;800&display=swap"
        rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Merriweather&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/style.css">
    <title>Recherche
    </title>
</head>

<body>
    <?php require "header.php"
    ?>
    </header>

    <main>
        <section class="search__wrap">
            <label class="search__label" for="recherche">Vous cherchez un livre ?</label>
            <input class="search__input" type="search" id="recherche" name="q" placeholder="Les misérables">
            <button class="search__btn">Chercher</button>
        </section>

        <div class="dropdown filters">
            <button class="btn dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                Filters
            </button>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="#">
                        <div class="filters__wrap">
                            <input class="filters__input" type="checkbox" value="" id="filters">
                            <label class="filters__label" for="filters">
                                <p>E-book</p>
                            </label>
                        </div>
                    </a></li>
                <li><a class="dropdown-item" href="#">
                        <div class="filters__wrap">
                            <input class="filters__input" type="checkbox" value="" id="filters">
                            <label class="filters__label" for="filters">
                                <p>Livre audio</p>
                            </label>
                        </div>
                    </a></li>
                <li><a class="dropdown-item" href="#">
                        <div class="filters__wrap">
                            <input class="filters__input" type="checkbox" value="" id="filters">
                            <label class="filters__label" for="filters">
                                <p>Papier</p>
                            </label>
                        </div>
                    </a></li>
            </ul>
        </div>


        <section class="catalog">
            <ul class="catalog__lst catalog__lst--spacing">
                <li class="card__wrap">
                    <a class="card__lnk" href="">
                        <picture>
                            <source srcset="/img/book-blackwater-lg.jpg" media="(min-width: 769px)">
                            <img src="/img/book-blackwater.jpg" class="card__img" alt="couverture de livre">
                        </picture>
                        <h3 class="card__ttl">Blackwater IV</h3>
                        <p class="card__txt">Michael McDowell</p>
                    </a>
                </li>
                <li class="card__wrap">
                    <a class="card__lnk" href="">
                        <picture>
                            <source srcset="/img/book-agatha-lg.jpg" media="(min-width: 769px)">
                            <img src="/img/book-agatha.jpg" class="card__img" alt="couverture de livre">
                        </picture>
                        <h3 class="card__ttl">Agatha Raisin 21</h3>
                        <p class="card__txt">M.C Beaton</p>
                    </a>
                </li>
                <li class="card__wrap">
                    <a class="card__lnk" href="">
                        <picture>
                            <source srcset="/img/book-oneofus-lg.jpg" media="(min-width: 769px)">
                            <img src="/img/book-oneofus.jpg" class="card__img" alt="couverture de livre">
                        </picture>
                        <h3 class="card__ttl">One of us is dead</h3>
                        <p class="card__txt">Jeneva Rose</p>
                    </a>
                </li>
                <li class="card__wrap">
                    <a class="card__lnk" href="">
                        <picture>
                            <source srcset="/img/book-parfaite-lg.jpg" media="(min-width: 769px)">
                            <img src="/img/book-parfaite.jpg" class="card__img" alt="couverture de livre">
                        </picture>
                        <h3 class="card__ttl">Parfaite</h3>
                        <p class="card__txt">Caroline Kepnes </p>
                    </a>
                </li>
                <li class="card__wrap">
                    <a class="card__lnk" href="">
                        <picture>
                            <source srcset="/img/book-blackwater-lg.jpg" media="(min-width: 769px)">
                            <img src="/img/book-blackwater.jpg" class="card__img" alt="couverture de livre">
                        </picture>
                        <h3 class="card__ttl">Blackwater IV</h3>
                        <p class="card__txt">Michael McDowell</p>
                    </a>
                </li>
                <li class="card__wrap">
                    <a class="card__lnk" href="">
                        <picture>
                            <source srcset="/img/book-oneofus-lg.jpg" media="(min-width: 769px)">
                            <img src="/img/book-oneofus.jpg" class="card__img" alt="couverture de livre">
                        </picture>
                        <h3 class="card__ttl">One of us is dead</h3>
                        <p class="card__txt">Jeneva Rose</p>
                    </a>
                </li>
                <li class="card__wrap">
                    <a class="card__lnk" href="">
                        <picture>
                            <source srcset="/img/book-parfaite-lg.jpg" media="(min-width: 769px)">
                            <img src="/img/book-parfaite.jpg" class="card__img" alt="couverture de livre">
                        </picture>
                        <h3 class="card__ttl">Parfaite</h3>
                        <p class="card__txt">Caroline Kepnes </p>
                    </a>
                </li>
                <li class="card__wrap">
                    <a class="card__lnk" href="">
                        <picture>
                            <source srcset="/img/book-agatha-lg.jpg" media="(min-width: 769px)">
                            <img src="/img/book-agatha.jpg" class="card__img" alt="couverture de livre">
                        </picture>
                        <h3 class="card__ttl">Agatha Raisin 21</h3>
                        <p class="card__txt">M.C Beaton</p>
                    </a>
                </li>
            </ul>
        </section>

    </main>
    <?php require "footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="script.js"></script>

</body>
</html>