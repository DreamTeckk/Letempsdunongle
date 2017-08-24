<?php
	session_start();

	//On vérifie que l'utilisateur soit connecté et possède donc une session.
	if(isset($_SESSION['id']) AND isset($_SESSION['pseudo']) AND isset($_SESSION['rang'])){
							
		//On regarde si l'utilisateur est un administrateur.
		if($_SESSION['rang'] == 'administrateur'){

			$nomFichier = $_FILES['fichier_envoye']['name'];
			$tailleFichier = $_FILES['fichier_envoye']['size'];
			$infoFichier = pathinfo($_FILES['fichier_envoye']['name']);
			$extensionFichier = $infoFichier['extension'];
			$extensionValide = array('jpg','jpeg','JPG','png');
			$nomFinalFichier = ''.$nomFichier.'.'.$extensionFichier.'';

			//Verification que taille du fichier <= 10Mo. 
			if($tailleFichier <= 10000000){

				//Verification de l'extentension du fichier.
				if(in_array($extensionFichier, $extensionValide)){

					ini_set('upload-max-filesize', '10000000');
					ini_set('post_max_size', '10000000');

					move_uploaded_file($_FILES['fichier_envoye']['tmp_name'],'gallery_uploads/'.$nomFinalFichier);		

					try{
						$bdd = new PDO('mysql:host=localhost;dbname=letempsdunongle','root','');

					}catch(Exception $e){
						die('Error :'.$e->getMessage());
					}

					$requete = $bdd->prepare('INSERT INTO image(adresse,date_ajout) VALUES(:adresse,NOW())');
					$requete->execute(array(
						'adresse'=>'gallery_uploads/'.$nomFinalFichier
						));
					$requete->closeCursor();

					header('Location: photos.php');
				}else{
					header('Location: ajouter_photo.php?extension_error=true');
				}
			}else{
				header('Location: ajouter_photo.php?size_error=true');
			}
		}else{
			header('Location: acces_page_interdit.php');
		}
	}else{
		header('Location: acces_page_interdit.php');
	}
?>