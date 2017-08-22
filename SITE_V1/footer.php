<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="footer.css">
		<link rel="stylesheet" type="text/css" href="script/slick/slick.css"/>	
		<link rel="stylesheet" type="text/css" href="script/slick/slick-theme.css"/>
	</head>
	<body>
		<footer>
			<a class="FacebookLink" href="https://www.facebook.com/Le-temps-dun-ongle-644561435750224/?ref=br_rs" target="_blank" title="Ma page Facebook"><img src="icons/facebook_icon.png" alt="bouttonFacebook"/></a>
			<a class="InstagrammeLink" href="https://www.instagram.com/letempsdunongle/" target="_blank" title="Mon Instagram"><img src="icons/instagramme_icon.png" alt="bouttonInstagramme"/></a>
			<!--
			<div>Icons made by <a href="https://www.flaticon.com/authors/simpleicon" title="SimpleIcon">SimpleIcon</a> from <a href="https://www.flaticon.com/" title="Flaticon">www.flaticon.com</a> is licensed by <a href="http://creativecommons.org/licenses/by/3.0/" title="Creative Commons BY 3.0" target="_blank">CC 3.0 BY</a></div>
			-->		
			<br />
			<?php
				if(!(isset($_SESSION['id']) AND isset($_SESSION['pseudo']) AND isset($_SESSION['rang']))){
					?>
					<a class="OptionGear" href="zone_administrateur.php"><img src="icons/gear-black-shape.png" alt="ZoneAdministrateur" title="Zone Administrateur" /></a>
					<?php 
				}
			?>
		</footer>
	</body>
</html
