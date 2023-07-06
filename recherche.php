

<?php include "includes/_head.php" ?>

<body>
    <?php require "includes/_header.php"
    ?>

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
                
            </ul>
        </section>

    </main>
    <?php require "footer.php" ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="script.js"></script>

</body>
</html>