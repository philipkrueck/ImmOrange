<!-- PHP-AREA -->
<?php
    include ('../includes/functions/random_id.php');
    require_once('../includes/functions/pdo.php');
    //include ('../includes/functions/login.php');

    //starting session to save login-cookie
    session_start();
    $_SESSION['login_error_message'] = null;
    $_SESSION['signup_error_message'] = null; 

    if (isset($_POST['submit'])) {
        if (isset($_GET['login'])) {
            login();
        } else if (isset($_GET['signup'])) {
            signup();
        }
    }

    function login() {
        if (!checkLoginPostParameters()) {
            $_SESSION['login_error_message'] = "Bitte gib sowohl eine Email, <br> als auch ein Passwort ein.";
            return; 
        }
        setLoginSessionVariables();
        if (verifyPassword($_SESSION['email'], $_SESSION['password'])) {
            header("Location: /?logged_in=true");
            return;
        } else {
            $_SESSION['login_error_message'] = "E-Mail oder Passwort ungültig!";
        }
    }

    function signup() {
        if (!checkSignupPostParameters()) {
            $_SESSION['signup_error_message'] = "Bitte fülle alle Felder aus.";
            return; 
        }
        setSignupSessionVariables();
        // check email format
        if (!emailFormatIsCorrect($_SESSION['email'])) {
            $_SESSION['signup_error_message'] = "Bitte eine gültige eMail angeben.";
            return; 
        }

        // check passwords are matching
        if (!passwordsAreMatching($_SESSION['password'], $_SESSION['password_2'])) {
            $_SESSION['signup_error_message'] = "Die eingegebenen Passwörter stimmen nicht überein.";
            return;
        }

        // check if email already exists
        if (emailAlreadyExists($_SESSION['email'])) {
            $_SESSION['signup_error_message'] = "Die eMail existiert bereits.";
            return; 
        }

        if (!couldRegisterUserFromSessionVariables()) {
            $_SESSION['signup_error_message'] = "Beim Abspeichern ist leider ein Fehler aufgetreten";
            return;
        }
        header("Location: /?signed_up=true");
        return;
    }

    function checkLoginPostParameters() {
        if (($_POST['email'] != '') and ($_POST['password'] != '')) {
            return true;
        } 
        return false;
    }

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
    
    function setLoginSessionVariables() {
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['password'] = $_POST['password'];
    }

    function setSignupSessionVariables() {
        $_SESSION['email'] = $_POST['email'];
        $_SESSION['password'] = $_POST['password'];
        $_SESSION['password_2'] = $_POST['password_2'];
        $_SESSION['first_name'] = $_POST['first_name'];
        $_SESSION['last_name'] = $_POST['last_name'];
        if (checkIsRealtor()) {
            $_SESSION['company_name'] = $_POST['company_name'];
            $_SESSION['tel_nubmber'] = $_POST['tel_nubmber'];
        }
    }

    function emailFormatIsCorrect($email) {
        if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return true;
        }
        return false;
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

    function checkIsRealtor() {
        return isset($_POST['is_realtor']);
    }

    function passwordsAreMatching($password_one, $password_two) {
        return ($password_one == $password_two);
    }

    function emailAlreadyExists($email) {
        $email_check_statement = pdo()->prepare("SELECT * FROM account WHERE acc_email = :acc_email");
        $email_check_statement->bindParam('acc_email', $email);
        $email_check_statement->execute();
        $account = $email_check_statement->fetch();
        if($account !== false) {
            return true;
        } 
        return false;
    }

    function couldRegisterUserFromSessionVariables() {
        //converting password to hash   
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // get random account id
        $account_id = get_random_id();

        //inserting realtor_infos
        if(checkIsRealtor()){
            $realtor_id = get_random_id();
            $signup_statement_realtor = pdo()->prepare("INSERT INTO realtor (realtor_id, company_name, tel_number) VALUES ( :realtor_id, :company_name, :tel_number)");
            $result_realtor = $signup_statement_realtor->execute(array('realtor_id' => $realtor_id, 'company_name' => $_SESSION['company_name'], 'tel_number' => $_SESSION['tel_number']));
            $signup_statement_account = pdo()->prepare("INSERT INTO account (acc_id, acc_email, acc_password, first_name, last_name, realtor_id ) VALUES (:acc_id, :acc_email, :acc_password, :first_name, :last_name, :realtor_id )");
            $result_account = $signup_statement_account->execute(array('acc_id' => $account_id, 'acc_email' => $_SESSION['email'], 'acc_password' => $password_hash, 'first_name' => $_SESSION['first_name'], 'last_name' => $_SESSION['last_name'], 'realtor_id' => $realtor_id ));
        }else{                                    
            $signup_statement_account = pdo()->prepare("INSERT INTO account (acc_id, acc_email, acc_password, first_name, last_name ) VALUES (:acc_id, :acc_email, :acc_password, :first_name, :last_name )");
            $result_account = $signup_statement_account->execute(array('acc_id' => $account_id, 'acc_email' => $_SESSION['email'], 'acc_password' => $password_hash, 'first_name' => $_SESSION['first_name'], 'last_name' => $_SESSION['last_name'] ));
        }

        if($result_account) {  
            $_SESSION['acc_id'] = $account_id;
            return true;
        } else {
            return false;
        }
    }
