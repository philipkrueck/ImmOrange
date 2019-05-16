<?php

    foreach (pdo()->query($sql_select) as $offer) {

        echo '<div class="search-result-container">
        
        <div class="result-image-container">
            <a href="/pages/offer.php?id='.$offer["offer_id"].'"><img src="../temporary_assets/imm_1.jpg"></a>
        </div>

        <h3 class="result-title"><a href="/pages/offer.php?id='.$offer["offer_id"].'">'.$offer["offer_name"].'</a></h3>


        <img src="../img/icons/heart_white.png" class="heart-icon" onclick="toggleFavorite()">


        <span class="result-price">'.$offer["price"].' €</span>


        <span class="result-space">'.$offer["qm"].' qm</span>


        <div class="result-rooms-container">
            <img src="../img/icons/rooms.png" class="rooms-img"><span class="result-rooms">'.$offer["rooms"].' Zimmer</span>
        </div>


        <div class="result-location-container">
            <img src="../img/icons/location.png" class="location-img"><span class="result-location">in '.$offer["city"].'</span>
        </div>

    </div>';

    }

?>

<?php
    include ('includes/functions/toggle_favorite.php');
?>