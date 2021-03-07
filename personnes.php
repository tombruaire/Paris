<?php

if(isset($_SESSION['droits']) && $_SESSION['droits'] == "Admin") {

	// SUPPRIMER UNE PERSONNE
	if(isset($_GET["action"]) && isset($_GET["idpers"]) && $_GET["action"]=="s") {
		$unControleur->deletePersonne($_GET["idpers"]);
		echo "<br> Suppression réussi de la personne ! <br>";
	} else {
		echo "<br> Veuillez supprimer une personne. <br>";
	}

	// INSÉRER UNE PERSONNE 
	require_once("vue/vueInsertPersonnes.php");
	if(isset($_POST['Valider'])) {		
		$unControleur->insertPersonne ($_POST);
		echo "<br> Insertion réussi de la personne ! <br>";
	} else {
		echo "<br> Veuillez insérer une personne. <br>";
	}

}

// Récupèration et Affichage des Personnes
$lesPersonnes = $unControleur->selectAllPersonnes();

// Appel de la Vue de Sélection des Personnes
require_once("vue/vueSelectAllPersonnes.php");

?>