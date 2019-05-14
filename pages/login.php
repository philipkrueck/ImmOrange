<!-- PHP-AREA -->
<?php

    //if errors appear, show all of them
    error_reporting(E_ALL);
    ini_set('display_errors', '1'); 

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

                        <form action="/" method="POST" class="login-form">         
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