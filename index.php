<!-- PHP-AREA -->
<?php

    //if errors appear, show all of them
    error_reporting(E_ALL);
    ini_set('display_errors', '1');

    //setting all variables for the extended search
    $location = (isset($_POST['location'])) ? $_POST['location'] : 0;
    $purchase_type = (isset($_POST['purchase_type'])) ? $_POST['purchase_type'] : 0;
    $offer_type = (isset($_POST['offer_type'])) ? $_POST['offer_type'] : 0;
    $rooms = (isset($_POST['rooms'])) ? $_POST['rooms'] : 0;
    $living_space = (isset($_POST['living_space'])) ? $_POST['living_space'] : 0;
    $price_range = (isset($_POST['price_range'])) ? $_POST['price_range'] : 0;
    $garden = (isset($_POST['garden'])) ? $_POST['garden'] : 0;
    $basement = (isset($_POST['basement'])) ? $_POST['basement'] : 0;
    $balcony = (isset($_POST['balcony'])) ? $_POST['balcony'] : 0;
    $bathtub = (isset($_POST['bathtub'])) ? $_POST['bathtub'] : 0;
    $lift = (isset($_POST['lift'])) ? $_POST['lift'] : 0;
    $price_min = (isset($_POST['price_min'])) ? $_POST['price_min'] : 0;
    $price_max = (isset($_POST['price_max'])) ? $_POST['price_max'] : 0;
    $full_text_search = (isset($_POST['$full_text_search'])) ? $_POST['$full_text_search'] : 0;;
    

?>

<!DOCTYPE html>
<html>

    <!-- HEAD-AREA -->
    <head>
    
        <!-- Homepage-Title -->
        <title>Page Title</title>

        <!-- Feature-Includes -->
        <?php 
            include ('includes/features/jquery.php');
            include ('includes/features/autocomplete.php');
            include ('includes/features/combobox.php');
            include ('includes/features/price_range.php');
            include ('includes/features/search_tabs.php');
        ?>

        <!-- Link-Relations -->
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />        
        

    </head>

    <!-- BODY-AREA -->
    <body>

        <!-- HEADER-AREA -->
        <header>
            <?php 
                include ('includes/header.php');
            ?>
        </header>

        <!-- MAIN-AREA -->
        <main>

            <!-- CONTENT-AREA -->
            <div class="content">
            
                <!-- SEARCH-AREA -->
                <div class="search-area">

                    <!-- SEARCH-TABS -->
                    <div id="search-tabs">
                        <ul>
                            <li><a href="#tabs-1">Erweiterte Suche</a></li>
                            <li><a href="#tabs-2">Suche</a></li>
                        </ul>

                        <!-- EXTENDED-SEARCH-AREA -->
                        <div id="tabs-1">

                            <form action="#results" method="POST" class="extended-search">

                                <!-- first row -->
                                <div class="extended-search first-row">

                                    <!-- location -->
                                    <div class="location-input">
                                        <input type="text" id="tags" name="location" placeholder="Ort" >
                                    </div>

                                    <!-- purchase-type -->
                                    <div class="purchase-type-input">
                                        <select id="purchase-type-input" name="purchase_type">
                                            <option disabled selected>mieten oder kaufen</option>
                                            <option>mieten</option>
                                            <option>kaufen</option>
                                            <option>egal</option>
                                        </select>
                                    </div>

                                    <!-- offer-type -->
                                    <div class="offer-type-input">
                                        <select id="offer-type-input" name="offer_type">
                                            <option disabled selected>Immobilienart</option>
                                            <option>Wohnung</option>
                                            <option>Haus</option>
                                        </select>
                                    </div>
                                </div>

                                <!-- second row -->
                                <div class="extended-search second-row">

                                    <!-- rooms -->
                                    <div class="rooms-input">
                                        <select id="rooms-input" name="rooms">
                                            <option disabled selected>Zimmer</option>
                                            <option>1</option>
                                            <option>2</option>
                                            <option>3</option>
                                            <option>4</option>
                                            <option>> 4</option>
                                        </select>
                                    </div>

                                    <!-- living-space -->
                                    <div class="living-space-input">
                                        <input type="number" name="living_space" placeholder="Wohnfläche (qm)">
                                    </div>

                                </div>

                                <!-- thrid row -->
                                <h3>Preisspanne:</h3>
                                <div class="extended-search third-row">

                                    <!-- price-range -->
                                    <div class="price-range-input">

                                        <!-- hidden inputs to catch price-values for POST-Method -->
                                        <input type="hidden" name="price_min" id="price_min" value="700"/>
                                        <input type="hidden" name="price_max" id="price_max" value="3300"/>

                                        <div id="slider-range"></div>
                                        <input type="text" id="amount" readonly>
                                    </div> 

                                </div>

                                <!-- fourth row -->
                                <h3>optional:</h3> 
                                <div class="extended-search fourth-row">   
                                
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
                                        <img src="../img/icons/lift.png" class="checkbox-icon">
                                        <span class="checkbox-description">Fahrstuhl</span>
                                        <input type="checkbox" name="lift"  value="true">
                                    </div>
                                </div>

                                <!-- fifth row -->
                                <div class="extended-search fifth-row">
                                    <input type="submit" value="Suchen!"> 
                                </div>
                            </form>
                        </div>

                        <!-- FULL-TEXT-SEARCH-AREA -->
                        <div id="tabs-2">
                            <form action="#results" method="POST">
                                <div class="full-text-search-area">

                                    <!-- search-bar -->
                                    <input type="text" name="$full_text_search" class="full-text-search-bar" placeholder="Finde deine Traumimmobilie hier ..">

                                    <!-- submit -->
                                    <input type="submit" value="Suchen!">  
                                </div>    
                            </form>
                        </div>
                    </div>                   

                </div>

                <!-- RESULTS-AREA -->
                <div class="results-area" id="results">

                <h2>Suchergebnisse (Jetzt: alle Immobilien)</h2>

                    <?php
                        
                        // sets SQL Statement for results
                        require_once('includes/functions/pdo.php');
                        $sql_select = 'SELECT offer_id, offer_name, price, qm, rooms, city FROM offer o LEFT OUTER JOIN address a ON a.address_id = o.address_id';
                        
                        // includes results-area
                        include ('includes/results.php');
                    ?>

                </div>

                <!-- PROMOTED-AREA -->
                <div class="promoted-area">
                
                    <h2>Promoted</h2>    

                    <p style="margin: 0px;">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor 
                    invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam
                     et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est
                     Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed 
                     diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. 
                     At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea 
                     takimata sanctus est Lorem ipsum dolor sit amet.</p>

                </div>

            </div>
        </main>

        <!-- FOOTER-AREA -->
        <footer>
            <?php
                include ('includes/footer.php');
            ?>
        </footer>
    
    </body>

</html> 