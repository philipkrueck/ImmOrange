<?php
    require_once('../includes/functions/pdo.php');
    require_once('../includes/functions/private.php');
    include('../includes/functions/random_id.php');

    if(!isset($_GET['offer_id'])) {
        die('Immobilie existiert nicht. Zurück zur <a href="../../index.php">Homepage</a>');
        return;
    }

    // todo: check that offer_id is related to realtor

    $offer = getOffer($_GET['offer_id']);
    if($offer['realtor_id'] != $_SESSION['realtor_id']) {
        die('Sie haben keine Berechtigung zu bearbeiten. Zurück zur <a href="../../index.php">Homepage</a>');
        return;
    }

    if (isset($_POST['submit_offer'])) {
        if (checkAllPostVariablesAreSet()) {
            setSessionVariables();
            updatePropertyOffer($_GET['offer_id']);
            header("Location: offer.php?offer_id=".$rand_offer_id);
            return;
        } else {
            header("Location: create_offer.php?not_filled"); 
            return;
        }
    }

    function updatePropertyOffer($offer_id) {
        echo "update property offer";
    }

    function setSessionVariables() {
        $_SESSION['offer_name'] = $_POST['offer_name'];
        $_SESSION['number_of_rooms'] = $_POST['number_of_rooms'];
        $_SESSION['qm'] = $_POST['qm'];
        $_SESSION['price'] = $_POST['price'];
        $_SESSION['construction_year'] = '1998';
        $_SESSION['street'] = $_POST['street'];
        $_SESSION['house_number'] = $_POST['house_number'];
        $_SESSION['zip'] = $_POST['zip'];
        $_SESSION['city'] = $_POST['city'];
        $_SESSION['country'] = $_POST['country'];
        $_SESSION['is_apartment'] = isset($_POST["is_apartment"]) ? 1 : 0;
        $_SESSION['is_for_rent'] = isset($_POST["is_for_rent"]) ? 1 : 0;
        $_SESSION['has_basement'] = isset($_POST["has_basement"]) ? 1 : 0;
        $_SESSION['has_garden'] = isset($_POST["has_garden"]) ? 1 : 0;
        $_SESSION['has_balcony'] = isset($_POST["has_balcony"]) ? 1 : 0;
        $_SESSION['has_bathtub'] = isset($_POST["has_bathtub"]) ? 1 : 0;
        $_SESSION['has_elevator'] = isset($_POST["has_elevator"]) ? 1 : 0;
    }

    function checkAllPostVariablesAreSet() {
        if (($_POST['offer_name'] != '') and
            (isset($_POST['is_apartment'])) and
            (isset($_POST['is_for_rent'])) and
            ($_POST['number_of_rooms'] != '') and
            ($_POST['qm'] != '') and
            ($_POST['street'] != '') and
            ($_POST['house_number'] != '') and
            ($_POST['zip'] != '') and
            ($_POST['city'] != '') and
            ($_POST['country'] != '')
        ) {
            return true;
        }
        return false;
    }

    
    function getOffer($offer_id) {
        $offer_statement = pdo()->prepare("SELECT * FROM property_offer WHERE offer_id = :offer_id;");
        $offer_statement->bindParam(':offer_id', $offer_id);
        $offer_statement->execute();
        return $offer_statement->fetch();
    }

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