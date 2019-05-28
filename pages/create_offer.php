<?php
    ### PHP Preparation

        require_once('../includes/functions/pdo.php');
        require_once('../includes/functions/private.php');
        include('../includes/functions/random_id.php');

        // start session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }


    ### Functions

        function setSessionVariables() {
            $_SESSION['offer_name'] = $_POST['offer_name'];
            $_SESSION['number_of_rooms'] = $_POST['number_of_rooms'];
            $_SESSION['qm'] = $_POST['qm'];
            $_SESSION['price'] = $_POST['price'];
            $_SESSION['construction_year'] = $_POST['construction_year'];
            $_SESSION['street'] = $_POST['street'];
            $_SESSION['house_number'] = $_POST['house_number'];
            $_SESSION['zip'] = $_POST['zip'];
            $_SESSION['city'] = $_POST['city'];
            $_SESSION['country'] = $_POST['country'];
            $_SESSION['is_apartment'] = $_POST["is_apartment"] == "Wohnung" ? 1 : 0;
            $_SESSION['is_for_rent'] = $_POST["is_for_rent"] == "mieten" ? 1 : 0;
            $_SESSION['has_basement'] = isset($_POST["has_basement"]) ? 1 : 0;
            $_SESSION['has_garden'] = isset($_POST["has_garden"]) ? 1 : 0;
            $_SESSION['has_balcony'] = isset($_POST["has_balcony"]) ? 1 : 0;
            $_SESSION['has_bathtub'] = isset($_POST["has_bathtub"]) ? 1 : 0;
            $_SESSION['has_elevator'] = isset($_POST["has_elevator"]) ? 1 : 0;
        }

        function insertPropertyOffer($offer_id) {
            $insert_offer_stmt = pdo()->prepare("INSERT INTO property_offer VALUES (:offer_id, :realtor_id, :offer_name, :is_apartment, :is_for_rent, :number_of_rooms, :price, :qm, :construction_year, :has_garden, :has_basement, :has_bathtub, :has_elevator, :has_balcony, :street, :house_number, :zip, :city, :country, :image_name, :image_mime, :image_data, now());");
            $insert_offer_stmt->bindParam(':offer_id', $offer_id);
            $insert_offer_stmt->bindParam(':realtor_id', $_SESSION['realtor_id']);
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
            $insert_offer_stmt->bindParam(':image_name', $_FILES['picture']['name']);
            $insert_offer_stmt->bindParam(':image_mime', $_FILES['picture']['type']);
            $image_data = file_get_contents($_FILES['picture']['tmp_name']);
            $insert_offer_stmt->bindParam(':image_data', $image_data);
            $insert_offer_stmt->execute();
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
                ($_POST['country'] != '') and
                ($_FILES['picture']['name'] != '') and
                ($_FILES['picture']['type'] != '') and
                ($_FILES['picture']['tmp_name'] != '')
            ) {
                return true;
            }
            return false;
        }

    
    ### Business Logic
        
        // insert property offer
        if (isset($_POST['submit_offer'])) {
            if (checkAllPostVariablesAreSet()) {
                setSessionVariables();
                $rand_offer_id = get_random_id();
                insertPropertyOffer($rand_offer_id);
                header("Location: offer.php?offer_id=".$rand_offer_id);
                return;
            } else {
                header("Location: create_offer.php?not_filled");
                return;
            }
        }    

        $page_is_in_edit_ui = false;
?>

<!DOCTYPE html>
<html>

    <!-- HEAD-AREA -->
    <head>

        <!-- Homepage-Title -->
        <title>Immobilie inserieren  ∙  ImmOrange GmbH</title>

        <!-- Styles -->
        <link rel="stylesheet" href="../css/styles.css">
        <link rel="stylesheet" href="../css/pages/index.css">
        <link rel="stylesheet" href="../css/pages/create_edit_offer.css">
        <link rel="stylesheet" type="text/css" href="/css/fonts/OpenSans.css">  


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
            ?>>
        </main>

        <!-- FOOTER-AREA -->
        <footer>
            <?php
                include('../includes/footer.php');
            ?>
        </footer>
    
    </body>

</html> 