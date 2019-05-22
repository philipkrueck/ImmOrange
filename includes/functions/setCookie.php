<?php
    session_start();
    if (!isset($_GET['offer_id'])) {
        // redirect to caller page 
        echo "redirect"; // header
        exit;
    }

    if (isset($_COOKIE['favorites'])) {
        setcookie("favorites", $_GET['offer_id'], time() - 3600);
    } else {
        setcookie("favorites", $_GET['offer_id'], time() + 3600 * 24 * 30);
    }
    header("Location: ".$_SESSION['current_results_url']);
    return;
?>