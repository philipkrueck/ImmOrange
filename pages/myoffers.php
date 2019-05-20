<!-- PHP-AREA -->
<?php
    include ('../includes/functions/private.php');
?>

<!DOCTYPE html>
<html>

    <!-- HEAD-AREA -->
    <head>
    
        <!-- Homepage-Title -->
        <title>Page Title</title>

        <!-- Link-Relations -->
        <link rel="stylesheet" href="../css/styles.css">
        <link rel="stylesheet" href="../css/pages/myoffers.css">
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

                <h2>Meine Immobilien</h2>

                <?php 
                    $do_favorite = false;
                    $curr_realtor_id = $_SESSION['realtor_id'];
                                                                            
                    $sql_select = "SELECT * FROM property_offer WHERE realtor_id = '$curr_realtor_id'";

                    echo '
                    <div class="result-breadcrum">';
                        $counter = 0;
                        foreach (pdo()->query($sql_select) as $offer) {
                            $counter++;
                        }

                        echo '<span class="result-counter">Anzahl: <b>'; echo $counter; echo '</b></span>

                    </div>';
                ?>
            

                <div class="my-offers-container">

                    <!-- RESULTS-AREA -->
                    <div class="results-area" id="results">

                        <?php                        

                            // includes results-area
                            include ('../includes/results.php');

                            echo'</div>';     

                        ?>

                    <div class="edit-delete-area">
                        <?php
                            foreach (pdo()->query($sql_select) as $offer) {
                                echo '<div class="edit-delete-container">
                                    <a href="edit_offer.php?offer_id='.$offer['offer_id'].'">
                                        <img src="../img/icons/edit.png" title="bearbeiten">
                                    </a>
                                    <img class="delete" src="../img/icons/delete.png" title="löschen">                        
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
                include ('../includes/footer.php');
            ?>
        </footer>
    
    </body>

</html> 