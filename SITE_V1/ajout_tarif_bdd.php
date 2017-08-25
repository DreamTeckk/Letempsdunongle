<?php
	session_start();

	$dbHost = 'localhost';
	$dbName = 'letempsdunongle';
	$dbUsername = 'root';
	$dbPassword = '';

	//On vérifie que l'utilisateur soit connecté et possède donc une session.
	if(isset($_SESSION['id']) AND isset($_SESSION['pseudo']) AND isset($_SESSION['rang'])){
							
		//On regarde si l'utilisateur est un administrateur.
		if($_SESSION['rang'] == 'administrateur'){

			$nom_tarif = htmlspecialchars($_POST['nom_tarif']);
			$prix_tarif = htmlspecialchars($_POST['prix_tarif']);

			if(!(preg_match("#^\d+(.?\d)?\d*$#", $prix_tarif))){
				header('Location: ajouter_tarif.php?price_error=true');
			}else{

				try{
					$bdd = new PDO('mysql:host='.$dbHost.';dbname='.$dbName.'',$dbUsername,$dbPassword);
				}catch(Exception $e){
					die('Error: '.$e->getMessage());
				}

				$requete = $bdd->prepare('INSERT INTO tarif(nom_tarif,prix_tarif) VALUES(:nom,:prix)');
				$requete->execute(array(
					'nom'=>$nom_tarif,
					'prix'=>$prix_tarif));

				header('Location: prestation.php');
			}
		}else{
			header('Location: acces_page_interdit.php');
		}
	}else{
		header('Location: acces_page_interdit.php');
	}
?>