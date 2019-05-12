<!-- PHP-AREA -->
<?php

?>

<!DOCTYPE html>
<html>

    <!-- HEAD-AREA -->
    <head>
    
        <!-- Homepage-Title -->
        <title>Page Title</title>

        <!-- Link-Relations -->
        <link rel="stylesheet" href="../css/styles.css">

    </head>

    <!-- BODY-AREA -->
    <body>

        <!-- HEADER-AREA -->
        <header>
            <?php 
                include ('../includes/header.php');
            ?>
        </header>

        <!-- MAIN-AREA -->
        <main>

            <!-- BANNER-AREA -->
            <div class="banner">

                <!-- PLACEHOLDER -->
                <h2 style="
                    text-align: center;
                    padding-top: 100px;
                    margin: 0px;"
                >MERKLISTE</h2>

            </div>

            <!-- CONTENT-AREA -->
            <div class="content">
            

                <!-- RESULTS-AREA -->
                <div class="results-area">

                    <?php 
                        include ('../includes/results.php');
                    ?>

                </div>

            </div>
        </main>

        <!-- FOOTER-AREA -->
        <footer>
            <?php
                include ('../includes/footer.php');
            ?>
        </footer>
    
    </body>

</html> 