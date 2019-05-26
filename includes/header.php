<!--LOGO-->
  <a href="/">
    <img src="../img/logo.png" class="logo">
  </a>


<!-- USER-AREA-->
<?php
    echo '
      <!--DROPDOWN-->
      <div class="dropdown">
          <img class="iconUSER" src="../img/icons/'; if (isset($_SESSION['acc_id'])) { echo 'Benutzer.png';} else { echo 'Benutzer_2.png'; } echo'" >
          <div class="dropdown-content">';    
          
            if (isset($_SESSION['acc_id'])) {
              
              // Select realtor_id from account where account_id = :account_id
              $get_realtor_id_statement = pdo()->prepare("SELECT realtor_id, acc_id FROM account WHERE acc_id = :acc_id");
              $result = $get_realtor_id_statement->execute(array('acc_id' => $_SESSION['acc_id']));
              $realtor_id_array = $get_realtor_id_statement->fetch();

              if ($realtor_id_array['realtor_id'] != null) {

                // realtor is now logged in
                $_SESSION['realtor_id'] = $realtor_id_array['realtor_id'];
              }
            }

              // show "MyOffers" & "MyProfil" only if logged in as realtor
              if (isset($_SESSION['realtor_id'])) {

                  echo '
                    <div class="in-dropDIV">
                      <a href="/pages/myoffers.php"><p class="drop-in">Meine Immobilien</p></a>
                    </div>
                    
                    <div class="in-dropDIV">
                      <a href="/pages/account.php?acc_id='.$realtor_id_array['acc_id'].'"><p class="drop-in">Mein Profil</p></a>
                    </div>';

              }

              // show "Favorites" and "Logout" if user is not realtor
              if (isset($_SESSION['acc_id'])) {
                echo '
                <div class="in-dropDIV">
                  <a href="/pages/favorites.php"><p class="drop-in">Merkliste</p></a>
                </div>

                <div class="in-dropDIV">
                  <a href="/includes/functions/logout.php"><p class="drop-in">Logout</p></a>
                </div>';
              }

              // show "Favorites" and "Login" if user not logged in 
              if (!isset($_SESSION['acc_id'])) {
                echo '
                <div class="in-dropDIV">
                  <a href="/pages/favorites.php"><p class="drop-in">Merkliste</p></a>
                </div>

                <div class="in-dropDIV">
                  <a href="/pages/login.php"><p class="drop-in">Login / Signup</p></a>
                </div>';
              }
            echo'
        </div>
      </div>';
?>


<!--SEARCH-AREA-->
<form action="/#results" method="POST">
  <input type="text" name="fulltext_search_string" value="" class="navsearch" placeholder="Suche..">
  <input type="submit" style="position: absolute; left: -9999px; width: 1px; height: 1px;" tabindex="-1" name="submit_fulltext_search">
</form>

