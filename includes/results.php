<?php

    function showResults($sql_select, $do_favorite) {

        include ('functions/paging.php');

        // set session variable for current results page
        $_SESSION['current_results_url'] = $_SERVER['REQUEST_URI'];

        // creates container for each entry in DB
        foreach (pdo()->query($sql_select_with_paging) as $offer) {

            $offer_id = $offer["offer_id"];

            echo '<div class="result-container">
            
            <!-- offer-image -->
            <div class="result-image-container">
                <a href="/pages/offer.php?offer_id='.$offer_id.'"><img src="/includes/functions/image_source.php?offer_id='.$offer_id.'"></a>
            </div>

            <!-- offer-title -->
            <h3 class="result-title"><a href="/pages/offer.php?offer_id='.$offer_id.'">'.$offer['offer_name'].'</a></h3>

            <!-- favorite-icon -->
            '; 
            $image_source = "../img/icons/heart_white.png";
            if($do_favorite){
                $favorites = (isset($_COOKIE['favorites']) && !empty($_COOKIE['favorites'])) ? json_decode($_COOKIE['favorites'], true) : array();
                if (in_array($offer_id, $favorites)) {
                    $image_source = "../img/icons/heart_orange.png";
                }
                // destination url specifies which page to load, but removes get parameter 'favorite_id', if it is currently set
                $destination_url = preg_replace("/[\?|\&]favorite_id.*/", "", $_SERVER['REQUEST_URI']);
                $combination_character = (empty($_GET) or (count($_GET) == 1 and isset($_GET['favorite_id']))) ? "?" : "&";
                echo '<a href="'.$destination_url.$combination_character.'favorite_id='.$offer_id.'" class="heart-icon" id="heart-icon"><img src="'.$image_source.'" onclick="toggleFavorite()"></a>';
            }

            echo '
            <!-- offer-price -->
            <span class="result-price">'.$offer["price"].' €</span>

            <!-- offer-qm -->
            <span class="result-space">'.$offer["qm"].' qm</span>

            <!-- offer-rooms -->
            <div class="result-rooms-container">
                <img src="../img/icons/rooms.png" class="rooms-img"><span class="result-rooms">'.$offer["number_of_rooms"].' Zimmer</span>
            </div>

            <!-- offer-location -->
            <div class="result-location-container">
                <img src="../img/icons/location.png" class="location-img"><span class="result-location">in '.$offer["city"].'</span>
            </div>

            <!-- offer-options -->
            <div class="result-options-container">
                ';           
                    if ($offer["has_basement"]) {
                        echo '<img src="../img/icons/basement.png" title="besitzt einen Keller">';
                    }
                    if ($offer["has_garden"]) {
                        echo '<img src="../img/icons/botanical.png" title="besitzt einen Garten">';
                    }
                    if ($offer["has_balcony"]) {
                        echo '<img src="../img/icons/balcony.png" title="besitzt einen Balkon">';
                    }
                    if ($offer["has_bathtub"]) {
                        echo '<img src="../img/icons/bathtub.png" title="besitzt eine Badewanne">';
                    }
                    if ($offer["has_elevator"]) {
                        echo '<img src="../img/icons/lift.png" title="besitzt einen Fahrstuhl">';
                    }
                    
                echo '  
            </div>

        </div>';

        }
        
        echo '
            <div class="paging-container" ';  if($page_count == 0){echo 'style="display: none;" ';} echo '>
                <div class="back">
                    <span ';  if($is_first_page){echo 'style="display: none;" ';} echo '><a href="/.'.$paging_url.$paging_combination_character.'page='.$page_back.'">
                    <span class="arrow">&larr;</span> zurück
                    </a></span>
                    
                </div>

                <div class="current">
                    <span>Seite '.$page_current.' von '.$page_count.'</span>
                </div>

                <div class="next">
                    <span ';  if($is_last_page){echo 'style="display: none;" ';} echo '><a href="/.'.$paging_url.$paging_combination_character.'page='.$page_next.'">
                        nächste <span class="arrow">&rarr;</span>
                    </a></span>
                </div>
            </div>
        ';
    }

    function showFavoriteResults($favorite_ids) {

        echo '<div class="results-area" id="results"><h2>Deine Merkliste</h2>'; 
        echo '<div class="result-breadcrum">
            <span class="result-counter">Anzahl Suchergebnisse: <b>'; echo count($favorite_ids); echo '</b></span>
            <select>
                <option disabled selected>Ergebnisse sortieren</option>
                <option>online seit &uarr;</option>
                <option>online seit &darr;</option>
                <option>Preis &uarr;</option>
                <option>Preis &darr;</option>
            </select> 
        </div>';

        foreach ($favorite_ids as $favorite_id) {

            $select_offer = pdo()->prepare("SELECT * FROM property_offer WHERE offer_id = :offer_id");
            $select_offer->bindParam(':offer_id', $favorite_id);
            $select_offer->execute();
            $offer = $select_offer->fetch();

            if (!empty($offer)) {
                echo '<div class="result-container">
            
                <!-- offer-image -->
                <div class="result-image-container">
                    <a href="/pages/offer.php?offer_id='.$favorite_id.'"><img src="/includes/functions/image_source.php?offer_id='.$favorite_id.'"></a>
                </div>

                <!-- offer-title -->
                <h3 class="result-title"><a href="/pages/offer.php?offer_id='.$favorite_id.'">'.$offer['offer_name'].'</a></h3>

                <!-- favorite-icon -->
                '; 
                    $image_source = "../img/icons/heart_orange.png";
                    // destination url specifies which page to load, but removes get parameter 'favorite_id', if it is currently set
                    $destination_url = preg_replace("/[\?|\&]favorite_id.*/", "", $_SERVER['REQUEST_URI']);
                    $combination_character = (empty($_GET) or (count($_GET) == 1 and isset($_GET['favorite_id']))) ? "?" : "&";
                    echo '<a href="'.$destination_url.$combination_character.'favorite_id='.$favorite_id.'" class="heart-icon" id="heart-icon"><img src="'.$image_source.'" onclick="toggleFavorite()"></a>';

                echo '
                <!-- offer-price -->
                <span class="result-price">'.$offer["price"].' €</span>

                <!-- offer-qm -->
                <span class="result-space">'.$offer["qm"].' qm</span>

                <!-- offer-rooms -->
                <div class="result-rooms-container">
                    <img src="../img/icons/rooms.png" class="rooms-img"><span class="result-rooms">'.$offer["number_of_rooms"].' Zimmer</span>
                </div>

                <!-- offer-location -->
                <div class="result-location-container">
                    <img src="../img/icons/location.png" class="location-img"><span class="result-location">in '.$offer["city"].'</span>
                </div>

                <!-- offer-options -->
                <div class="result-options-container">
                    ';           
                        if ($offer["has_basement"]) {
                            echo '<img src="../img/icons/basement.png" title="besitzt einen Keller">';
                        }
                        if ($offer["has_garden"]) {
                            echo '<img src="../img/icons/botanical.png" title="besitzt einen Garten">';
                        }
                        if ($offer["has_balcony"]) {
                            echo '<img src="../img/icons/balcony.png" title="besitzt einen Balkon">';
                        }
                        if ($offer["has_bathtub"]) {
                            echo '<img src="../img/icons/bathtub.png" title="besitzt eine Badewanne">';
                        }
                        if ($offer["has_elevator"]) {
                            echo '<img src="../img/icons/lift.png" title="besitzt einen Fahrstuhl">';
                        }
                        
                    echo '  
                </div>

            </div>';
            } else {
                removeIdFromCookies($favorite_id, $favorite_ids);
                // refresh page
                header("Refresh:0");
            }
        }
    }


    function showResultsForFullTextSearch() {
        echo '<div class="results-area" id="results"><h2>Suchergebnisse für "'.$_SESSION['fulltext_search_string'].'"</h2>'; 
        
        $search_string = $_SESSION['fulltext_search_string'];
                                                            
        $sql_select = "SELECT * FROM property_offer WHERE MATCH (offer_name, street, zip, city, country) AGAINST ('$search_string' IN NATURAL LANGUAGE MODE) ";
    
        // show results-area
        showResultsHeader($sql_select);
        showResults($sql_select, true);

        echo'</div>';       
            
    }

    function showResultsForExtendedSearch() {
        echo '<div class="results-area" id="results"><h2>Suchergebnisse</h2>';   

        // set parameters for sql query
        $price_min = $_SESSION['price_min'];
        $price_max = $_SESSION['price_max'];
        $city = $_SESSION['city'];
        $qm = $_SESSION['qm'];
        $number_of_rooms = $_SESSION['number_of_rooms'];
        $has_basement = $_SESSION['has_basement'];
        $has_garden = $_SESSION['has_garden'];
        $has_bathtub = $_SESSION['has_bathtub'];
        $has_balcony = $_SESSION['has_bathtub'];
        $has_lift = $_SESSION['has_lift'];

        if (isset($_SESSION['is_apartment'])) {
            if ($_SESSION['is_apartment'] == "Wohnung") {
                $is_apartment = true;
            } else {
                $is_apartment = false; 
            }
        }
        
        $where_clause = array();
        $where_clause[] = "price >= ".$price_min;
        if ($price_max != "4000") {
            $where_clause[] = "price <= ".$price_max;
        }
        if (isset($_SESSION['is_for_rent'])) {
            if ($_SESSION['is_for_rent'] == "mieten") {
                $where_clause[] = "is_apartment = true";
            } else {
                $where_clause[] = "is_apartment = false";
            }
        }
        if (isset($_SESSION['is_apartment'])) {
            if ($_SESSION['is_apartment'] == "Wohnung") {
                $where_clause[] = "is_for_rent = true";
            } else {
                $where_clause[] = "is_for_rent = false";
            }
        }
        if (!empty($city)) {
            $where_clause[] = "city = '".$city."'";
        }
        if (!empty($qm)) {
            $where_clause[] = "qm >= '".$qm."'";
        }
        if (!empty($number_of_rooms)) {
            if ($number_of_rooms == "> 4") {
                $where_clause[] = "number_of_rooms > 4";
            } else {
                $where_clause[] = "number_of_rooms = '".$number_of_rooms."'";
            }
        }
        if (!empty($has_basement)) {
            $where_clause[] = "has_basement = true";
        }
        if (!empty($has_garden)) {
            $where_clause[] = "has_garden = true";
        }
        if (!empty($has_balcony)) {
            $where_clause[] = "has_balcony = true";
        }
        if (!empty($has_bathtub)) {
            $where_clause[] = "has_bathtub = true";
        }
        if (!empty($has_lift)) {
            $where_clause[] = "has_lift = true";
        }

        $sql_select = 'SELECT * FROM property_offer WHERE '.join(' AND ', $where_clause);

    
        // show results-area
        showResultsHeader($sql_select);

        showResults($sql_select, true);

        echo'</div>';
    }

    function showResultsHeader($sql_select) {
        echo '<div class="result-breadcrum">';
            $counter = getResultsCount($sql_select);
            echo '<span class="result-counter">Anzahl Suchergebnisse: <b>'; echo $counter; echo '</b></span>
            <select>
                <option disabled selected>Ergebnisse sortieren</option>
                <option>online seit &uarr;</option>
                <option>online seit &darr;</option>
                <option>Preis &uarr;</option>
                <option>Preis &darr;</option>
            </select> 
        </div>';
    }

    function getResultsCount($query) {
        $counter = 0;
        foreach (pdo()->query($query) as $offer) {
            $counter++;
        }
        return $counter;
    }

?>
