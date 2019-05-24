<?php
	$sql_select_newest = "SELECT * FROM property_offer ORDER BY creation_date DESC LIMIT 3;";

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
		return "SELECT * FROM property_offer WHERE city = '$city' ORDER BY creation_date DESC LIMIT 3;";
	}

?>

<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<link rel="stylesheet" type="text/css" href="/css/features/product_slider_styles.css" />
		<script src="/js/features/product_slider_js/modernizr.custom.63321.js"></script>
	</head>
	<body>

		<?php 
			function showSliderOfferList($offers) {
				foreach ($offers as $offer) {
					echo '
					<li>
						<a href="/pages/offer.php?offer_id='.$offer['offer_id'].'"><img src="/includes/functions/image_source.php?offer_id='.$offer['offer_id'].'" alt="img01">
							<h4>'.$offer['offer_name'].'</h4>
							<h6>Preis: '.$offer['price'].'</h6>
							<h6>QM: '.$offer['qm'].'</h6>
							<h6>Zimmeranzahl: '.$offer['number_of_rooms'].'</h6>
						</a>
					</li>
					';
				}
			}
		?>

		<div class="container">	
			<div class="main">
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
			</div>
		</div><!-- /container -->

		<!-- below jquery script allows slider to present arrow for current tab -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
		<script src="/js/features/product_slider_js/jquery.catslider.js"></script>
		<script>
			$(function() {

				$( '#mi-slider' ).catslider();

			});
		</script>
	</body>
</html>