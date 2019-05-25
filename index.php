<!-- PHP-AREA -->
<?php
    require_once('includes/functions/pdo.php');
    include('includes/functions/manage_wishlist.php');

    // start session if not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // check if favorite was selected and if so, toggle in cookie
    $favorite_id = (isset($_GET['favorite_id']) && !empty($_GET['favorite_id'])) ? $_GET['favorite_id'] : null;
    if ($favorite_id) {
        toggleFavorite($favorite_id);
    }

    if (isset($_POST['submit_fulltext_search'])) {
        if (!checkFulltextStringNotEmpty()) {
            $_SESSION["fulltext_error_message"] = "Bitte geben Sie etwas in die Suche ein.";
        } else {
            $_SESSION['is_fulltext_search'] = true;
            $_SESSION["fulltext_error_message"] = null;
            $_SESSION['fulltext_search_string'] = $_POST['fulltext_search_string'];
        }
        header("Location: index.php");
        exit; 

    } else if (isset($_POST['submit_extended_search'])) {
        setSessionVariablesFromPost();
        $_SESSION['is_fulltext_search'] = false;
        $_SESSION["fulltext_error_message"] = null;
        header("Location: index.php");
        exit;
    }

    function setSessionVariablesFromPost() {
        $_SESSION['price_min'] = $_POST['price_min']; 
        $_SESSION['price_max'] = $_POST['price_max']; 
        $_SESSION['city'] = $_POST['city'] != '' ? $_POST['city'] : null; 
        $_SESSION['qm'] = $_POST['qm'] != '' ? $_POST['qm'] : null; 
        $_SESSION['is_apartment'] = isset($_POST['is_apartment']) ? $_POST['is_apartment'] : null;
        $_SESSION['is_for_rent'] = isset($_POST['is_for_rent']) ? $_POST['is_for_rent'] : null;
        $_SESSION['number_of_rooms'] = isset($_POST['number_of_rooms']) ? $_POST['number_of_rooms'] : null;
        $_SESSION['has_basement'] = isset($_POST['has_basement']) ? $_POST['has_basement'] : null; 
        $_SESSION['has_garden'] = isset($_POST['has_garden']) ? $_POST['has_garden'] : null; 
        $_SESSION['has_balcony'] = isset($_POST['has_balcony']) ? $_POST['has_balcony'] : null;
        $_SESSION['has_bathtub'] = isset($_POST['has_bathtub']) ? $_POST['has_bathtub'] : null;
        $_SESSION['has_lift'] = isset($_POST['has_lift']) ? $_POST['has_lift'] : null;
    }

    function checkFulltextStringNotEmpty() {
        return ($_POST['fulltext_search_string'] != '');
    }
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
            include ('includes/results.php');
        ?>

        <!-- Link-Relations -->
        <link rel="stylesheet" href="css/styles.css">
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" /> 
        <link rel="stylesheet" type="text/css" href="/css/features/product_slider_styles.css" />
		<script src="/js/features/product_slider_js/modernizr.custom.63321.js"></script>       
        

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
                            <li><a href="#tabs-1">Suche</a></li>
                            <li><a href="#tabs-2">Erweiterte Suche</a></li>
                        </ul>

                        <!-- FULL-TEXT-SEARCH-AREA -->
                        <div id="tabs-1">

                            <form action="#results" method="POST">
                                <div class="full-text-search-area">

                                    <!-- search-bar -->
                                    <input type="text" name="fulltext_search_string" class="full-text-search-bar" placeholder="Finde deine Traumimmobilie hier ..">

                                    <!-- submit -->
                                    <input type="submit" value="Suchen!" name="submit_fulltext_search">  
                                </div>    
                            </form>

                        </div>

                        <!-- EXTENDED-SEARCH-AREA -->
                        <div id="tabs-2">

                        <form action="#results" method="POST" class="extended-search">

                            <!-- first row -->
                            <div class="extended-search first-row">

                                <!-- location -->
                                <div class="location-input">
                                    <input type="text" id="tags" name="city" placeholder="Ort" >
                                </div>

                                <!-- purchase-type -->
                                <div class="purchase-type-input">
                                    <select id="purchase-type-input" name="is_for_rent">
                                        <option disabled selected>mieten oder kaufen</option>
                                        <option>mieten</option>
                                        <option>kaufen</option>
                                    </select>
                                </div>

                                <!-- offer-type -->
                                <div class="offer-type-input">
                                    <select id="offer-type-input" name="is_apartment">
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
                                    <select id="rooms-input" name="number_of_rooms">
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
                                    <input type="number" name="qm" placeholder="Mindestwohnfläche (qm)">
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
                                    <input type="checkbox" name="has_basement" value="true">
                                </div>

                                <!-- garden -->
                                <div class="checkbox-container">
                                    <img src="../img/icons/botanical.png" class="checkbox-icon">
                                    <span class="checkbox-description">Garten</span>
                                    <input type="checkbox" name="has_garden"  value="true">
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
                                <input type="submit" value="Suchen!" name="submit_extended_search"> 
                            </div>
                            </form>
                            
                        </div>
                    </div>                   
                </div>

                <!-- RESULTS-AREA -->

                 <!-- check if error-message should be dispayed -->
                 <?php 
                    if(isset($_SESSION["fulltext_error_message"])) {
                        echo '<div class="error-message">'.$_SESSION["fulltext_error_message"].'</div>';
                    }

                    if (isset($_SESSION['is_fulltext_search']) and !isset($_SESSION["fulltext_error_message"])) {
                        if ($_SESSION['is_fulltext_search']) {
                            showResultsForFullTextSearch();
                        } else {
                            showResultsForExtendedSearch();
                        }
                    }
                ?>

                <!-- PROMOTED-AREA -->
                <div class="promoted-area">
                    <h2>Promoted</h2>    

                    <?php
                        include('includes/features/product_slider.php');
                    ?>

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