<?php
	$sql_select_newest = "SELECT offer_id, offer_name, price, qm, number_of_rooms FROM property_offer ORDER BY creation_date DESC LIMIT 3;";

	$newest_offers = getPropertyOffers($sql_select_newest);

	$hamburg_offers = getPropertyOffers(getSqlSelectString("Hamburg"));
	$berlin_offers = getPropertyOffers(getSqlSelectString("Berlin"));
	$munich_offers = getPropertyOffers(getSqlSelectString("München"));

	function getPropertyOffers($sql_select) {
		$offers = array();
		foreach (pdo()->query($sql_select) as $offer) {
			array_push($offers, $offer);
		}
		return $offers;
	}

	function getSqlSelectString($city) {
		return "SELECT offer_id, offer_name, price, qm, number_of_rooms FROM property_offer WHERE city = '$city' ORDER BY creation_date DESC LIMIT 3;";
	}


	function showSliderOfferList($offers) {

		if (empty($offers)) {
			echo '<li class="error">Es sind noch keine Angebote verfügbar.</li>';
		} else {
			foreach ($offers as $offer) {
				echo '
				<li>
					<a href="/pages/offer.php?offer_id='.$offer['offer_id'].'">
						<div class="promoted-img-container">
							<img src="/includes/functions/image_source.php?offer_id='.$offer['offer_id'].'" alt="img01">
						</div>
						<h4>'.$offer['offer_name'].'</h4>
						<div class="info-container">
							<span class="info">'.$offer['price'].' €</span>
							<span class="info">'.$offer['qm'].' qm</span>
							<span class="info">'.$offer['number_of_rooms'].' Zimmer</span>
						</div>
					</a>
				</li>
				';
			}
		}
	}
?>


	<div id="mi-slider" class="mi-slider">
	<ul>
		<?php
			showSliderOfferList($newest_offers);
		?>
	</ul>
	<ul>
		<?php
			showSliderOfferList($hamburg_offers);
		?>
	</ul>
	<ul>
		<?php
			showSliderOfferList($berlin_offers);
		?>
	</ul>
	<ul>
		<?php
			showSliderOfferList($munich_offers);
		?>
	</ul>
	<nav>
		<a href="#">Neueste</a>
		<a href="#">Hamburg</a>
		<a href="#">Berlin</a>
		<a href="#">München</a>
	</nav>
	</div>

<!-- below jquery script allows slider to present arrow for current tab -->
<script src="/includes/features/slider_js/jquery.catslider.js"></script>
<script>
$(function() {

	$( '#mi-slider' ).catslider();

});
</script>