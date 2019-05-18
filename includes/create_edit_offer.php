<!-- Includes -->
<?php
            include ('../includes/functions/image_upload.php');
            include ('../includes/features/jquery.php');
            include ('../includes/features/autocomplete.php');
            include ('../includes/features/combobox.php');
?>

<!-- CONTENT-AREA -->
<div class="content">

<!-- CREATE-OFFER-AREA -->
<h2>Immobilie inserieren / bearbeiten</h2>

<form action="create_offer.php" method="post" enctype="multipart/form-data" class="create-edit-offering-form">

    <!-- FIRST CONTAINER -->
    <div class="create-edit-offering-general-container">

        <!-- title -->
        <div class="name-input">
            <input type="text" name="offer_name" placeholder="Titel" value="">
        </div>

        <!-- offer-type -->
        <div class="is_apartment-input">
            <select id="offer-type-input" name="is_apartment" >
                <option disabled selected>Haus oder Wohnung</option>
                <option>Haus</option>
                <option>Wohnung</option>
            </select>
        </div>

        <!-- purchasing-type -->
        <div class="purchasing_type-input">
            <select id="purchase-type-input" name="purchasing_type" >
                <option disabled selected>mieten oder kaufen</option>
                <option>mieten</option>
                <option>kaufen</option>
            </select>
        </div>

        <!-- rooms -->
        <div class="rooms-input">
            <input type="number" name="rooms" placeholder="Raumanzahl" value="">
        </div>

        <!-- living-space -->
        <div class="living-space-input">
            <input type="number" name="qm" placeholder="Wohnfläche (qm)" value="">
        </div>

        <!-- price -->
        <div class="price-input">
            <input type="number" name="price" placeholder="Preis (€)" value="">
        </div>

        <!-- image upload -->
        <div class="image-upload-input">
            <input type="file" name="picture" id="offer-img" placeholder="Bild hochladen">
            <script type="text/javascript">
                $("#offer-img").change(function(){
                    readURL(this);
                });
            </script>
        </div>

        <!-- image-preview -->
        <div class="image-preview">
            <img src="" id="offer-img-tag"/>
        </div>
    </div>

    <!-- SECOND CONTAINER -->
    <div class="create-edit-offering-additional-container">

        <!-- RIGHT-CONTAINER -->
        <div class="create-edit-offering-optional-container">                       

            <!-- basement -->
            <div class="checkbox-container">
                <img src="../img/icons/basement.png" class="checkbox-icon">
                <span class="checkbox-description">Keller</span>
                <input type="checkbox" name="has_basement" value="">
            </div>

            <!-- garden -->
            <div class="checkbox-container">
                <img src="../img/icons/botanical.png" class="checkbox-icon">
                <span class="checkbox-description">Garten</span>
                <input type="checkbox" name="has_garden" value="1" >
            </div>

            <!-- balcony -->
            <div class="checkbox-container">
                <img src="../img/icons/balcony.png" class="checkbox-icon">
                <span class="checkbox-description">Balkon</span>
                <input type="checkbox" name="has_balcony"  value="1">
            </div>

            <!-- lift -->
            <div class="checkbox-container">
                <img src="/img/icons/lift.png" class="checkbox-icon">
                <span class="checkbox-description">Fahrstuhl</span>
                <input type="checkbox" name="has_elevator"  value="1">
            </div>

            <!-- bathtub -->
            <div class="checkbox-container bathtub">
                <img src="../img/icons/bathtub.png" class="checkbox-icon">
                <span class="checkbox-description">Badewanne</span>
                <input type="checkbox" name="has_bathtub" value="1">
            </div>

        </div>
       
       <!-- LEFT CONTAINER -->
        <div class="create-edit-offering-address-container">

            <!-- street -->
            <div class="street-input">
                <input type="text" name="street" placeholder="Straße" value="">
            </div>

            <!-- house_number -->
            <div class="house_number-input">
                <input type="text" name="house_number" placeholder="Hausnummer" value="">
            </div>

            <!-- zip -->
            <div class="zip-input">
                <input type="text" name="zip" placeholder="PLZ" value="">
            </div>

            <!-- city -->
            <div class="city-input">
                <input type="text" name="city" placeholder="Stadt" value="">
            </div>

            <!-- country -->
            <div class="country-input">
                <input type="text" name="country" placeholder="Land" value="">
            </div>

            <!-- check if error-message should be dispayed -->
            <?php 
                if(isset($errorMessage)) {
                    echo '<div class="error-message">'.$errorMessage.'</div>';
                }
            ?>

            <input type="submit" class="submit-btn" name="create_offer_submit" value="abschicken">

        </div>                     
    </div>
</form>
</div>