<!-- PHP-AREA -->
<?php

    include_once('../includes/functions/pdo.php');
    include ('../includes/results.php');

    // start session if not already started
    if (session_status() == PHP_SESSION_NONE) {
        session_start();
    }

    // get account-id from URL
    if(isset($_GET['acc_id'])){
        $curr_acc_id = $_GET['acc_id'];
    }else{
        die('Kein Makler ausgewählt. <a href="/index.php">Zurück zur Homepage</a>');
    }

    // get realtor-object
    function getRealtor($acc_id){
        $realtor_statement = pdo()->prepare("SELECT acc_id, acc_email, acc_password, a.realtor_id, first_name, last_name, creation_date, tel_number, company_name FROM account a LEFT JOIN realtor r ON a.realtor_id = r.realtor_id WHERE a.acc_id = :acc_id;");
        $realtor_statement->bindParam(':acc_id', $acc_id);
        $realtor_statement->execute();
        return $realtor_statement->fetch();
    }

    $realtor = getRealtor($curr_acc_id);

    // checks if realtor exists
    if(empty($realtor)){
        die('Dieses Makler-Profil existiert nicht. <a href="/index.php">Zurück zur Homepage</a>');
    }

    $realtor_id = $realtor["realtor_id"];  

    // checks if Account is Realtor
    if(empty($realtor_id)){
        die('Diese Person ist kein Makler. <a href="/index.php">Zurück zur Homepage</a>');
    }
    
    // converting Creation-Date
    $creation_date_without_time = substr($realtor["creation_date"],0,10);
    $creation_date_splitted = explode('-', $creation_date_without_time);
    $date = $creation_date_splitted[2];
    $month = $creation_date_splitted[1];
    $year = $creation_date_splitted[0];
    $creation_date = $date.'.'.$month.'.'.$year;

    // set sql-statement for results
    $sql_select = "SELECT * FROM property_offer WHERE realtor_id = '$realtor_id'";

    // user cannot make offer favorite
    $do_favorite = false;

    // count offers
    $counter = 0;
    foreach (pdo()->query($sql_select) as $offer) {
        $counter++;
    }

?>

<!DOCTYPE html>
<html>

    <!-- HEAD-AREA -->
    <head>
    
        <!-- Homepage-Title -->
        <title><?php echo  $realtor["company_name"] ?>  ∙  ImmOrange GmbH</title>

        <!-- Link-Relations -->
        <link rel="stylesheet" href="../css/styles.css">
        <link rel="stylesheet" href="../css/pages/account.css">
        <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Open+Sans" /> 

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

            <!-- CONTENT-AREA -->
            <div class="content">          

                <!-- REALTOR-INFO-AREA -->
                <h2><?php echo  $realtor["company_name"] ?></h2>

                <div class="realtor-infos">
                    <div class="left-column">

                        <!-- User-Icon -->
                        <img src="../img/icons/benutzer.png">

                        <!-- Realtor-Name -->
                        <span class="name"><?php echo $realtor["first_name"].' '.$realtor["last_name"] ?></span>

                    </div>

                    <div class="right-column">

                        <!-- Realtor-Email -->
                        <img src="../img/icons/email.png">
                        <span><b><?php echo $realtor["acc_email"] ?></b></span>  
                        
                        <!-- Realtor-Phone -->
                        <img src="../img/icons/phone.png">
                        <span><b><?php echo $realtor["tel_number"] ?></b></span>

                        <!-- Realtor-Offer-Count -->
                        <img src="../img/icons/house.png">
                        <span>Anzahl Immobilien: <b><?php echo $counter ?></b></span>

                        <!-- Realtor-User-Since -->
                        <img src="../img/icons/add-user.png">
                        <span>Mitglied seit: <b><?php echo $creation_date ?></b></span>
                    
                        
                    </div>                    

                </div>


                <!-- RESULTS-AREA -->
                <h2>Alle Immobilien dieses Anbieters:</h2>

                <?php
                    //check if realtor has offers
                    if($counter > 0){
                        showResults($sql_select, $do_favorite);                        
                    }else{
                        echo '
                            <div class="no-offers">
                                <span>Dieser Makler bietet momentan keine Immobilien an.</span>      
                            </div>';
                    }
                ?>

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