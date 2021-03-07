<?php

if(isset($_SESSION['droits']) && $_SESSION['droits'] == "Admin") {

	// SUPPRIMER UN UTILISATEUR
	if(isset($_GET["action"]) && isset($_GET["iduser"]) && $_GET["action"]=="s") {
		$unControleur->deleteUser($_GET["iduser"]);
		echo "<br> Suppression réussi de l'utilisateur ! <br>";
	} else {
		echo "<br> Veuillez supprimer un utilisateur. <br>";
	}

	// INSÉRER UN UTILISATEUR
	require_once("vue/vueInsertUser.php");
	if(isset($_POST['Valider'])) {		
		$unControleur->insertUser ($_POST);
		echo "<br> Insertion réussi de l'utilisateur ! <br>";
	} else {
		echo "<br> Veuillez insérer une utilisateur. <br>";
	}

}

// Récupèration et Affichage des Users
$lesUsers = $unControleur->selectAllUsers();

// Appel de la Vue de la sélection des Users
require_once("vue/vueSelectAllUsers.php");

?>