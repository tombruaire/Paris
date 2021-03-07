<?php

// On test si l'user est un admin : on lui donne les droits d'inserton et de supression
if(isset($_SESSION['droits']) && $_SESSION['droits'] == "Admin") {

	// SUPPRIMER UN ÉVÈNEMENT
	if(isset($_GET["action"]) && isset($_GET["idevent"]) && $_GET["action"]=="s") {
		$unControleur->deleteEvent($_GET["idevent"]);
		echo "<br> Suppression réussi de l'Évènement ! <br>";
	} else {
		echo "<br> Veuillez supprimer un Évènement. <br>";
	}

	// INSÉRER UN ÉVÈNEMENT
	require_once("vue/vueInsertEvent.php");
	if(isset($_POST['Valider'])) {
		$unControleur->insertEvent ($_POST);
		echo "<br> Insertion réussi de l'Évènement ! <br>";
	} else {
		echo "<br> Veuillez insérer un Évènement. <br>";
	}

}



// Afficher les Évènements : droit attribué pour les users et les admins

// Récupèration et Affichage des Évènements
$lesEvenements = $unControleur->selectAllEvents();

// Appel de la Vue de Sélection des Évènements
require_once("vue/vueSelectAllEvents.php");

?>