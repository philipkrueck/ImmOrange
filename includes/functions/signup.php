<?php

    if(isset($_GET['signup'])) {

        //variable-declaration
        $error = false;
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_2 = $_POST['password_2'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];


        if(isset($_POST['is_realtor'])){
            $is_realtor = $_POST['is_realtor'];
            $company_name = $_POST['company_name'];
            $tel_number = $_POST['tel_number'];
            $realtor_id = get_random_id();
        }else{
            $is_realtor = false;
        }

        //assigning random IDs to variables
        $account_id = get_random_id();


        //error-message for incorrect email-format
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo '<div class="error-message">'.'Bitte eine gültige E-Mail-Adresse eingeben.'.'</div>';
            $error = true;
        }

        //error-message for empty fields
        if((strlen($password) == 0) ||
            (strlen($first_name) == 0) ||
            (strlen($last_name) == 0)) {
                echo '<div class="error-message">'.'Bitte alle Felder ausfüllen.'.'</div>';
                $error = true;
        }

        if($is_realtor){
            if((strlen($company_name) == 0) ||
                (strlen($tel_number) == 0)){
                    echo '<div class="error-message">'.'Bitte alle Felder ausfüllen.'.'</div>';
                    $error = true;  
            }
        }

        //error-message for empty email
        if(strlen($password) == 0) {
            echo '<div class="error-message">'.'Bitte ein Passwort angeben.'.'</div>';
            $error = true;
        }

        //error-message for wrong password
        if($password != $password_2) {
            echo '<div class="error-message">'.'Die Passwörter müssen übereinstimmen.'.'</div>';
            $error = true;
        }

        //error-message for existing email
        if(!$error) { 
            $email_check_statement = pdo()->prepare("SELECT * FROM account WHERE acc_email = :acc_email");
            $result = $email_check_statement->execute(array('acc_email' => $email));
            $account = $email_check_statement->fetch();
            
            if($account !== false) {
                echo '<div class="error-message">'.'Diese Email ist bereits vergeben.'.'</div>';
                $error = true;
            }    
        }


        //registration
        if(!$error) {

            //converting password to hash   
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            //inserting realtor_infos
            if($is_realtor){
                $signup_statement_realtor = pdo()->prepare("INSERT INTO realtor (realtor_id, company_name, tel_number) VALUES ( :realtor_id, :company_name, :tel_number)");
                $result_realtor = $signup_statement_realtor->execute(array('realtor_id' => $realtor_id, 'company_name' => $company_name, 'tel_number' => $tel_number));
                $signup_statement_account = pdo()->prepare("INSERT INTO account (acc_id, acc_email, acc_password, first_name, last_name, realtor_id ) VALUES (:acc_id, :acc_email, :acc_password, :first_name, :last_name, :realtor_id )");
                $result_account = $signup_statement_account->execute(array('acc_id' => $account_id, 'acc_email' => $email, 'acc_password' => $password_hash, 'first_name' => $first_name, 'last_name' => $last_name, 'realtor_id' => $realtor_id ));
            }else{                                    
                $signup_statement_account = pdo()->prepare("INSERT INTO account (acc_id, acc_email, acc_password, first_name, last_name ) VALUES (:acc_id, :acc_email, :acc_password, :first_name, :last_name )");
                $result_account = $signup_statement_account->execute(array('acc_id' => $account_id, 'acc_email' => $email, 'acc_password' => $password_hash, 'first_name' => $first_name, 'last_name' => $last_name ));
            }

    
            if($result_account) {        
                echo '<div class="success-message">'.'Erfolgreich registriert. <b><a href="/pages/login.php">Hier anmelden</a><b>.'.'</div>';
            } else {
                echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
            }
        }         
    }
?>