<?php 
	session_start();
?>
<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Le Temps d'un Ongle - Bienvenue</title>
		<link rel="stylesheet" type="text/css" href="editer_tarif.css">
	</head>
	<body>
		<?php include('header.php'); ?>
		<h1>Modifier un tarif</h1>
		<?php
			//On vérifie que l'utilisateur soit connecté et possède donc une session.
			if(isset($_SESSION['id']) AND isset($_SESSION['pseudo']) AND isset($_SESSION['rang'])){
							
				//On regarde si l'utilisateur est un administrateur.
				if($_SESSION['rang'] == 'administrateur'){

					try{
						$bdd = new PDO('mysql:host=localhost;dbname=letempsdunongle','root','');
					}catch(Exception $e){
						die('Error :'.$e->getMessage());
					}

					$requete = $bdd->prepare('SELECT * FROM tarif WHERE id_tarif=:id');
					$requete->execute(array(
						'id'=>htmlspecialchars($_GET['id_tarif'])
						));
					$donnees = $requete->fetch();
					if($donnees){
						?>
						<form method="post" action="edit_tarif_bdd.php?id_tarif=<?php echo $_GET['id_tarif']; ?>">
							<p>
								<?php
									if(isset($_GET['price_error'])){
										if($_GET['price_error'] == true){
											echo '<p class="error">Le prix entré n\'est pas valide.</p>';
										}
									}
								?>
								<label for="nom_tarif">Titre du tarif :</label>
								<input type="text" name="nom_tarif" id="nom_tarif" value="<?php echo $donnees['nom_tarif']; ?>" required="true"/><br />
								<label for="prix_tarif">Prix du tarif (en &#8364) :</label>
								<input type="text" name="prix_tarif" id="prix_tarif" value="<?php echo $donnees['prix_tarif']; ?>" required="true"/><br />
								<input type="submit" value="Ajouter">
							</p>
						</form>
						<?php
					}else{
						echo 'Erreur!<br />L\'identifiant du tarif est introuvable';
					}
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