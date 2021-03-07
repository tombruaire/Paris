<?php

if(isset($_SESSION['droits']) && $_SESSION['droits'] == "Admin") {
	// INSÉRER UNE PARTICIPATION
	// Récupération des Évènements et des Personnes
	$lesEvenements = $unControleur->selectAllEvents();
	$lesPersonnes = $unControleur->selectAllPersonnes();

	// Appel de la vue d'Insértion de la Participation
	require_once("vue/vueInsertParticipation.php");


	if(isset($_POST['Valider'])) {

		// Appel de la méthode "insert" du Controleur
		$unControleur->InsertParticipation($_POST);
		echo "<br> '<font color='#7FFF00' style='background-color: black;'>'Insertion réussi de la Participation !</font> <br>";

	} else {

		echo "<br> <font color='white' style='background-color: black;'>Veuillez insérer une Participation</font> <br>";

	}

	// SUPPRIMER UNE PARTICIPATION
	if(isset($_GET["action"]) && isset($_GET["idevent"]) && isset($_GET["idpers"]) && $_GET["action"]=="s") {

		$unControleur->deleteParticipation($_GET["idevent"], $_GET{"idpers"});
		echo "<br> <font color='#7FFF00' style='background-color: black;'>Suppression réussi de la Participation !</font> <br>";

	} else {

		echo "<br> <font color='white' style='background-color: black;'>Veuillez supprimer une Participation</font> <br>";

	}

}

// Récupèration et Affichage des Participations
$lesParticipations = $unControleur->selectAllParticipations();

// Appel de la Vue de Sélection des Participations
require_once("vue/vueSelectParticipations.php");

?>