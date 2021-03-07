<?php

require_once("modele/modele.class.php");

class Controleur {

	// Le contrôleur appel le modèle
	private $leModele; // Instance de la classe Modèle

	public function __construct() {
		$this->leModele = new Modele();
	}

	// Sélection de tous les Évènements
	public function selectAllEvents() {

		// On appelle le modèle pour l'extraction des évènements de la Base de données
		$resultats = $this->leModele->selectAllEvents();

		// On pourra faire des traitements sur les données récupérées de la Base de données avant l'envoi à la vue

		// Renvoi des données à la vue
		return $resultats;

	} // Fin de la sélection

/* MÉTHODE POUR LES ÉVÈNEMENTS */
public function insertEvent($tab) {
	$this->leModele->insertEvent($tab);
}

public function deleteEvent($idevent) { 
	$this->leModele->deleteEvent($idevent);
}

/* MÉTHODE POUR LES PERSONNES */
public function selectAllPersonnes() {
	return $this->leModele->selectAllPersonnes();
}

public function insertPersonne($tab) {
	$this->leModele->insertPersonne($tab);
}

public function deletePersonne($idpers) {
	$this->leModele->deletePersonne($idpers);
}

/* MÉTHODE POUR LES PARTICIPATIONS */
public function selectAllParticipations() {
	return $this->leModele->selectAllParticipations();
}

public function insertParticipation($tab) {
	$this->leModele->insertParticipation($tab);
}

public function deleteParticipation($idevent, $idpers) {
	$this->leModele->deleteParticipation($idevent, $idpers);
}

/* GESTION DES CONNEXION */
public function selectWhereUser($tab) {
	return $this->leModele->selectWhereUser($tab); 
}

public function selectAllUsers() {
	return $this->leModele->selectAllUsers();
}

public function insertUser($tab) {
	$this->leModele->insertUser($tab);
}

public function deleteUser($iduser) {
	$this->leModele->deleteUser($iduser);
}

} // Fin de la class

?>