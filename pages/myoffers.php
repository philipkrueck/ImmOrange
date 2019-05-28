<?php

    ### PHP Preparation

        // start session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        include('../includes/functions/private.php');
        include('../includes/functions/manage_favorites.php');
        include('../includes/results.php');        


    ### Functions

        function deletePropertyOffer($offer_id) {
            $delete_property_stmt = pdo()->prepare("DELETE FROM property_offer WHERE offer_id = :offer_id;");
            $delete_property_stmt->bindParam(':offer_id', $offer_id);
            $delete_property_stmt->execute();
        }

        function getOffer($offer_id) {
            $offer_statement = pdo()->prepare("SELECT * FROM property_offer WHERE offer_id = :offer_id;");
            $offer_statement->bindParam(':offer_id', $offer_id);
            $offer_statement->execute();
            return $offer_statement->fetch();
        }


    ### Business Logic

        if (isset($_GET['delete_offer_id'])) {
            // check that offer id is associated with logged in realtor
            $offer_id = $_GET['delete_offer_id'];
            $offer = getOffer($offer_id);
            if ($offer['realtor_id'] != $_SESSION['realtor_id']) {
                die('Sie haben keine Berechtigung zum Bearbeiten. Zurück zur <a href="../../index.php">Homepage</a>');
                return;
            }
            deletePropertyOffer($offer_id);
            // check if offer_id is in cookies
            $favorites = (isset($_COOKIE['favorites']) && !empty($_COOKIE['favorites'])) ? json_decode($_COOKIE['favorites'], true) : array();
            if (in_array($offer_id, $favorites)) {
                removeIdFromCookies($offer_id, $favorites);
            }
        }

        $curr_realtor_id = $_SESSION['realtor_id'];
        $sql_select = "SELECT * FROM property_offer WHERE realtor_id = '$curr_realtor_id'";

        // get count of query results
        $counter = 0;
        foreach (pdo()->query($sql_select) as $offer) {
            $counter++;
        }
?>

<!DOCTYPE html>
<html>

    <!-- HEAD-AREA -->
    <head>
    
        <!-- Homepage-Title -->
        <title>Meine Immobilien  ∙  ImmOrange GmbH</title>

        <!-- Styles -->
        <link rel="stylesheet" href="../css/styles.css">
        <link rel="stylesheet" href="../css/results.css">
        <link rel="stylesheet" href="../css/pages/myoffers.css">
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

            <!-- CONTENT-AREA -->
            <div class="content">

                <h2>Meine Immobilien</h2>

                <!-- BREADCRUM -->

                <div class="sub-line">
                    <div class="result-breadcrum">
                        <span class="result-counter">Anzahl: <b><?php echo $counter;?></b></span>
                    </div>
                    <a href="create_offer.php">
                        <div class="add-offer-container">                            
                            <span>hinzufügen</span>
                            <img src="../img/icons/add.png">                            
                        </div>
                    </a>
                </div>

                <div class="my-offers-container">

                    <!-- RESULTS-AREA -->
                    <div class="results-area" id="results">

                        <?php                        

                            if ($counter) {
                                showResults($sql_select, false);
                            } else {
                                echo '<div class="no-results">
                                        <span>Keine Immobilien vorhanden.</span>
                                      </div>';
                            }                               

                        ?>

                    </div>  

                    <!-- EDIT / DELETE-AREA -->
                    <div class="edit-delete-area">
                        <?php
                            include('../includes/functions/paging.php');
                            
                            foreach (pdo()->query($sql_select_with_paging) as $offer) {
                                echo '<div class="edit-delete-container">
                                    <a href="edit_offer.php?offer_id='.$offer['offer_id'].'">
                                        <img src="../img/icons/edit.png" title="bearbeiten">
                                    </a>
                                    <a href="myoffers.php?delete_offer_id='.$offer['offer_id'].'">
                                        <img class="delete" src="../img/icons/delete.png" title="löschen">                        
                                    </a>
                                </div>';
                            }
                        ?>   
                    </div>
                 </div>

            </div>
        </main>

        <!-- FOOTER-AREA -->
        <footer>
            <?php
                include('../includes/footer.php');
            ?>
        </footer>
    
    </body>

</html> 