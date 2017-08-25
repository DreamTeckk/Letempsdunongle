<?php

	session_start();

	$dbHost = 'localhost';
	$dbName = 'letempsdunongle';
	$dbUsername = 'root';
	$dbPassword = '';

	if(isset($_SESSION['id']) AND isset($_SESSION['pseudo']) AND isset($_SESSION['rang'])){
							
		//Affichage si l'utilisateur est un administrateur.
		if($_SESSION['rang'] == 'administrateur'){

			if(isset($_GET['id_image'])){

				try{

					$bdd = new PDO('mysql:host='.$dbHost.';dbname='.$dbName.'',$dbUsername,$dbPassword);

				}catch(Exception $e){

						die('Error :'.$e->getMessage());
				}

				$requete = $bdd->prepare('SELECT * FROM image WHERE id=:id_image');
				$requete->execute(array('id_image'=>$_GET['id_image']));

				$donnees = $requete->fetch();
				if($donnees){
					$requete->closeCursor();

					$requete = $bdd->prepare('UPDATE image SET presence_slider=0 WHERE id=:id_image');
					$requete->execute(array('id_image'=>$_GET['id_image']));
					$requete->closeCursor();

					header('Location: index.php?picture_removed_fromSlide=true');

				}else{
					header('Location: index.php?error_notFound2=true');
				}
			}else{
				header('Location: index.php?error_notFound1=true');
			}

		}else{
			header('Location: acces_page_interdit.php');
		}
	}else{
		header('Location: acces_page_interdit.php');
	}

?>