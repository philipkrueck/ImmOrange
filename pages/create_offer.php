<?php
    require_once('../includes/functions/pdo.php');
    require_once('../includes/functions/private.php');
    include('../includes/functions/random_id.php');
    
    if (isset($_POST['create_offer_submit'])) {
        setSessionVariables();
        $rand_address_id = get_random_id();
        insertAddressFromPostParameters($rand_address_id);
        header("Location: offer.php");
        return;
    }

    function setSessionVariables() {
       $_SESSION['offer_name'] = $_POST['offer_name'];
       $_SESSION['rooms'] = $_POST['rooms'];
       $_SESSION['qm'] = $_POST['qm'];
       $_SESSION['price'] = $_POST['price'];
       $_SESSION['street'] = $_POST['street'];
       $_SESSION['house_number'] = $_POST['house_number'];
       $_SESSION['zip'] = $_POST['zip'];
       $_SESSION['city'] = $_POST['city'];
       $_SESSION['country'] = $_POST['country'];
    }

    function insertAddressFromPostParameters($address_id) {
        $street = $_SESSION['street'];
        $house_number = $_SESSION['house_number'];
        $zip = $_SESSION['zip'];
        $city = $_SESSION['city'];
        $country = $_SESSION['country'];
        $insert_account_stmt = pdo()->prepare("INSERT INTO address VALUES (:address_id, :street, :house_number, :zip, :city, :country);");
        $insert_account_stmt->execute(array(':address_id' => $address_id, ':street' => $street, ':house_number' => $house_number, ':zip' => $zip, ':city' => $city, ':country' => $country));
    }


?>

<!DOCTYPE html>
<html>

    <head>
        <title>Page Title</title>
        <link rel="stylesheet" href="../css/styles.css">
    </head>
    <body>
        <header>
            <?php 
                include ('../includes/header.php');
            ?>
        </header>
        <main>
            <div class="content">
                <form action="create_offer.php" method="post" class="edit-offering-form">
                    <div class="name-input">
                        <input type="text" name="offer_name" placeholder="Titel" value="">
                    </div>

                    <div class="is_apartment-input">
                        <select id="is_apartment-input" name="is_apartment">
                            <option disabled selected>Haus oder Wohnung</option>
                            <option>Haus</option>
                            <option>Wohnung</option>
                        </select>
                    </div>

                    <div class="purchasing_type-input">
                        <select id="purchasing_type-input" name="purchasing_type">
                            <option disabled selected>mieten oder kaufen</option>
                            <option>mieten</option>
                            <option>kaufen</option>
                        </select>
                    </div>

                    <div class="rooms-input">
                        <input type="number" name="rooms" placeholder="Raumanzahl" value="">
                    </div>

                    <div class="living-space-input">
                        <input type="number" name="qm" placeholder="Wohnfläche (qm)" value="">
                    </div>

                    <div class="price-input">
                        <input type="number" name="price" placeholder="Preis (€)" value="">
                    </div>

                    <p>Placeholder image upload</p>

                    <div class="street-input">
                        <input type="text" name="street" placeholder="Straße" value="">
                    </div>

                    <div class="house_number-input">
                        <input type="text" name="house_number" placeholder="Hausnummer" value="">
                    </div>

                    <div class="zip-input">
                        <input type="text" name="zip" placeholder="zip" value="">
                    </div>

                    <div class="city-input">
                        <input type="text" name="city" placeholder="Stadt" value="">
                    </div>

                    <div class="country-input">
                        <input type="text" name="country" placeholder="Land" value="">
                    </div>

                    <!-- basement -->
                    <div class="checkbox-container">
                        <img src="../img/icons/basement.png" class="checkbox-icon">
                        <span class="checkbox-description">Garage</span>
                        <input type="checkbox" name="has_garage" value="">
                    </div>

                    <!-- garden -->
                    <div class="checkbox-container">
                        <img src="../img/icons/botanical.png" class="checkbox-icon">
                        <span class="checkbox-description">Garten</span>
                        <input type="checkbox" name="has_garden" value="1" >
                    </div>

                    <!-- balcony -->
                    <div class="checkbox-container">
                        <img src="../img/icons/balcony.png" class="checkbox-icon">
                        <span class="checkbox-description">Balkon</span>
                        <input type="checkbox" name="has_balcony"  value="1">
                    </div>

                    <!-- bathtub -->
                    <div class="checkbox-container">
                        <img src="../img/icons/bathtub.png" class="checkbox-icon">
                        <span class="checkbox-description">Badewanne</span>
                        <input type="checkbox" name="has_bathtub" value="1">
                    </div>

                    <!-- lift -->
                    <div class="checkbox-container">
                        <img src="/img/icons/lift.png" class="checkbox-icon">
                        <span class="checkbox-description">Fahrstuhl</span>
                        <input type="checkbox" name="has_elevator"  value="1">
                    </div>
                    </div>

                    <!-- fifth row -->
                    <div class="extended-search fifth-row">
                        <input type="submit" name="create_offer_submit">
                    </div>

                </form>
            </div>
        </main>
        <footer>
            <?php
                include ('../includes/footer.php');
            ?>
        </footer>
    
    </body>

</html> 