<?php 
	session_start();
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Le Temps d'un Ongle - Bienvenue</title>
		<link rel="stylesheet" type="text/css" href="ajouter_tarif.css">
	</head>
	<body>
		<?php include('header.php'); ?>
		<h1>Ajouter un tarif</h1>
		<?php
			//On vérifie que l'utilisateur soit connecté et possède donc une session.
			if(isset($_SESSION['id']) AND isset($_SESSION['pseudo']) AND isset($_SESSION['rang'])){
							
				//On regarde si l'utilisateur est un administrateur.
				if($_SESSION['rang'] == 'administrateur'){
					?>
					<form method="post" action="ajout_tarif_bdd.php">
						<p>
							<?php
								if(isset($_GET['price_error'])){
									if($_GET['price_error'] == true){
										echo '<p class="error">Le prix entré n\'est pas valide.</p>';
									}
								}
							?>
							<label for="nom_tarif">Titre du tarif :</label>
							<input type="text" name="nom_tarif" id="nom_tarif" placeholder="Ex : french manucure" required="true"/><br />
							<label for="prix_tarif">Prix du tarif (en &#8364) :</label>
							<input type="text" name="prix_tarif" id="prix_tarif" placeholder="Ex : 35 ; 15.99 ; 0.50" required="true"/><br />
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