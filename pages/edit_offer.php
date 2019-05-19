<?php
    require_once('../includes/functions/pdo.php');

?>

<!DOCTYPE html>
<html>

    <?php
        require_once('../includes/functions/private.php');
        if (isset($_GET['offer_id'])){
            $_POST['offer_id'] = $_GET['offer_id'];
            $offer = get_offer();
            if($offer['realtor_id'] == $_SESSION['realtor_id']) {
                $_POST['offer_id'] = $_GET['offer_id'];
                $pageStateIsEditUI = true;
            } else {
                die('Sie haben keine Berechtigung diese Immobilie zu bearbeiten <a href="../index.php">Startseite</a>');
            }
        } else {
            $pageStateIsEditUI = false;
        }

    ?>

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