?>

<!DOCTYPE html>
<html>

    <!-- HEAD-AREA -->
    <head>
    
        <!-- Homepage-Title -->
        <title>Page Title</title>

        <!-- Includes -->
        <?php 
            include ('../includes/features/jquery.php');
            include ('../includes/features/search_tabs.php');
        ?>

        <!-- Scripts --> 
        <script>
            function showRealtorInputs(){
                // Get the checkbox
                var is_realtor = document.getElementById("is_realtor");
                // Get the output text
                var company_name = document.getElementById("company_name");
                // Get the output text
                var tel_number = document.getElementById("tel_number");

                // If the checkbox is checked, display the output text
                if (is_realtor.checked == true){
                    company_name.style.display = "block";
                    tel_number.style.display = "block";
                } else {
                    company_name.style.display = "none";
                    tel_number.style.display = "none";
                }
            }
        </script>

        <!-- Link-Relations -->
        <link rel="stylesheet" href="../css/styles.css">
        <link rel="stylesheet" href="../css/pages/login.css">
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" />        
        

    </head>

    <!-- BODY-AREA -->
    <body>

        <!-- MAIN-AREA -->
        <main>

            <div class="login-area">
        
                <!-- LOGIN-SIGNUP-TABS -->
                <div id="search-tabs">
                    <ul>
                        <li><a href="#tabs-1">Login</a></li>
                        <li><a href="#tabs-2">Signup</a></li>
                    </ul>

                    <!-- LOGIN-AREA -->
                    <div id="tabs-1">

                        <form action="?login=1" method="POST" class="login-form">    
                            <input type="email" maxlength="50" placeholder="E-Mail" name="email">
                            <input type="password" maxlength="50" placeholder="Passwort" name="password">

                            <!-- check if error-message should be dispayed -->
                            <?php 
                                if(isset($_SESSION['login_error_message'])) {
                                    echo '<div class="error-message">'.$_SESSION['login_error_message'].'</div>';
                                }
                            ?>
                           
                            <input type="submit" name="submit" value="Login!"> 
                        </form>

                    </div>

                    <!-- SIGNUP-AREA -->                  
                    <div id="tabs-2">

                        <form action="?signup=1#tabs-2" method="POST" class="signup-form">

                            <?php
                                if(isset($_SESSION['signup_error_message'])) {
                                    echo '<div class="error-message">'.$_SESSION['signup_error_message'].'</div>';
                                }
                                
                                if (isset($_GET['registration'])) {
                                    echo '<div class="success-message">'.'Erfolgreich registriert. <b><a href="/pages/login.php">Hier anmelden</a><b>.'.'</div>';
                                }
                            ?>

                            <!-- inputs for user-information -->
                            <input type="email" maxlength="50" placeholder="E-Mail" name="email">
                            <input type="password" maxlength="50" placeholder="Passwort*" name="password">
                            <input type="password" maxlength="50" placeholder="Passwort bestätigen" name="password_2">

                             <!-- inputs for person-information -->
                            <div class="names">
                                <input type="text" maxlength="50" placeholder="Vorname*" name="first_name">
                                <input type="text" maxlength="50" placeholder="Nachname*" name="last_name">
                            </div>

                             <!-- inputs for realtor-information -->
                            <div class="is-realtor-container">                                
                                <input type="checkbox" id="is_realtor" name="is_realtor" onclick="showRealtorInputs()" value="true"></input>
                                <span class="is-realtor-description">Sind Sie Makler?</span>
                            </div>
                            <input type="text" maxlength="50" id="company_name" placeholder="Name der Firma*" name="company_name" style="display:none;">
                            <input type="text" maxlength="25" id="tel_number" placeholder="Telefonnummer*" name="tel_number" style="display:none;">

                            <!-- submit -->
                            <input type="submit" name="submit" value="Registrieren!">     
                        </form>
                    </div>
                </div> 

            </div>                  

        </main>
    
    </body>

</html> 