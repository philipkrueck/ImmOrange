<div class="result-breadcrum">

    <?php
        $counter = 0;
        foreach (pdo()->query($sql_select) as $offer) {
            $counter++;
        }
    ?>

    <span class="result-counter">Anzahl Suchergebnisse: <b><?php echo $counter; ?></b></span>
    <select>
        <option>neuste zuerst</option>
        <option>Preis aufsteigend</option>
        <option>Preis absteigend</option>
    </select>
</div>

<?php

    // creates container for each entry in DB
    foreach (pdo()->query($sql_select) as $offer) {

        echo '<div class="result-container">
        
        <!-- offer-image -->
        <div class="result-image-container">
            <a href="/pages/offer.php?id='.$offer["offer_id"].'"><img src="../temporary_assets/imm_1.jpg"></a>
        </div>

        <!-- offer-title -->
        <h3 class="result-title"><a href="/pages/offer.php?id='.$offer["offer_id"].'">'.$offer["offer_name"].'</a></h3>

        <!-- favorite-icon -->
        <img src="../img/icons/heart_white.png" class="heart-icon" id="heart-icon" onclick="toggleFavorite()">

        <!-- offer-price -->
        <span class="result-price">'.$offer["price"].' €</span>

        <!-- offer-qm -->
        <span class="result-space">'.$offer["qm"].' qm</span>

        <!-- offer-rooms -->
        <div class="result-rooms-container">
            <img src="../img/icons/rooms.png" class="rooms-img"><span class="result-rooms">'.$offer["rooms"].' Zimmer</span>
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

?>


<!-- includes function to favorite offer -->
<?php
    include ('includes/functions/toggle_favorite.php');
?>