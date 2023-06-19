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
        <section>
            <div class="rating__wrap">
                <img class="rating__img" src="img/blackwater-l.png" alt="Couverture du livre Blackwater">
                <img class="rating__icn" src="img/etoile.png" alt="note du livre">
            </div>

            <article class="description">
                <div class="description__wrap">
                    <h1 class="description__ttl">Titre du livre</h1>
                    <img class="description__icn" src="img/coeur.png" alt="coeur cliquable">
                </div>
                <p class="txt">Lorem ipsum dolor sit amet consectetur. Non etiam arcu donec augue ornare pulvinar nunc. Pellentesque
                    cum
                    nisl vitae rutrum faucibus sit. Proin convallis lectus adipiscing enim viverra lorem aliquam.</p>
            </article>

            
        </section>

        <aside class="suggestions">
            <h2 class="suggestions__ttl">Suggestions</h2>
        </aside>
        
    </main>

</body>



<?php require"footer.php" ?>
</html>