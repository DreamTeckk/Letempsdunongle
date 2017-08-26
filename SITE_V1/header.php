<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="header.css">
		<link rel="stylesheet" type="text/css" href="script/slick/slick.css"/>	
		<link rel="stylesheet" type="text/css" href="script/slick/slick-theme.css"/>
		<link rel="icon" href="image/logotextV4.png">
	</head>
	<body>
		<header>
			<?php
			if(isset($_SESSION['id']) AND isset($_SESSION['pseudo']) AND isset($_SESSION['rang'])){
				?>
				<a class="logOut" href="deconnexion.php">Se déconnecter</a>
				<?php
			}
			?>
			<a class = "logo" href="index.php"><img src="icons/logotextV5.png" alt="logo" height="250px" width="auto"/></a>
			<nav class = "menu_mobil">
				<input type="checkbox" id="menu" value="checkbox1"><label for="menu"></label>
				<ol>
					<li><a href="index.php">ACCUEIL</a></li>
					<li><a href="prestation.php">PRESTATION</a></li>
					<li><a href="photos.php">PHOTOS</a></li>
					<li><a href="contact.php">CONTACT</a></li>
				</ol>
			</nav>
			<nav class = "barreLien">
				<ol>
					<li><a href="index.php">ACCUEIL</a></li>
					<li><a href="prestation.php">PRESTATION</a></li>
					<li><a href="photos.php">PHOTOS</a></li>
					<li><a href="contact.php">CONTACT</a></li>
				</ol>
			</nav>
		</header>
	</body>
</html>