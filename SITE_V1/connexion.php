<?php

	include('connexion_bdd.php');
	
	$pseudo = htmlspecialchars($_POST['pseudo']);	//Mise en variable du pseudo entré dans le formulaire.
	$mdp = htmlspecialchars($_POST['passw']);	//Mise en variable du mot de passe entré dans le formulaire.
	$loginSucces = false;	//Booléen verifant la reussite de connexion. 

	$resultat = $bdd->prepare('SELECT * FROM utilisateur WHERE pseudo=:pseudo AND mot_de_passe=:mdp');	//Preparation de la requête de recherche du pseudo et mot de passe correspondant.

	//Exécution de la requête. 
	$resultat->execute(array(
		'pseudo' => $pseudo,
		'mdp' => hash('sha256', $mdp, false)
		));

	$donnees = $resultat->fetch();

	if($donnees){

		$_SESSION = array();
		session_destroy();

		//Démmarage de la session avec l'id, le pseudo et le rang de l'utilisateur en référence.
		session_start();
		$_SESSION['id'] = $donnees['id'];
		$_SESSION['pseudo'] = $pseudo;
		$_SESSION['rang'] = $donnees['rang'];

		$resultat->closeCursor();	//Fermeture de la requête de recherche.
		
		$update = $bdd->prepare('UPDATE utilisateur SET derniere_connexion = NOW() WHERE pseudo=:pseudo AND mot_de_passe=:mdp'); //Préparation de la requête de mise à jour de la dernière connexion de l'utilisateur. 

		//Execution de la requête.
		$update->execute(array(
		'pseudo' => $pseudo,
		'mdp' => hash('sha256', $mdp, false)
		));


		$update->closeCursor(); //Fermeture de la requête de mise à jour.
		header('Location: index.php');

	}else{
		$resultat->closeCursor();
		
		header('Location: zone_administrateur.php?auth_error=true');
	}
?>