<!--
	Fichier : contact.php;
	Projet:	Site Suzanne Michaud;
	Auteur: Nathan ARAGO;
	Date Creation: 	12/05/2017;
-->
<?php
	session_start();
?>

<!doctype html>
<html lang="fr">
	<head>
		<meta charset="utf-8">
		<title>Le Temps d'un Ongle - Contact</title>
		<link rel="stylesheet" href="contact.css">
	</head>
	<body>
		<div id ="maPage">
			<?php include("header.php"); ?>
			<div id ="corps">
				<header>
					<h1>Me Contacter.<h1>
				</header>
				<div class="zone_tel">
					<img src="Icons/phone_icon.png"/>
					<p>Appelez moi : </p>
					</br>
					<p>Tel : 06.42.89.05.86 </p>
				</div>
				<div class = "zone_mail">
					<img src="Icons/mail_icon.png"/>
					<p>Envoyez moi un mail : </p>
					<form action="mailto:letempsdunongle37@gmail.com" method="post" enctype="text/plain">
						Nom:<br>
						<input type="text" name="name"><br>
						E-mail:<br>
						<input type="text" name="mail"><br>
						Message:<br>
						<textarea name="text" placeholder="Message"></textarea>
						<input type="submit" value="Envoyer">
						<input type="reset" value="Annuler">
					</form>
				</div>
				<div class = "zone_loca">
					<img src="Icons/loca_icon.png"/>
					<p>Où me trouver ?</p>
					</br>
					<iframe class="google_map" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2700.279033694468!2d0.6708575158937407!3d47.406498309772296!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x47fcd59fb84a8ab5%3A0xb139a75f3315ee7e!2s51+Rue+Fleurie%2C+37540+Saint-Cyr-sur-Loire!5e0!3m2!1sfr!2sfr!4v1501425035601" width="800" height="600" frameborder="0" style="border:0" allowfullscreen></iframe>
				</div>
				<?php include("footer.php"); ?>
			</div>
		</div>
	</body>
</html>