<?php
    require_once('pdo.php');

    // start session if not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // check if user not logged in 
    if (!isset($_SESSION['acc_id'])) {
        die('Bitte zuerst <a href="/pages/login.php">einloggen</a>');
    }

    // get account id set in session
    $acc_id = $_SESSION['acc_id'];

    // select realtor_id from account 
    $get_realtor_id_statement = pdo()->prepare("SELECT realtor_id FROM account WHERE acc_id = :acc_id");
    $result = $get_realtor_id_statement->execute(array('acc_id' => $acc_id));
    $realtor_id_array = $get_realtor_id_statement->fetch();

    if ($realtor_id_array['realtor_id'] != null) {
        // realtor is now logged in
        $_SESSION['realtor_id'] = $realtor_id_array['realtor_id'];
    } else {
        die('Sie sind kein Makler <a href="login.php">einloggen</a>');
    }
?>