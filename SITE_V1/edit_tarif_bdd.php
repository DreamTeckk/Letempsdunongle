<?php

	session_start();
	
	//On vérifie que l'utilisateur soit connecté et possède donc une session.
	if(isset($_SESSION['id']) AND isset($_SESSION['pseudo']) AND isset($_SESSION['rang'])){
							
		//On regarde si l'utilisateur est un administrateur.
		if($_SESSION['rang'] == 'administrateur'){

			$nom_tarif = htmlspecialchars($_POST['nom_tarif']);
			$prix_tarif = htmlspecialchars($_POST['prix_tarif']);
			$id_tarif = htmlspecialchars($_GET['id_tarif']);

			if(!(preg_match("#^\d+(.?\d)?\d*$#", $prix_tarif))){
				header('Location: editer_tarif.php?price_error=true&id_tarif='.$id_tarif.'');
			}else{

				include('connexion_bdd.php');

				$requete = $bdd->prepare('UPDATE tarif SET nom_tarif=:nom, prix_tarif=:prix WHERE id_tarif=:id');
				$requete->execute(array(
					'nom'=>$nom_tarif,
					'prix'=>$prix_tarif,
					'id'=>$id_tarif
					));

				header('Location: prestation.php');
			}
		}else{
			header('Location: acces_page_interdit.php');
		}
	}else{
		header('Location: acces_page_interdit.php');
	}

?>