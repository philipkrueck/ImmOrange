<!DOCTYPE html>
<html lang="en" class="no-js">
	<head>
		<link rel="stylesheet" type="text/css" href="/css/features/product_slider_styles.css" />
		<script src="/js/features/product_slider_js/modernizr.custom.63321.js"></script>
	</head>
	<body>
		<div class="container">	
			<div class="main">
				<div id="mi-slider" class="mi-slider">
				<ul>
					<li><a href="#"><img src="/temporary_assets/imm_1.jpg" alt="img01"><h4>Neueste 1</h4></a></li>
					<li><a href="#"><img src="/temporary_assets/imm_2.jpg" alt="img02"><h4>Neueste 2</h4></a></li>
					<li><a href="#"><img src="/temporary_assets/imm_3.jpg" alt="img03"><h4>Neueste 3</h4></a></li>
				</ul>
				<ul>
					<li><a href="#"><img src="/temporary_assets/imm_6.jpg" alt="img06"><h4>Hamgurg 2</h4></a></li>
					<li><a href="#"><img src="/temporary_assets/imm_4.jpg" alt="img07"><h4>Hamburg 3</h4></a></li>
					<li><a href="#"><img src="/temporary_assets/imm_3.jpg" alt="img08"><h4>Hamburg 4</h4></a></li>
				</ul>
				<ul>
					<li><a href="#"><img src="/temporary_assets/imm_1.jpg" alt="img09"><h4>Berlin 1</h4></a></li>
					<li><a href="#"><img src="/temporary_assets/imm_2.jpg" alt="img10"><h4>Berlin 2</h4></a></li>
					<li><a href="#"><img src="/temporary_assets/imm_3.jpg" alt="img11"><h4>Berlin 3</h4></a></li>
				</ul>
				<ul>
					<li><a href="#"><img src="/temporary_assets/imm_6.jpg" alt="img12"><h4>München 1</h4></a></li>
					<li><a href="#"><img src="/temporary_assets/imm_4.jpg" alt="img13"><h4>München 2</h4></a></li>
					<li><a href="#"><img src="/temporary_assets/imm_5.jpg" alt="img14"><h4>München 3</h4></a></li>
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