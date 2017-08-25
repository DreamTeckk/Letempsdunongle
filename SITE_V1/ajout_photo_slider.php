<?php
	session_start();

	if(isset($_SESSION['id']) AND isset($_SESSION['pseudo']) AND isset($_SESSION['rang'])){
							
		//Affichage si l'utilisateur est un administrateur.
		if($_SESSION['rang'] == 'administrateur'){

			if(isset($_GET['id_image'])){

				include('connexion_bdd.php');

				$requete = $bdd->prepare('SELECT * FROM image WHERE id=:id_image');
				$requete->execute(array('id_image'=>$_GET['id_image']));

				$donnees = $requete->fetch();
				if($donnees){
					$requete->closeCursor();

					$requete = $bdd->prepare('UPDATE image SET presence_slider=1 WHERE id=:id_image');
					$requete->execute(array('id_image'=>$_GET['id_image']));
					$requete->closeCursor();

					header('Location: photos.php?picture_added_toSlide=true');
				}

			}else{
				header('Location: photos.php?error_notFound=true');
			}

		}else{
			header('Location: acces_page_interdit.php');
		}
	}else{
		header('Location: acces_page_interdit.php');
	}

?>