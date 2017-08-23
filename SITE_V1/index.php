<!--
	Fichier : index.php;
	Projet:	Site Suzanne Michaud;
	Auteur: Nathan ARAGO;
	Date Creation: 	11/05/2017;
-->
<?php
	session_start();
?>
<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Le Temps d'un Ongle - Bienvenue</title>
		<link rel="stylesheet" href="index.css">
		<link rel="stylesheet" type="text/css" href="script/slick/slick.css"/>	
		<link rel="stylesheet" type="text/css" href="script/slick/slick-theme.css"/>
	</head>
	<body>
		<div id ="maPage">
			<?php include("header.php"); ?>
			<div id ="corps">
				<header>
					<?php
						if(isset($_SESSION['id']) AND isset($_SESSION['pseudo']) AND isset($_SESSION['rang'])){
							echo '<h3>Bonjour '.$_SESSION['pseudo'].' !</h3>';
						}else if(isset($_GET['logout']) == true){
							echo '<h5 class="logout_alert">Vous avez bien été déconnecté !</h5>';
						}
					?>
					<h1>Bienvenue sur l'Accueil.<h1>
				</header>
				<div id = "sur_slider"></div>
				<div class="slider">
				<?php

					try{
						$bdd = new PDO('mysql:host=localhost;dbname=letempsdunongle','root','');
					}catch(Exception $e){
						die('Error :'.$e->getMessage());
					}

					$requete = $bdd->query('SELECT id,adresse,DATE_FORMAT(date_ajout,\'%d-%m-%y\') AS date_ajout FROM image ORDER BY id');
					while($donnees = $requete->fetch()){
						$image_source = imagecreatefromjpeg($donnees['adresse']);
						$hauteur_miniature = 384;
						$largeur_miniature;

						if((imagesy($image_source)/imagesx($image_source))>=1){
							$largeur_miniature = $hauteur_miniature /(imagesy($image_source)/imagesx($image_source));
						}else{
							$largeur_miniature = $hauteur_miniature / (imagesy($image_source)/imagesx($image_source));
						}

						?>
						<div class="box_photo">
							<a class="lien_photo" href="<?php echo $donnees['adresse']; ?>" target="_blank"><img class="photo" src="<?php echo $donnees['adresse']; ?>" height="<?php echo $hauteur_miniature; ?>" width="<?php echo $largeur_miniature ?>"/></a>
						</div>
						<?php
					}
					$requete->closeCursor();

				?>
				</div> 
				<?php include("footer.php"); ?>
			</div>
		</div>
		<script type="text/javascript" src="http://code.jquery.com/jquery-1.7.min.js"></script>
		<script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.4.1.min.js"></script>
		<script type="text/javascript" src="script/slick/slick.min.js"></script>
			
		<script>	
			$(document).ready(function(){
				$('.slider').slick({
					dots: true,
					infinite: true,
					speed: 1000,
					slidesToShow: 1,
					centerMode: true,
					variableWidth: true,	
					autoplay : true,
					autoplaySpeed : 3000
				});
			});
		</script>
	</body>
</html>
	