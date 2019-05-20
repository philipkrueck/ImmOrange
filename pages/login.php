<!-- PHP-AREA -->
<?php

    //if errors appear, show all of them
    error_reporting(E_ALL);
    ini_set('display_errors', '1'); 

    //starting session to save login-cookie
    session_start();
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
            include ('../includes/functions/random_id.php');
            require_once('../includes/functions/pdo.php');
            include ('../includes/functions/login.php');
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
                                if(isset($errorMessage)) {
                                    echo '<div class="error-message">'.$errorMessage.'</div>';
                                }
                            ?>
                           
                            <input type="submit" value="Login!"> 
                        </form>

                    </div>

                    <!-- SIGNUP-AREA -->                  
                    <div id="tabs-2">

                        <form action="?signup=1#tabs-2" method="POST" class="signup-form">

                            <!-- includes the signup-function -->
                            <?php
                                include('../includes/functions/signup.php');
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
                            <input type="submit" value="Registrieren!">     
                        </form>
                    </div>
                </div> 

            </div>                  

        </main>
    
    </body>

</html> 