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

					$dossier = opendir('gallery_uploads/');	
					unlink($donnees['adresse']);
					closedir($dossier);

					$requete->closeCursor();

					$requete = $bdd->prepare('DELETE FROM image WHERE id=:id_image');
					$requete->execute(array('id_image'=>$_GET['id_image']));

					$requete->closeCursor();

				header('Location: photos.php?delete_succes=true');
				}else{
					header('Location: photos.php?error_notFound=true');
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