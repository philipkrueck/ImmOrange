<!-- PHP-AREA -->
<?php

    include('../includes/functions/pdo.php');
    include('../includes/functions/manage_wishlist.php');

    // start session if not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // check if favorite was selected and if so, toggle in cookie
    $favorite_id = (isset($_GET['favorite_id']) && !empty($_GET['favorite_id'])) ? $_GET['favorite_id'] : null;
    if ($favorite_id) {
        toggleFavorite($favorite_id);
    }
?>

<!DOCTYPE html>
<html>

    <!-- HEAD-AREA -->
    <head>
    
        <!-- Homepage-Title -->
        <title>Meine Favoriten  ∙  ImmOrange GmbH</title>

        <!-- Link-Relations -->
        <link rel="stylesheet" href="../css/styles.css">
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" /> 

    </head>

    <!-- BODY-AREA -->
    <body>

        <!-- HEADER-AREA -->
        <header>
            <?php 
                include ('../includes/header.php');
            ?>
        </header>

        <!-- MAIN-AREA -->
        <main>

            <!-- CONTENT-AREA -->
            <div class="content">
            

                <!-- RESULTS-AREA -->
                <div class="results-area">

                    <?php 
                        $favorites = (isset($_COOKIE['favorites']) && !empty($_COOKIE['favorites'])) ? json_decode($_COOKIE['favorites'], true) : array();
                        include ('../includes/results.php');
                        showFavoriteResults($favorites);
                    ?>

                </div>

            </div>
        </main>

        <!-- FOOTER-AREA -->
        <footer>
            <?php
                include ('../includes/footer.php');
            ?>
        </footer>
    
    </body>

</html> 