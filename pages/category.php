<?php
    ### PHP Preparation

        // start session if not already started
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        error_reporting(E_ALL ^ E_NOTICE);
        include('../includes/functions/pdo.php');
        include('../includes/functions/manage_favorites.php');
        include('../includes/results.php');        

    
    ### Business Logic

        // check if favorite was selected and if so, toggle in cookie
        $favorite_id = (isset($_GET['favorite_id']) && !empty($_GET['favorite_id'])) ? $_GET['favorite_id'] : null;
        if ($favorite_id) {
            toggleFavorite($favorite_id);
        }

        // checking GET-Parameter and sets SQL
        if (isset($_GET['category'])) {
            switch($_GET['category']) {
                case 'houses':
                    $title = 'Häuser';
                    $sql_select = "SELECT * FROM property_offer WHERE is_apartment = '0'";
                break;

                case 'apartments':
                    $title = 'Wohnungen';
                    $sql_select = "SELECT * FROM property_offer WHERE is_apartment = '1'";
                break;

                case 'hamburg':
                    $title = 'Hamburg';
                    $sql_select = "SELECT * FROM property_offer WHERE city = 'Hamburg'";
                break;

                case 'berlin':
                    $title = 'Berlin';
                    $sql_select = "SELECT * FROM property_offer WHERE city = 'Berlin'";
                break;

                default:
                    die('Keine gültige Kategorie ausgewählt. <a href="/index.php">Zurück zur Homepage</a>');
                break;
            }
        } else {
            die('Keine gültige Kategorie ausgewählt. <a href="/index.php">Zurück zur Homepage</a>');
        }

        // counts results
        $counter = getResultsCount($sql_select);
?>

<!DOCTYPE html>
<html>

    <!-- HEAD-AREA -->
    <head>
    
        <!-- Homepage-Title -->
        <title>Kategorien  ∙  ImmOrange GmbH</title>

        <!-- Styles -->
        <link rel="stylesheet" href="../css/styles.css">
        <link rel="stylesheet" href="../css/results.css">
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

                <h2>Kategorie: <?php echo  $title; ?></h2>                    

                <!-- RESULTS-AREA -->
                <div class="results-area" id="results">

                    <?php        
                        showResultsHeader($sql_select, false);

                        if ($counter) {
                            showResults($sql_select, true);
                        } else {
                            echo '<div class="no-results">
                                    <span>Keine Immobilien vorhanden.</span>
                                    </div>';
                        }      
                    ?>

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