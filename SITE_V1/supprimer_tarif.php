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
			$id_tarif = htmlspecialchars($_GET['id_tarif']);

			try{
				$bdd = new PDO('mysql:host='.$dbHost.';dbname='.$dbName.'',$dbUsername,$dbPassword);
			}catch(Exception $e){
				die('Error : '.$e->getMessage());
			}

			$requete = $bdd->prepare('DELETE FROM tarif WHERE id_tarif=:id');
			$requete->execute(array(
				'id'=>$id_tarif
				));
			header('Location: prestation.php');
		}else{
			header('Location: acces_page_interdit.php');
		}
	}else{
		header('Location: acces_page_interdit.php');
	}
?>