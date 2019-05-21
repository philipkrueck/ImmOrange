<!-- PHP-AREA -->
<?php
    include ('../includes/functions/private.php');

    // saves GET-Parameter
    if(isset($_GET['city'])){
        $get_result = $_GET['city'];
    }elseif(isset($_GET['apartments'])){
        $get_result = $_GET['apartments'];
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

                            // includes results-area
                            include ('../includes/results.php');
    

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