<?php 

    function checkLoginPostParameters() {
        if (($_POST['email'] != '') and ($_POST['password'] != '')) {
            return true;
        } 
        return false;
    }

    function setLoginSessionVariables() {
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['password'] = $_POST['password'];
    }

    function verifyPassword($email, $password) {
        $login_statement = pdo()->prepare("SELECT acc_id, acc_password FROM account WHERE acc_email = :acc_email");
        $result = $login_statement->execute(array('acc_email' => $email));
        $account = $login_statement->fetch();
        if (password_verify($password, $account['acc_password'])) {
            $_SESSION['acc_id'] = $account['acc_id'];
            return true;
        } 
        return false;
    }

    function passwordsAreMatching($password_one, $password_two) {
        return ($password_one == $password_two);
    }

?>