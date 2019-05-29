<?php

    ### PHP Preparation

        //starting session to save login-cookie
        session_start();

        require_once('../includes/functions/pdo.php');
        include('../includes/functions/random_id.php');
        include('../includes/functions/login_helpers.php');
        include('../includes/functions/signup_helpers.php');
        
        $_SESSION['login_error_message'] = null;
        $_SESSION['signup_error_message'] = null; 

    
    ### Functions

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

            if (!couldRegisterUserFromSessionVariables($_SESSION['password'])) {
                $_SESSION['signup_error_message'] = "Beim Abspeichern ist leider ein Fehler aufgetreten";
                return;
            }
            header("Location: /?signed_up=true#0");
            return;
        }

    
    ### Business Logic

        if (isset($_POST['submit'])) {
            if (isset($_GET['login'])) {
                login();
            } else if (isset($_GET['signup'])) {
                signup();
            }
        }
?>

<!DOCTYPE html>
<html>

    <!-- HEAD-AREA -->
    <head>
    
        <!-- Homepage-Title -->
        <title>Login  ∙  ImmOrange GmbH</title>

        <!-- Styles -->
        <link rel="stylesheet" href="../css/pages/login.css">
        <link rel="stylesheet" href="../css/styles.css">
        <link rel="stylesheet" href="../css/features/tabs.css">
        <link rel="stylesheet" type="text/css" href="/css/fonts/OpenSans.css">   

        <!-- Features -->
        <?php
            include('../includes/features/jquery.php');
            include('../includes/features/search_tabs.php');
        ?>  

        <!-- Scripts --> 
        <script>
            // if user wants to be realtor, show additional fields
            function showRealtorInputs() {
                // Get the checkbox
                var is_realtor = document.getElementById("is_realtor");
                // Get the output text
                var company_name = document.getElementById("company_name");
                // Get the output text
                var tel_number = document.getElementById("tel_number");

                // If the checkbox is checked, display the output text
                if (is_realtor.checked == true) {
                    company_name.style.display = "block";
                    tel_number.style.display = "block";
                } else {
                    company_name.style.display = "none";
                    tel_number.style.display = "none";
                }
            }
            // transform email input to LowerCase at signup
            function forceLower(strInput) {
                strInput.value=strInput.value.toLowerCase();
            }
        </script> 
        
    </head>

    <!-- BODY-AREA -->
    <body class="login-page">

        <!-- LOGO -->
        <a href="/">
            <img src="../img/logo.png" class="login-logo">
        </a>

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
                                if (isset($_SESSION['login_error_message'])) {
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
                                if (isset($_SESSION['signup_error_message'])) {
                                    echo '<div class="error-message">'.$_SESSION['signup_error_message'].'</div>';
                                }
                                
                                if (isset($_GET['registration'])) {
                                    echo '<div class="success-message">'.'Erfolgreich registriert. <b><a href="/pages/login.php">Hier anmelden</a><b>.'.'</div>';
                                }
                            ?>

                            <!-- inputs for user-information -->
                            <input type="email" maxlength="50" placeholder="E-Mail" name="email" onkeyup="return forceLower(this);">
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