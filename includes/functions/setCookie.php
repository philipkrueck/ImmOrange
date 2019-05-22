<?php
    function toggleCookie($offer_id) {
        $_COOKIE['favorites'] = "";
        if (isset($_COOKIE['favorites'])) {
            if ($_COOKIE['favorites'] != "") {
                $favorites_array = json_decode($_COOKIE['favorites']);
                if (in_array($offer_id, $favorites_array)) {
                    // remove offer_id from array 
                    $favorites_array = array_diff($favorites_array, array($offer_id));
                } else {
                    array_push($favorites_array, $offer_id);
                }
                setcookie("favorites", json_encode($favorites_array), time() + 360000);
                return; 
            }
        } 
        $favorites_array = array($offer_id);
        setcookie("favorites", json_encode($favorites_array), time() + 360000);
    }
?>