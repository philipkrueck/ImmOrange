<?php
    function toggleCookie($offer_id) {
        if (isset($_COOKIE['favorites'])) {
            if ($_COOKIE['favorites'] == $offer_id) {
                setcookie("favorites", 0, time() + 360000);
                return;
            }
        } 
        setcookie("favorites", $offer_id, time() + 360000);
    }
?>