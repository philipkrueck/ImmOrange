<?php
    include_once('pdo.php');
    
    // select image
    $image_data_stmt = pdo()->prepare("SELECT image_mime, image_data FROM property_offer WHERE offer_id = :offer_id;");
    // bind offer_id parameter specified through GET value
    $image_data_stmt->bindParam(':offer_id', $_GET['offer_id']);
    $image_data_stmt->execute();

    $num = $image_data_stmt->rowCount();

    if ($num) {
        $row = $image_data_stmt->fetch(PDO::FETCH_ASSOC);

        // specify header with content type
        header("Content-type: ".$row['image_mime']);
        print $row['image_data']; 
        exit; 
    } 

?>