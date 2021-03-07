<?php

class Modele { // Cette classe va gérer la connexion à la base de données et les requêtes sur les tables

private $pdo; // Objet de la classe PDO PHP DATA Object qui permet de se connecter à la base de données

public function __construct() {
	try {
		$this->pdo = new PDO ("mysql:host=localhost;dbname=paris", "root", "");
	}
	catch(PDOEXception $exp) {
		echo "Erreur de connexion au serveur MySQL";
	}
}

// Sélection de tous les Évènements
public function selectAllEvents() {
	if($this->pdo != null) {
		$requete = "select * from evenement;"; // Selection de la requête qui permet d'avoir tous les évènements
		$select = $this->pdo->prepare($requete); // Préparation de la requête avant l'exécution
		$select->execute(); // Exécution de la requête
		$resultats = $select->fetchAll(); // Extraction des données
		return $resultats;
	} else {
		return null;
	}
}

/*** GESTION DES ÉVENEMENTS ***/

// Insertion d'un évènements
public function insertEvent($tab) {
	if($this->pdo != null) {
		$requete = "insert into evenement values (null, :designation, :dateevent, :heureevent, :description, :prixplace);";
		$donnees = array (":designation"=>$tab["designation"], ":dateevent"=>$tab["dateevent"], ":heureevent"=>$tab["heureevent"], ":description"=>$tab["description"], ":prixplace"=>$tab["prixplace"]);
		$insert = $this->pdo->prepare($requete); // Préparation de la requête
		$insert->execute($donnees); // Éxécution de la requête
	} else {
		return null;
	}
}

// Sélection de tous les évènements
public function selectAllEvent() {
	if($this->pdo != null) {
		$requete = "select * from evenement;"; // Selection de la requête qui permet d'avoir tous les évènements
		$select = $this->pdo->prepare($requete);
		$select->execute();
		$resultats = $select->fetchAll();
		return $resultats;
	} else {
		return null;
	}
}

// Suppression d'un évènement
public function deleteEvent($idevent) {
	if($this->pdo != null) {
		$requete = "delete from evenement where idevent = :idevent;"; // On va chercher "idevent" pour supprimer les Évènements
		$donnees = array (":idevent"=>$idevent); // Correspondance des données
		$insert = $this->pdo->prepare($requete); // Préparation de la requête
		$insert->execute($donnees); // Éxécution de la requête
	} else {
		return null;
	}
}

/*** GESTION DES PERSONNES ***/

// Insertion d'une personne
public function insertPersonne($tab) {
	if($this->pdo != null) {
		$requete = "insert into personne values (null, :nom, :prenom, :email, :telephone, :adresse);";
		$donnees = array (":nom"=>$tab["nom"], ":prenom"=>$tab["prenom"], ":email"=>$tab["email"], ":telephone"=>$tab["telephone"], ":adresse"=>$tab["adresse"]);
		$insert = $this->pdo->prepare($requete);
		$insert->execute($donnees);
	} else {
		return null;
	}
}

// Sélection de toutes les personnes
public function selectAllPersonnes() {
	if($this->pdo != null) {
		$requete = "select * from personne;";
		$select = $this->pdo->prepare($requete);
		$select->execute();
		$resultats = $select->fetchAll();
		return $resultats;
	} else {
		return null;
	}
}

// Suppression d'une personne
public function deletePersonne($idpers) {
	if($this->pdo != null) {
		$requete = "delete from personne where idpers = :idpers;";
		$donnees = array (":idpers"=>$idpers);
		$insert = $this->pdo->prepare($requete);
		$insert->execute($donnees);
	} else {
		return null;
	}
}

/*** GESTION DES PARTICIPATION ***/

// Insertion d'une participation
public function insertParticipation($tab) {
	if($this->pdo != null) {
		$requete = "insert into participer values (:idpers, :idevent, :nbplaces, :prixtotal, now(), :commentaire);";
		$donnees = array (":idpers"=>$tab["idpers"], ":idevent"=>$tab["idevent"], ":nbplaces"=>$tab["nbplaces"], ":prixtotal"=>$tab["prixtotal"], ":commentaire"=>$tab["commentaire"]);
		$insert = $this->pdo->prepare($requete);
		$insert->execute($donnees);
	} else {
		return null;
	}
}

// Sélection de toutes les participations
public function selectAllParticipations() {
	if($this->pdo != null) {
		$requete = "select * from viewParticipations;";
		$select = $this->pdo->prepare($requete);
		$select->execute();
		$resultats = $select->fetchAll();
		return $resultats;
	} else {
		return null;
	}
}

// Suppression d'une participation
public function deleteParticipation($idevent, $idpers) {
	if($this->pdo != null) {
		$requete = "delete from participer where idpers = :idpers and idevent = :idevent;";
		$donnees = array (":idpers"=>$idpers, ":idevent"=>$idevent);
		$insert = $this->pdo->prepare($requete);
		$insert->execute($donnees);
	} else {
		return null;
	}
}

/*** GESTION DES CONNEXIONS D'UTILISATEURS ***/

// Sélection de toutes connexions
public function selectWhereUser($tab) {
	if($this->pdo != null) {
		$requete = "select * from user where email = :email and mdp = :mdp;"; // Récupération de la personne qui se connecte
		$select = $this->pdo->prepare($requete);
		$donnees = array (":email"=>$tab["email"], ":mdp"=>$tab["mdp"]); // Correspondance entre le mail et le mot de passe
		$select->execute($donnees);
		$resultat = $select->fetch();
		return $resultat;
	} else {
		return null;
	}
}

// Insertion d'un utilisateur
public function insertUser($tab) {
	if($this->pdo != null) {
		$requete = "insert into user values (null, :email, :mdp, :nom, :prenom, :telephone, :droits);";
		$donnees = array (
			":email"=>$tab["email"],
			":mdp"=>$tab["mdp"],
			":nom"=>$tab["nom"], 
			":prenom"=>$tab["prenom"],
			":telephone"=>$tab["telephone"],
			":droits"=>$tab["droits"]
		);
		$insert = $this->pdo->prepare($requete);
		$insert->execute($donnees);
	} else {
		return null;
	}
}

// Sélection des utilisateurs
public function selectAllUsers() {
	if($this->pdo != null) {
		$requete = "select * from user;";
		$select = $this->pdo->prepare($requete);
		$select->execute();
		$resultats = $select->fetchAll();
		return $resultats;
	} else {
		return null;
	}
}

// Suppression d'un utilisateur
public function deleteUser($iduser) {
	if($this->pdo != null) {
		$requete = "delete from user where iduser = :iduser;";
		$donnees = array (":iduser"=>$iduser);
		$insert = $this->pdo->prepare($requete);
		$insert->execute($donnees);
	} else {
		return null;
	}
}

} // Fin de la class 'Modele'

?>