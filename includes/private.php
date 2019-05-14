<?php
session_start();
if(!isset($_SESSION['account_id'])) {
    die('Bitte zuerst <a href="login.php">einloggen</a>');
}

//Abfrage der Nutzer ID vom Login
$account_id = $_SESSION['acount_id'];

// Select realtor_id from account where account_id = :account_id
$get_realtor_id_statement = pdo()->prepare("SELECT realtor_id FROM account WHERE account_id = :account_id");
$result = $get_realtor_id_statement->execute(array('account_id' => $account_id));
$realtor_id_array = $get_realtor_id_statement->fetch();

// todo: if realtor_id_array == account --> account is realtor
 
echo "Hallo User: ".$account_id;
?>