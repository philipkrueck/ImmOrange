<?php
    if(isset($_GET['login'])) {

        //variable-declaration
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        //executing SQL
        $login_statement = pdo()->prepare("SELECT * FROM account WHERE email = :email");
        $result = $login_statement->execute(array('email' => $email));
        $account = $login_statement->fetch();

        //checks if password and email aren't empty
        if($password && $email){
            
            //checks if the password is the same as hash-password in DB
            if ($account !== false && password_verify($password, $account['password'])) {
                $_SESSION['account_id'] = $account['account_id'];
                header("Location: /?logged_in=true");
                die();
            } 
            else {
                $errorMessage = "E-Mail oder Passwort ungültig!";
            }
        }else{
            $errorMessage = "E-Mail oder Passwort ungültig!";
        }
    }
?>