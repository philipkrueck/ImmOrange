<!-- PHP-AREA -->
<?php
    require_once('../includes/functions/pdo.php');
    require_once('../includes/functions/private.php');
    include('../includes/functions/random_id.php');

    if (isset($_POST['create_offer_submit'])) {
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

    function setSessionVariables() {
        $_SESSION['offer_name'] = $_POST['offer_name'];
        $_SESSION['number_of_rooms'] = $_POST['number_of_rooms'];
        $_SESSION['qm'] = $_POST['qm'];
        $_SESSION['price'] = $_POST['price'];
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

    function insertPropertyOffer($offer_id) {
        $offer_name = $_SESSION["offer_name"];
        $realtor_id = $_SESSION['realtor_id']; // set in private.php
        $is_apartment = $_SESSION['is_apartment'];
        $is_for_rent = $_SESSION['is_for_rent'];
        $number_of_rooms = $_SESSION['number_of_rooms'];
        $price = $_SESSION['price'];
        $qm = $_SESSION['qm'];
        $construction_year  = '1998';
        $has_basement = $_SESSION['has_basement'];
        $has_garden = $_SESSION['has_garden'];
        $has_balcony = $_SESSION['has_balcony'];
        $has_bathtub = $_SESSION['has_bathtub'];
        $has_elevator = $_SESSION['has_elevator'];
        $street = $_SESSION['street'];
        $house_number = $_SESSION['house_number'];
        $zip = $_SESSION['zip'];
        $city = $_SESSION['city'];
        $country = $_SESSION['country'];
        $image_name = $_FILES['picture']['name'];
        $image_mime = $_FILES['picture']['type'];
        $image_data = file_get_contents($_FILES['picture']['tmp_name']);
        
        $insert_offer_stmt = pdo()->prepare("INSERT INTO offer (offer_id, realtor_id, offer_name, is_apartment,	is_for_rent, number_of_rooms, price, qm, construction_year,	has_garden,	has_basement, has_bathtub,	has_elevator, has_balcony,	street,	house_number, zip, city, country, image_name, image_mime, image_data);");
        $insert_offer_stmt->execute(array(':offer_id' => $offer_id, 'realtor_id' => $realtor_id, ':offer_name' => $offer_name, ':is_apartment' => $is_apartment, ':is_for_rent' => $is_for_rent, ':number_of_rooms' => $number_of_rooms, ':price' => $price, ':qm' => $qm, ':construction_year' => $construction_year, ':has_garden' => $has_garden, ':has_basement' => $has_basement, ':has_bathtub' => $has_bathtub, ':has_elevator' => $has_elevator, ':has_balcony' => $has_balcony, ':street' => $street, ':house_number' => $house_number, ':zip' => $zip, ':city' => $city, ':country' => $country, ':image_name' => $image_name, ':image_mime' => $image_mime, ':image_data' => $image_data));
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
?>

<!DOCTYPE html>
<html>

    <!-- HEAD-AREA -->
    <head>

        <!-- Homepage-Title -->
        <title>Page Title</title>

        <!-- Includes -->
        <?php
            include('../includes/functions/image_upload.php');
            include ('../includes/features/jquery.php');
            include ('../includes/features/autocomplete.php');
            include ('../includes/features/combobox.php');
        ?>

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
            ?>>
        </main>

        <!-- FOOTER-AREA -->
        <footer>
            <?php
                include ('../includes/footer.php');
            ?>
        </footer>
    
    </body>

</html> 