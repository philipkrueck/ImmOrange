<?php
    function checkSignupPostParameters() {
        if (($_POST['email'] != '') and
        ($_POST['password'] != '') and
        ($_POST['first_name'] != '') and
        ($_POST['last_name'] != '')) {
            
            if (checkIsRealtor()) {
                if (!checkRealtorSignupPostParameters()) {
                    return false;
                }
            }
            return true;
        }
        return false;
    }

    function checkRealtorSignupPostParameters() {
        if (($_POST['company_name'] != '') and ($_POST['tel_number'] != '')) {
            return true;
        }
        return false;
    }

    function setSignupSessionVariables() {
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['password'] = $_POST['password'];
        $_SESSION['password_2'] = $_POST['password_2'];
        $_SESSION['first_name'] = $_POST['first_name'];
        $_SESSION['last_name'] = $_POST['last_name'];
        if (checkIsRealtor()) {
            $_SESSION['company_name'] = $_POST['company_name'];
            $_SESSION['tel_number'] = $_POST['tel_number'];
        }
    }

    function emailFormatIsCorrect($email) {
        if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
    }

    function checkIsRealtor() {
        return isset($_POST['is_realtor']);
    }

    function emailAlreadyExists($email) {
        $email_check_statement = pdo()->prepare("SELECT * FROM account WHERE acc_email = :acc_email");
        $email_check_statement->bindParam('acc_email', $email);
        $email_check_statement->execute();
        $account = $email_check_statement->fetch();
        if ($account !== false) {
            return true;
        } 
        return false;
    }

    function couldRegisterUserFromSessionVariables($password) {
        //converting password to hash   
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // get random account id
        $account_id = get_random_id();

        //inserting realtor_infos
        if (checkIsRealtor()) {
            $realtor_id = get_random_id();
            $signup_statement_realtor = pdo()->prepare("INSERT INTO realtor (realtor_id, company_name, tel_number) VALUES ( :realtor_id, :company_name, :tel_number)");
            $result_realtor = $signup_statement_realtor->execute(array('realtor_id' => $realtor_id, 'company_name' => $_SESSION['company_name'], 'tel_number' => $_SESSION['tel_number']));
            $signup_statement_account = pdo()->prepare("INSERT INTO account (acc_id, acc_email, acc_password, first_name, last_name, realtor_id ) VALUES (:acc_id, :acc_email, :acc_password, :first_name, :last_name, :realtor_id )");
            $result_account = $signup_statement_account->execute(array('acc_id' => $account_id, 'acc_email' => $_SESSION['email'], 'acc_password' => $password_hash, 'first_name' => $_SESSION['first_name'], 'last_name' => $_SESSION['last_name'], 'realtor_id' => $realtor_id ));
        } else {                                    
            $signup_statement_account = pdo()->prepare("INSERT INTO account (acc_id, acc_email, acc_password, first_name, last_name ) VALUES (:acc_id, :acc_email, :acc_password, :first_name, :last_name )");
            $result_account = $signup_statement_account->execute(array('acc_id' => $account_id, 'acc_email' => $_SESSION['email'], 'acc_password' => $password_hash, 'first_name' => $_SESSION['first_name'], 'last_name' => $_SESSION['last_name'] ));
        }

        if ($result_account) {  
            $_SESSION['acc_id'] = $account_id;
            return true;
        } else {
            return false;
        }
    }
?>