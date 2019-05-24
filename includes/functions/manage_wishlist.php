<?php

    function toggleFavorite($favorite_id) {
        $favorites = (isset($_COOKIE['favorites']) && !empty($_COOKIE['favorites'])) ? json_decode($_COOKIE['favorites'], true) : array();
        if ($favorite_id) {
            if (!in_array($favorite_id, $favorites)) {
                $favorites[] = $favorite_id;
                setcookie('favorites', json_encode($favorites), time() + (86400 * 30), "/"); // 86400 = 1 day
                $_COOKIE['favorites'] = json_encode($favorites);
            }
            else {
                $idx = array_search($favorite_id, $favorites);
                unset($favorites[$idx]);
                $favorites = array_values($favorites);
                setcookie('favorites', json_encode($favorites), time() + (86400 * 30), "/"); // 86400 = 1 day
                $_COOKIE['favorites'] = json_encode($favorites);
            }
        }
    }

?>