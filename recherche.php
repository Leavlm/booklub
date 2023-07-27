<?php include "includes/_head.php";
require "includes/_header.php";
?>

<main>
    <form action="" method="" class="search search-form-js">
        <label class="search__label" for="recherche">Vous cherchez un livre ?</label>
        <input class="search__input" type="search" id="recherche" name="keywords" placeholder="Les misérables">
    </form>

    <!-- <div class="dropdown filters">
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
            </div> -->


    <section class="catalog">
        <!-- <ul class="catalog__lst catalog__lst--spacing">

        </ul> -->
    </section>

</main>
<?php require "includes/_footer.php" ?>

<script type="module" src="js/search.js"></script>

</body>

</html>