<!-- PHP-AREA -->
<?php
    include ('../includes/functions/private.php');

    // includes results-area
    include ('../includes/results.php');

    // saves GET-Parameter
    if($_GET['city'] == 'hamburg' || $_GET['city'] == 'berlin'){
        $get_result = $_GET['city'];
    }else if($_GET['apartments'] == "0" || $_GET['apartments'] == "1"){
        $get_result = $_GET['apartments'];
    }else{
        die('Keine gültige Kategorie ausgewählt. <a href="/index.php">Zurück zur Homepage</a>');
    }

    // checking GET-Parameter and sets SQL
    switch($get_result){

        case '0':
            $title = 'Häuser';
            $sql_select = "SELECT * FROM property_offer WHERE is_apartment = $get_result";
        break;

        case '1':
            $title = 'Wohnungen';
            $sql_select = "SELECT * FROM property_offer WHERE is_apartment = $get_result";
        break;

        case 'hamburg':
            $title = 'Hamburg';
            $sql_select = "SELECT * FROM property_offer WHERE city = '$get_result'";
        break;

        case 'berlin':
            $title = 'Berlin';
            $sql_select = "SELECT * FROM property_offer WHERE city = '$get_result'";
        break;

    }

    // counts results
    $counter = 0;
    foreach (pdo()->query($sql_select) as $offer) {
        $counter++;
    }

    // can be set as favorite
    $do_favorite = false;

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

                <h2>Kategorie:
                    <?php
                        echo  $title;
                    ?>
                </h2>
                 

                <div class="result-breadcrum">
                            
                    <span class="result-counter">Anzahl: <b><?php echo $counter; ?></b></span>

                </div>        

                    <!-- RESULTS-AREA -->
                    <div class="results-area" id="results">

                        <?php                      

                            showResults($sql_select, $do_favorite);    

                        ?>

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