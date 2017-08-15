<!--
	Fichier : photo.php;
	Projet:	Site Suzanne Michaud;
	Auteur: Nathan ARAGO;
	Date Creation: 	12/05/2017;
-->
<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Le Temps d'un Ongle - Photos</title>
		<link rel="stylesheet" href="photos.css">
		<link rel="stylesheet" type="text/css" href="script/slick/slick.css"/>	
		<link rel="stylesheet" type="text/css" href="script/slick/slick-theme.css"/>
		<!-- Add jQuery library -->
		<script type="text/javascript" src="http://code.jquery.com/jquery-latest.min.js"></script>
		<script type="text/javascript" src="/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>
		<link rel="stylesheet" href="/fancybox/source/jquery.fancybox.css?v=2.1.7" type="text/css" media="screen" />
		<script type="text/javascript" src="/fancybox/source/jquery.fancybox.pack.js?v=2.1.7"></script>
	</head>
	<body>
		<script type="text/javascript">
			$(document).ready(function() {
			$(".fancybox").fancybox();
			});
		</script>
		<div id ="maPage">
			<?php include("header.php"); ?>
			<div id ="corps">
				<header>
					<h1>Photos<h1>
				</header>
				<div class = "conteneur_photo">
					<a target="_blank" class="fancybox" rel="group" href="images/FullSizeRender(1).jpg"><img src="images/FullSizeRender(1).jpg" alt="" /></a>
				</div>
				<div class = "conteneur_photo">
					<a target="_blank" class="fancybox" rel="group" href="images/FullSizeRender_2.jpg"><img src="images/FullSizeRender_2.jpg" alt="" /></a>
				</div>
				<div class = "conteneur_photo">
					<a target="_blank" class="fancybox" rel="group" href="images/IMG_90148_2.JPG"><img src="images/IMG_90148_2.JPG" alt=""/></a>
				</div>
				<?php include("footer.php"); ?>
			</div>
		</div>
	</body>
</html>
	