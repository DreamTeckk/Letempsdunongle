<!--
	Fichier : prestation.php;
	Projet:	Site Suzanne Michaud;
	Auteur: Nathan ARAGO;
	Date Creation: 	13/08/2017;
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
		<title>Le Temps d'un Ongle - Bienvenue</title>
		<link rel="stylesheet" href="prestation.css"/>
	</head>
	<body>
		<div id ="maPage">
			<?php include("header.php"); ?>
			<div id ="corps">
				<header>
					<h1>Prestation<h1>
				</header>
				<?php

					try{
						$bdd = new PDO('mysql:host='.$dbHost.';dbname='.$dbName.'',$dbUsername,$dbPassword);
					}catch(Exception $e){
						die('Error :'.$e->getMessage());
					}

					$requete = $bdd->query('SELECT * FROM tarif ORDER BY id_tarif');

					//On vérifie que l'utilisateur soit connecté et possède donc une session.
					if(isset($_SESSION['id']) AND isset($_SESSION['pseudo']) AND isset($_SESSION['rang'])){
							
						//On regarde si l'utilisateur est un administrateur.
						if($_SESSION['rang'] == 'administrateur'){
							while($donnees = $requete->fetch()){

								?>
								<div class="tarif_container">
								<?php
									echo '<p class="tarif">'.$donnees['nom_tarif'].'&nbsp&nbsp:&nbsp&nbsp&nbsp'.$donnees['prix_tarif'].'&#8364.</p>'; ?>
									<a class="edit_button" href="editer_tarif.php?id_tarif=<?php echo $donnees['id_tarif'];?>"><img src="icons/edit.png" alt="bouton supprimer" title="Editer tarif"/></a>
									<a class="remove_button" href="supprimer_tarif.php?id_tarif=<?php echo $donnees['id_tarif'];?>"><img src="icons/remove.png" alt="bouton supprimer" title="Supprimer tarif"/></a>
								</div>
								<?php
							}
						?>
						<br />
						<a class="add_button" href="ajouter_tarif.php"><img src="icons/add.png" alt="bouton ajouter" title="Ajouter tarif"/></a>

						<?php

						}else{

							while($donnees = $requete->fetch()){
								?>
								<div class="tarif_container">
								<?php
									echo '<p class="tarif">'.$donnees['nom_tarif'].'&nbsp&nbsp&nbsp:&nbsp&nbsp&nbsp'.$donnees['prix_tarif'].'&#8364.</p>';
								?>
								</div>
								<?php
							}
						}

					}else{

						while($donnees = $requete->fetch()){

							?>
							<div class="tarif_container">
							<?php
								echo '<p class="tarif">'.$donnees['nom_tarif'].'&nbsp&nbsp&nbsp:&nbsp&nbsp&nbsp'.$donnees['prix_tarif'].'&#8364.</p>';
							?>
							</div>
							<?php
						}
					}

					$requete->closeCursor();

				?>

				<?php include("footer.php"); ?>
			</div>
		</div>
	</body>
</html>	