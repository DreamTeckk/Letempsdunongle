<?php
	session_start();
	//On vérifie que l'utilisateur soit connecté et possède donc une session.
	if(isset($_SESSION['id']) AND isset($_SESSION['pseudo']) AND isset($_SESSION['rang'])){
							
		//On regarde si l'utilisateur est un administrateur.
		if($_SESSION['rang'] == 'administrateur'){

			if(isset($_GET['id_photo'])){

				try{
					$bdd = new PDO('mysql:host=localhost;dbname=letempsdunongle','root','');
				}catch(Exception $e){
					die('Error :'.$e->getMessage());
				}

				$requete = $bdd->prepare('SELECT * FROM image WHERE id=:id_photo');
				$requete->execute(array('id_photo'=>$_GET['id_photo']));

				$donnees = $requete->fetch();
				if($donnees){

					$dossier = opendir('gallery_uploads/');	
					unlink($donnees['adresse']);
					closedir($dossier);

					$requete->closeCursor();

					$requete = $bdd->prepare('DELETE FROM image WHERE id=:id_photo');
					$requete->execute(array('id_photo'=>$_GET['id_photo']));

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