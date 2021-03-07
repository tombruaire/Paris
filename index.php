<?php
session_start(); // On démarre la Session

require_once("controleur/controleur.class.php"); // Appel du Contrôleur

$unControleur = new Controleur(); // Instanciaton de la classe controleur
?>
<!DOCTYPE html>
<html>
<head>
	<title>Gestion des Évènements de Paris</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link rel="stylesheet" type="text/css" href="css/vueSelectAllEvents.css">
	<link rel="stylesheet" type="text/css" href="css/vueInsertEvent.css">
	<link rel="stylesheet" type="text/css" href="css/vueInsertPeronnes.css">
</head>
<body style="background-image: url(images/fond.jpg);">

<center>

<h1 id="titre-index">
	<a href="index.php?page=0">Les Évènements de la ville de Paris</a>
</h1>

<?php

if(isset($_SESSION['email'])) {

	echo    "<font color='aqua' style='background-color: black;'><h3>
				&nbsp; Bienvenue ".$_SESSION['nom']." ".$_SESSION['prenom']." ! &nbsp; 
			</h3></font> ";

	echo '<nav id="menu-de-navigation">
			<ul>
				<li><a href="index.php?page=1" class="page">Accueil</a></li>
		  		<li><a href="index.php?page=2" class="page">Évènements</a></li>
		  		<li><a href="index.php?page=3" class="page">Personnes</a></li>
		  		<Li><a href="index.php?page=4" class="page">Participations</a></Li>';

	if($_SESSION['droits'] == "Admin") {
		echo '<Li><a href="index.php?page=5" class="page">Gestion des users</a></Li>';
	}

	echo '<Li><a href="index.php?page=6" class="page">Déconnexion</a></Li>
		  	</ul>
		  </nav>';

}

if(isset($_GET["page"])) {
	$page = $_GET["page"];
} else {
	$page = 0;
}

switch($page) {
	case 0 : require_once("connexion.php"); break;
	case 1 : require_once("accueil.php"); break;
	case 2 : require_once("evenements.php"); break;
	case 3 : require_once("personnes.php"); break;
	case 4 : require_once("participations.php"); break;
	case 5 : require_once("users.php"); break;
	case 6 : session_destroy();
			 unset($_SESSION['email']);
			 header("Location: index.php");
			 break;

}

if(isset($_POST["SeConnecter"])) {

		$resultat = $unControleur->selectWhereUser($_POST);

		if($resultat == null) {

			echo 	"<br> 	<font color='red' style='background-color: black;'>
								&nbsp; Veuillez vérifier vos identifiants ! &nbsp;
							</font> <br>";

		} else {

			echo "<br> <font color='aqua' style='background-color: black;'>&nbsp; Bienvenue ".$resultat['nom']." ".$resultat['prenom']." ! &nbsp; </font> <br>";
			$_SESSION['email'] = $resultat['email'];
			$_SESSION['iduser'] = $resultat['iduser'];
			$_SESSION['droits'] = $resultat['droits'];
			$_SESSION['nom'] = $resultat['nom'];
			$_SESSION['prenom'] = $resultat['prenom'];
			header("Location: index.php");

		} // Fin du else
		
	} // Fin du isset

?>

<div id="footer">
	<footer>
		<p>
			Site de Gestion des Évènements de Paris,<br> 
			réalisé par Tom BRUAIRE <br>
	    	Tout droits réservés. Toutes reproductions interdite.
		</p>
	</footer>
</div>

</center>

</body>
</html>