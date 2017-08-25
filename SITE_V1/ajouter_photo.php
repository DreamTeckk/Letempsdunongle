<?php 
	session_start();
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Le Temps d'un Ongle - Bienvenue</title>
		<link rel="stylesheet" type="text/css" href="ajouter_photo.css">
	</head>
	<body>
		<?php include('header.php'); ?>
		<h1>Ajouter une photo</h1>
		<?php
			//On vérifie que l'utilisateur soit connecté et possède donc une session.
			if(isset($_SESSION['id']) AND isset($_SESSION['pseudo']) AND isset($_SESSION['rang'])){
							
				//On regarde si l'utilisateur est un administrateur.
				if($_SESSION['rang'] == 'administrateur'){
					?>
					<form method="post" action="ajout_photo_bdd.php" enctype="multipart/form-data">
						<p>
							<?php
								if(isset($_GET['size_error'])){
									if($_GET['size_error'] == true){
										echo '<p class="error">L\'image est trop lourde (10Mo max.).</p>';
									}
								}elseif (isset($_GET['extension_error'])) {
									if($_GET['extension_error']){
										echo '<p class="error">L\'extension de l\'image n\'est pas valide.</p>';
									}
								}
							?>
							<label for="nom_tarif">Choisir un fichier :</label>
							<input type="file" name="fichier_envoye"><br />
							
							<p class="allowed">Taille Max : 10Mo<br />
							(format autorisés : .jpg .jpeg .JPG .png)</p><br />

							<input type="hidden" name="MAX_FILE_SIZE" value="10000000">
							<input type="submit" value="Ajouter">
						</p>
					</form>
					<?php
				}else{
					header('Location: acces_page_interdit.php');
				}
			}else{
				header('Location: acces_page_interdit.php');
			}
		?>
		<?php include('footer.php'); ?>
	</body>
</html>