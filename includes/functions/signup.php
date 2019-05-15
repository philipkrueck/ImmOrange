<?php

    if(isset($_GET['signup'])) {

        //variable-declaration
        $error = false;
        $email = $_POST['email'];
        $password = $_POST['password'];
        $password_2 = $_POST['password_2'];
        $first_name = $_POST['first_name'];
        $last_name = $_POST['last_name'];
        $street = $_POST['street'];
        $house_number = $_POST['house_number'];
        $zip = $_POST['zip'];
        $city = $_POST['city'];
        $country = $_POST['country'];

        if(isset($_POST['is_realtor'])){
            $is_realtor = $_POST['is_realtor'];
        }else{
            $is_realtor = false;
        }

        $company_name = $_POST['company_name'];
        $tel_number = $_POST['tel_number'];

        //assigning random IDs to variables
        $account_id = get_random_id();
        $address_id = get_random_id();
        $person_id = get_random_id();
        $realtor_id = get_random_id();

        //error-message for incorrect email-format
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo '<div class="error-message">'.'Bitte eine gültige E-Mail-Adresse eingeben.'.'</div>';
            $error = true;
        }

        //error-message for empty fields
        if((strlen($password) == 0) ||
            (strlen($first_name) == 0) ||
            (strlen($last_name) == 0) ||
            (strlen($street) == 0) ||
            (strlen($house_number) == 0) ||
            (strlen($zip) == 0) ||
            (strlen($city) == 0) ||
            (strlen($country) == 0)) {
            echo '<div class="error-message">'.'Bitte alle Felder ausfüllen.'.'</div>';
            $error = true;
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
            $email_check_statement = pdo()->prepare("SELECT * FROM account WHERE email = :email");
            $result = $email_check_statement->execute(array('email' => $email));
            $account = $email_check_statement->fetch();
            
            if($account !== false) {
                echo '<div class="error-message">'.'Diese Email ist bereits vergeben..'.'</div>';
                $error = true;
            }    
        }


        //registration
        if(!$error) {

            //converting password to hash   
            $password_hash = password_hash($password, PASSWORD_DEFAULT);

            //inserting address-infos
            $signup_statement_address = pdo()->prepare("INSERT INTO address (address_id, street, house_number, zip, city, country) VALUES ( :address_id, :street, :house_number, :zip, :city, :country)");
            $result_address = $signup_statement_address->execute(array('address_id' => $address_id, 'street' => $street, 'house_number' => $house_number, 'zip' => $zip, 'city' => $city, 'country' => $country));

            //inserting person-infos
            $signup_statement_person = pdo()->prepare("INSERT INTO person (person_id, last_name, first_name, address_id) VALUES ( :person_id, :last_name, :first_name, :address_id)");
            $result_person = $signup_statement_person->execute(array('person_id' => $person_id, 'last_name' => $last_name, 'first_name' => $first_name, 'address_id' => $address_id));

            //inserting realtor_infos
            if($is_realtor){
                $signup_statement_realtor = pdo()->prepare("INSERT INTO realtor (realtor_id, company_name, tel_number) VALUES ( :realtor_id, :company_name, :tel_number)");
                $result_realtor = $signup_statement_realtor->execute(array('realtor_id' => $realtor_id, 'company_name' => $company_name, 'tel_number' => $tel_number));
                $signup_statement_account = pdo()->prepare("INSERT INTO account (account_id, email, password, person_id, realtor_id) VALUES (:account_id, :email, :password, :person_id, :realtor_id)");
                $result_account = $signup_statement_account->execute(array('account_id' => $account_id, 'email' => $email, 'password' => $password_hash, 'person_id' => $person_id, 'realtor_id' => $realtor_id));
            }else{                                    
                $signup_statement_account = pdo()->prepare("INSERT INTO account (account_id, email, password, person_id) VALUES (:account_id, :email, :password, :person_id)");
                $result_account = $signup_statement_account->execute(array('account_id' => $account_id, 'email' => $email, 'password' => $password_hash, 'person_id' => $person_id));
            }

    
            if($result_account && $result_person && $result_address) {        
                echo '<div class="success-message">'.'Erfolgreich registriert. <b><a href="/pages/login.php">Hier anmelden</a><b>.'.'</div>';
            } else {
                echo 'Beim Abspeichern ist leider ein Fehler aufgetreten<br>';
            }
        }         
    }
?>