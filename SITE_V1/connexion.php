<?php
	
	//Test du bon déroulement de la connexion à la BDD.
	try{
		$bdd = new PDO('mysql:host=localhost;dbname=letempsdunongle','root','');
	}catch(Exception $e){
		die('Erreur :'.$e.getMessage());
	}

	$pseudo = htmlspecialchars($_POST['pseudo']);
	$mdp = htmlspecialchars($_POST['passw']);
	$loginSucces = false;

	$resultat = $bdd->prepare('SELECT * FROM utilisateur WHERE pseudo=:pseudo AND mot_de_passe=:mdp');

	$resultat->execute(array(
		'pseudo' => $pseudo,
		'mdp' => hash('sha256', $mdp, false)
		));
	if($donnees = $resultat->fetch()){
		$loginSucces = true;
	}

	if($loginSucces == true){
		session_start();
		$_SESSION['id'] = $resultat['id'];
		$_SESSION['pseudo'] = $pseudo;
		$resultat->closeCursor();

		header('Location: index.php');
	}else{
		$resultat->closeCursor();
		
		header('Location: zone_administrateur.php?auth_error=true');
	}
?>