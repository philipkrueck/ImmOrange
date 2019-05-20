<?php
    if(isset($_GET['login'])) {

        //variable-declaration
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        //executing SQL
        $login_statement = pdo()->prepare("SELECT acc_id, acc_password FROM account WHERE acc_email = :acc_email");
        $result = $login_statement->execute(array('acc_email' => $email));
        $account = $login_statement->fetch();

        //checks if password and email aren't empty
        if($password && $email){
            
            //checks if the password is the same as hash-password in DB
            if (password_verify($password, $account['acc_password'])) {
                $_SESSION['acc_id'] = $account['acc_id'];
                header("Location: /?logged_in=true");
                return;
            } 
            else {
                $errorMessage = "E-Mail oder Passwort ungültig!";
            }
        }else{
            $errorMessage = "Bitte gib sowohl eine Email,<br> als auch ein Passwort ein.";
        }
    }
?>