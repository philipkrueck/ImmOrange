<?php
    require_once('../includes/functions/pdo.php');
    require_once('../includes/functions/private.php');
    include('../includes/functions/random_id.php');

    // start session if not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    if(!isset($_GET['offer_id'])) {
        die('Immobilie existiert nicht. Zurück zur <a href="../../index.php">Homepage</a>');
        return;
    }

    $offer = getOffer($_GET['offer_id']);
    if($offer['realtor_id'] != $_SESSION['realtor_id']) {
        die('Sie haben keine Berechtigung zu bearbeiten. Zurück zur <a href="../../index.php">Homepage</a>');
        return;
    }

    if (isset($_POST['submit_offer'])) {
        if (checkAllPostVariablesAreSet()) {
            setSessionVariables();
            updatePropertyOffer($_GET['offer_id']);
            header("Location: offer.php?offer_id=".$_GET['offer_id']);
            return;
        } else {
            header("Location: edit_offer.php?not_filled=1&offer_id=".$_GET['offer_id']); 
            return;
        }
    }

    function updatePropertyOffer($offer_id) {
        $image_insert_clause = ($_FILES['picture']['name'] != "") ? ", image_name = :image_name, image_mime = :image_mime, image_data = :image_data" : "";
        $update_sql = "UPDATE property_offer SET offer_name = :offer_name, is_apartment = :is_apartment, is_for_rent = :is_for_rent, number_of_rooms = :number_of_rooms, price = :price, qm = :qm, construction_year = :construction_year, has_garden = :has_garden, has_basement = :has_basement, has_bathtub = :has_bathtub, has_elevator = :has_elevator, has_balcony = :has_balcony, street = :street, house_number = :house_number, zip = :zip, city = :city, country = :country".$image_insert_clause." WHERE offer_id = :offer_id;";

        $insert_offer_stmt = pdo()->prepare($update_sql);
        $insert_offer_stmt->bindParam(':offer_id', $offer_id);
        $insert_offer_stmt->bindParam(':offer_name', $_SESSION['offer_name']);
        $insert_offer_stmt->bindParam(':is_apartment', $_SESSION['is_apartment']);
        $insert_offer_stmt->bindParam(':is_for_rent', $_SESSION['is_for_rent']);
        $insert_offer_stmt->bindParam(':number_of_rooms', $_SESSION['number_of_rooms']);
        $insert_offer_stmt->bindParam(':price', $_SESSION['price']);
        $insert_offer_stmt->bindParam(':qm', $_SESSION['qm']);
        $insert_offer_stmt->bindParam(':construction_year', $_SESSION['construction_year']);
        $insert_offer_stmt->bindParam(':has_garden', $_SESSION['has_garden']);
        $insert_offer_stmt->bindParam(':has_basement', $_SESSION['has_basement']);
        $insert_offer_stmt->bindParam(':has_bathtub', $_SESSION['has_bathtub']);
        $insert_offer_stmt->bindParam(':has_elevator', $_SESSION['has_elevator']);
        $insert_offer_stmt->bindParam(':has_balcony', $_SESSION['has_balcony']);
        $insert_offer_stmt->bindParam(':street', $_SESSION['street']);
        $insert_offer_stmt->bindParam(':house_number', $_SESSION['house_number']);
        $insert_offer_stmt->bindParam(':zip', $_SESSION['zip']);
        $insert_offer_stmt->bindParam(':city', $_SESSION['city']);
        $insert_offer_stmt->bindParam(':country', $_SESSION['country']);
        if ($_FILES['picture']['name'] != "") {
            $insert_offer_stmt->bindParam(':image_name', $_FILES['picture']['name']);
            $insert_offer_stmt->bindParam(':image_mime', $_FILES['picture']['type']);
            $image_data = file_get_contents($_FILES['picture']['tmp_name']);
            $insert_offer_stmt->bindParam(':image_data', $image_data);
        }
        $insert_offer_stmt->execute();
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
            ($_POST['price'] != '') and
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