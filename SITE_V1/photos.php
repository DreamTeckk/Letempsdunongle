<!--
	Fichier : photo.php;
	Projet:	Site Suzanne Michaud;
	Auteur: Nathan ARAGO;
	Date Creation: 	12/05/2017;
-->
<?php
	session_start();

	$dbHost = 'localhost';
	$dbName = 'letempsdunongle';
	$dbUsername = 'root';
	$dbPassword = '';

?>

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
				<!-- AFFICHAGE DES PHOTOS DEPUIS LA BDD -->
				<?php

					try{
						$bdd = new PDO('mysql:host='.$dbHost.';dbname='.$dbName.'',$dbUsername,$dbPassword);
					}catch(Exception $e){
						die('Error :'.$e->getMessage());
					}

					$requete = $bdd->query('SELECT id,adresse,DATE_FORMAT(date_ajout,\'%d-%m-%y\') AS date_ajout FROM image ORDER BY id');

					//On vérifie que l'utilisateur soit connecté et possède donc une session.
					if(isset($_SESSION['id']) AND isset($_SESSION['pseudo']) AND isset($_SESSION['rang'])){
							
						//Affichage si l'utilisateur est un administrateur.
						if($_SESSION['rang'] == 'administrateur'){

							if(isset($_GET['picture_added_toSlide']) && ($_GET['picture_added_toSlide'] == true)){
								echo '<h4 class="success">L\'image a bien été ajoutée au slider.</h4>';
							}

							while($donnees = $requete->fetch()){
								$image_source = imagecreatefromjpeg($donnees['adresse']);
								$hauteur_miniature = 250;
								$largeur_miniature;

								if((imagesy($image_source)/imagesx($image_source))>=1){
									$largeur_miniature = $hauteur_miniature /(imagesy($image_source)/imagesx($image_source));
								}else{
									$largeur_miniature = $hauteur_miniature / (imagesy($image_source)/imagesx($image_source));
								}

									?>
									<div class="box_photo">
										<a class="remove_button" href="supprimer_photo.php?id_image=<?php echo $donnees['id']?>"><img src="icons/remove.png" title="supprimer l'image" /></a>
										<a class="addToSlide_button" href="ajout_photo_slider.php?id_image=<?php echo $donnees['id']?>"><img src="icons/addToSlide.png" title="ajouter l'image au slider" /></a>
										<p class="date_ajout_photo">Ajoutee le <?php echo $donnees['date_ajout']; ?></p>
										<a class="lien_photo" href="<?php echo $donnees['adresse']; ?>" target="_blank"><img class="photo" src="<?php echo $donnees['adresse']; ?>" title="cliquez pour agrandir l'image" height="<?php echo $hauteur_miniature; ?>" width="<?php echo $largeur_miniature ?>"/></a>
									</div>
									<?php
							}
							?>
							<a class="add_button" href="ajouter_photo.php"><img src="icons/add128.png" alt="bouton ajouter" title="Ajouter une image"/></a>
							<?php

						//Affichage si l'utilisateur n'est pas un administrateur.
						}else{

							while($donnees = $requete->fetch()){
								$image_source = imagecreatefromjpeg($donnees['adresse']);
								$hauteur_miniature = 250;
								$largeur_miniature;

								if((imagesy($image_source)/imagesx($image_source))>=1){
									$largeur_miniature = $hauteur_miniature /(imagesy($image_source)/imagesx($image_source));
								}else{
									$largeur_miniature = $hauteur_miniature / (imagesy($image_source)/imagesx($image_source));
								}

								?>
								<div class="box_photo">
										<p class="date_ajout_photo">Ajoutee le <?php echo $donnees['date_ajout']; ?></p>
										<a class="lien_photo" href="<?php echo $donnees['adresse']; ?>" target="_blank"><img class="photo" src="<?php echo $donnees['adresse']; ?>" height="<?php echo $hauteur_miniature; ?>" width="<?php echo $largeur_miniature ?>"/></a>
								</div>
								<?php
							}

						}
					//Affichage si le visiteur n'est pas connecté.
					}else{

						while($donnees = $requete->fetch()){
							$image_source = imagecreatefromjpeg($donnees['adresse']);
							$hauteur_miniature = 250;
							$largeur_miniature;

							if((imagesy($image_source)/imagesx($image_source))>=1){
									$largeur_miniature = $hauteur_miniature /(imagesy($image_source)/imagesx($image_source));
							}else{
								$largeur_miniature = $hauteur_miniature / (imagesy($image_source)/imagesx($image_source));
							}

							?>
							<div class="box_photo">
								<p class="date_ajout_photo">Ajoutee le <?php echo $donnees['date_ajout']; ?></p>
								<a class="lien_photo" href="<?php echo $donnees['adresse']; ?>" target="_blank"><img class="photo" src="<?php echo $donnees['adresse']; ?>" height="<?php echo $hauteur_miniature; ?>" width="<?php echo $largeur_miniature ?>"/></a>
							</div>
							<?php
						}
					}

					$requete->closeCursor();

				?>
				<!-- FIN AFFICHAGE DES PHOTOS -->
				<?php include("footer.php"); ?>
			</div>
		</div>
	</body>
</html>
	