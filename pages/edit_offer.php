<?php
    require_once('../includes/functions/pdo.php');
    require_once('../includes/functions/private.php');

?>

<!DOCTYPE html>
<html>

    <!-- HEAD-AREA -->
    <head>
        
        <!-- Homepage-Title -->
        <title>Immobilie bearbeiten</title>

        <!-- Link-Relations -->
        <link rel="stylesheet" href="../css/styles.css">
        <link rel="stylesheet" href="../css/pages/create_edit_offer.css">
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />  

    </head>

    <!-- BODY-AREA -->
    <body>

        <!-- HEADER-AREA -->
        <header>
            <?php 
                include('../includes/header.php');
            ?>
        </header>

        <!-- MAIN-AREA -->
        <main>
            <?php 
                $page_is_in_edit_ui = true;
                include('../includes/create_edit_offer.php');
            ?>
        </main>

        <!-- FOOTER-AREA -->
        <footer>
            <?php
                include ('../includes/footer.php');
            ?>
        </footer>
    </body>

</html> 