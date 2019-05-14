<!-- PHP-AREA -->
<?php

    //if errors appear, show all of them
    error_reporting(E_ALL);
    ini_set('display_errors', '1'); 

    session_start();
    require_once('../includes/pdo.php');
 
    if(isset($_GET['login'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $login_statement = pdo()->prepare("SELECT * FROM account WHERE email = :email");
        $result = $login_statement->execute(array('email' => $email));
        $account = $login_statement->fetch();
            
        //Überprüfung des Passworts
        if ($password == $account['password']) { // TODO: insert password_verify($password, $account['password']) in if statement
            $_SESSION['account_id'] = $account['account_id'];
            die('Login erfolgreich. Weiter zu <a href="geheim.php">internen Bereich</a>');
        } else {
            $errorMessage = "E-Mail oder Passwort war ungültig<br>";
        }
        
    }

?>

<!DOCTYPE html>
<html>

    <!-- HEAD-AREA -->
    <head>
    
        <!-- Homepage-Title -->
        <title>Page Title</title>

        <!-- Feature-Includes -->
        <?php 
            include ('../includes/jquery.php');
            include ('../includes/features/search_tabs.php');
        ?>

        <!-- Link-Relations -->
        <link rel="stylesheet" href="../css/styles.css">
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

                        <?php 
                            if(isset($errorMessage)) {
                                echo $errorMessage;
                            }
                        ?>

                        <form action="?login=1" method="POST" class="login-form">    
                        <input type="email" size="40" maxlength="250" name="email"><br><br> 
                        Dein Passwort:<br>
                        <input type="password" size="40"  maxlength="250" name="password"><br>     
                            <input type="submit" value="Login!"> 
                        </form>
                    </div>

                    <!-- SIGNUP-AREA -->
                    <div id="tabs-2">
                        <form action="/" method="POST" class="signup-form">
                            <!-- submit -->
                            <input type="submit" value="Registrieren!">     
                        </form>
                    </div>
                </div> 

            </div>                  

        </main>
    
    </body>

</html> 