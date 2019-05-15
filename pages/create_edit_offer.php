<!-- PHP-AREA -->
<?php
    function updateOrInsertDataInAccountWithPostParameters () {
        $offer_id = rand(1,200000000); // create random variable between one and 2^10
        $name = $_POST["name"];
        $address_id = 18; // address should be created by user
        $is_apartment = $_POST["is_apartment"];
        $purchasing_type = $_POST["purchasing_type"];
        $roomms = $_POST[""]
        address_id = $_POST["address_"]
        if (isset($_POST["submit-btn"])){
            $insert_stmt = pdo()->prepare("INSERT INTO offer (acc_id, acc_name) VALUES (:id, :name)");
            $insert_stmt->bindParam(':id', $id);
            $insert_stmt->bindParam(':name', $name);
            $insert_stmt->execute();
            $_POST['btn'] = NULL;
        }
    }
    updateOrInsertDataInAccountWithPostParameters ();
?>

<!DOCTYPE html>
<html>

    <!-- HEAD-AREA -->
    <head>
    
        <!-- Homepage-Title -->
        <title>Page Title</title>

        <!-- Link-Relations -->
        <link rel="stylesheet" href="../css/styles.css">
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" /> 
        <link rel="stylesheet" href="/css/pages/create_edit_offer_styles.css">

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

            <!-- BANNER-AREA -->
            <div class="banner">

                <!-- PLACEHOLDER -->
                <h2 style="
                    text-align: center;
                    padding-top: 100px;
                    margin: 0px;"
                >IMMOBILIE INSERIEREN</h2>

            </div>

            <!-- CONTENT-AREA -->
            <div class="content">           
                <form action="create_edit_offer" method="POST" class="edit-offering-form">
                    <div class="name-input">
                        <input type="text" name="name" placeholder="Titel" >
                    </div>

                    <div class="offering-type-input">
                        <select id="offering-type-input" name="offering_type">
                            <option disabled selected>Haus oder Wohnung</option>
                            <option>Haus</option>
                            <option>Wohnung</option>
                        </select>
                    </div>

                    <div class="purchasing-type-input">
                        <select id="purchasing-type-input" name="purchasing_type">
                            <option disabled selected>mieten oder kaufen</option>
                            <option>mieten</option>
                            <option>kaufen</option>
                        </select>
                    </div>

                    <div class="rooms-input">
                        <input type="number" name="rooms" placeholder="Raumanzahl">
                    </div>      

                    <div class="living-space-input">
                        <input type="number" name="living_space" placeholder="Wohnfläche (qm)">
                    </div>  
                    <p>Placeholder image upload</p> 
                    
                    <!-- basement -->
                    <div class="checkbox-container">
                        <img src="../img/icons/basement.png" class="checkbox-icon">
                        <span class="checkbox-description">Keller</span>
                        <input type="checkbox" name="basement" value="true">
                    </div>

                    <!-- garden -->
                    <div class="checkbox-container">
                        <img src="../img/icons/botanical.png" class="checkbox-icon">
                        <span class="checkbox-description">Garten</span>
                        <input type="checkbox" name="garden"  value="true">
                    </div>

                    <!-- balcony -->
                    <div class="checkbox-container">
                        <img src="../img/icons/balcony.png" class="checkbox-icon">
                        <span class="checkbox-description">Balkon</span>
                        <input type="checkbox" name="balcony"  value="true">
                    </div>

                    <!-- bathtub -->
                    <div class="checkbox-container">
                        <img src="../img/icons/bathtub.png" class="checkbox-icon">
                        <span class="checkbox-description">Badewanne</span>
                        <input type="checkbox" name="bathtub" value="true">
                    </div>

                    <!-- lift -->
                    <div class="checkbox-container">
                        <img src="/img/icons/lift.png" class="checkbox-icon">
                        <span class="checkbox-description">Fahrstuhl</span>
                        <input type="checkbox" name="lift"  value="true">
                    </div>
                    </div>

                    <!-- fifth row -->
                    <div class="extended-search fifth-row">
                        <input type="submit" name="submit-btn" value="Inserieren!"> 
                    </div>

                </form>
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