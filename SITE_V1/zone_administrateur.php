<!DOCTYPE html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<link rel="stylesheet" href="zone_administrateur.css">
		<link rel="stylesheet" type="text/css" href="script/slick/slick.css"/>	
		<link rel="stylesheet" type="text/css" href="script/slick/slick-theme.css"/>
	</head>
	<body>
		<?php include('header.php'); ?>
		<div class="loginForm">
			<form method="post" action="connexion.php">
				<p>
					<?php 
						if(isset($_GET['auth_error'])){
							if($_GET['auth_error'] == true){
								?>
								<p class="auth_error">Le nom d'utilisateur ou mot de passe est incorrect.</p>
								<?php
							}
						}
					 ?>
					<input type="text" name="pseudo" placeholder="Nom d'utilisateur" /><br />
					<input type="password" name="passw" placeholder="Mot de passe" /><br />
					<input type="submit" value="Se connecter">
				</p>
			</form>
		</div>
		<?php include('footer.php'); ?>
	</body>
</html>