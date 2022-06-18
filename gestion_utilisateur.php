<?php 

print($unControleur->setTitle("Gestion des utilisateurs"));

$leUser = null;

$unControleur->setTable("user");

if (isset($_SESSION['droits']) && $_SESSION['droits'] == "admin") {

	if (isset($_GET['action']) && isset($_GET['iduser'])) {
		$action = $_GET['action'];
		$iduser = $_GET['iduser'];
		$where = array("iduser"=>$iduser);
		switch ($action) {
			case 'sup':
				$unControleur->delete($where);
				echo "<script>alert('Suppression de l\'utilisateur réussi !');window.location.href='index.php?page=4';</script>";
				break;
			case 'edit':
				$leUser = $unControleur->selectWhere("*", $where);
				break;
		}
	}

	if (isset($_POST['Modifier'])) {
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$tel = $_POST['tel'];
		$email = $_POST['email'];
		$droits = $_POST['droits'];
		if ($nom != "") {
			if (preg_match("#^[A-Z][a-zA-Z]{1,50}$#", $nom)) {
				if ($prenom != "") {
					if (preg_match("#^[A-Z][a-zA-Z]{1,50}$#", $prenom)) {
						if ($tel != "") {
							$telLength = strlen($tel);
							if ($telLength == 10) {
								if (preg_match("#^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$#", $tel)) {
									if ($email != "") {
										if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
											if (preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z]{2,6}$#", $email)) {
												$where = array("tel"=>$tel);
												$checkTel = $unControleur->selectWhere("tel", $where);
												if (!$checkTel) {
													$where = array("email"=>$email);
													$checkEmail = $unControleur->selectWhere("email", $where);
													if (!$checkEmail) {
														$where = array("iduser"=>$_GET['iduser']);
														$tab = array(
															"nom"=>$nom,
															"prenom"=>$prenom,
															"tel"=>$tel,
															"email"=>$email,
															"mdp"=>$unControleur->generateMdp(),
															"droits"=>$droits
														);
														$unControleur->edit($tab, $where);
														echo "<script>alert('Modification de l\'utilisateur effectuée !');window.location.href='index.php?page=4';</script>";
													} else {
														print($unControleur->setAlert("Cette adresse email est déjà utilisée."));
													}
												} else {
													print($unControleur->setAlert("Ce numéro de téléphone est déjà utilisé."));
												}
											} else {
												print($unControleur->setAlert("Format de l'adresse email incorrect."));
											}
										} else {
											print($unControleur->setAlert("Format de l'adresse email incorrect."));
										}
									} else {
										print($unControleur->setAlert("Veuillez saisir une adresse email."));
									}
								} else {
									print($unControleur->setAlert("Format du numéro de téléphone incorrect."));
								}
							} else {
								print($unControleur->setAlert("Le numéro de téléphone doit contenir exactement 10 chiffres."));
							}
						} else {
							print($unControleur->setAlert("Veuillez saisir un numéro de téléphone."));
						}
					} else {
						print($unControleur->setAlert("Le nom doit commencer par une lettre majuscule, ne doit pas contenir de chiffre, et ne doit pas dépasser 50 caractères."));
					}
				} else {
					print($unControleur->setAlert("Veuillez saisir un prénom."));
				}
			} else {
				print($unControleur->setAlert("Le nom doit commencer par une lettre majuscule, ne doit pas contenir de chiffre, et ne doit pas dépasser 50 caractères."));
			}
		} else {
			print($unControleur->setAlert("Veuillez saisir un nom."));
		}
	}

	if (isset($_POST['Ajouter'])) {
		$nom = $_POST['nom'];
		$prenom = $_POST['prenom'];
		$tel = $_POST['tel'];
		$email = $_POST['email'];
		$droits = $_POST['droits'];
		if ($nom != "") {
			if (preg_match("#^[A-Z][a-zA-Z]{1,50}$#", $nom)) {
				if ($prenom != "") {
					if (preg_match("#^[A-Z][a-zA-Z]{1,50}$#", $prenom)) {
						if ($tel != "") {
							$telLength = strlen($tel);
							if ($telLength == 10) {
								if (preg_match("#^(?:0|\(?\+33\)?\s?|0033\s?)[1-79](?:[\.\-\s]?\d\d){4}$#", $tel)) {
									if ($email != "") {
										if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
											if (preg_match("#^[a-zA-Z0-9._-]+@[a-zA-Z0-9._-]+\.[a-zA-Z]{2,6}$#", $email)) {
												$where = array("tel"=>$tel);
												$checkTel = $unControleur->selectWhere("tel", $where);
												if (!$checkTel) {
													$where = array("email"=>$email);
													$checkEmail = $unControleur->selectWhere("email", $where);
													if (!$checkEmail) {
														$tab = array(
															"nom"=>$nom,
															"prenom"=>$prenom,
															"tel"=>$tel,
															"email"=>$email,
															"mdp"=>$unControleur->generateMdp(),
															"droits"=>$droits
														);
														$unControleur->insert($tab);
														echo "<script>alert('Insertion de l\'utilisateur réussi !');window.location.href='index.php?page=4';</script>";
													} else {
														print($unControleur->setAlert("Cette adresse email est déjà utilisée."));
													}
												} else {
													print($unControleur->setAlert("Ce numéro de téléphone est déjà utilisé."));
												}
											} else {
												print($unControleur->setAlert("Format de l'adresse email incorrect."));
											}
										} else {
											print($unControleur->setAlert("Format de l'adresse email incorrect."));
										}
									} else {
										print($unControleur->setAlert("Veuillez saisir une adresse email."));
									}
								} else {
									print($unControleur->setAlert("Format du numéro de téléphone incorrect."));
								}
							} else {
								print($unControleur->setAlert("Le numéro de téléphone doit contenir exactement 10 chiffres."));
							}
						} else {
							print($unControleur->setAlert("Veuillez saisir un numéro de téléphone."));
						}
					} else {
						print($unControleur->setAlert("Le nom doit commencer par une lettre majuscule, ne doit pas contenir de chiffre, et ne doit pas dépasser 50 caractères."));
					}
				} else {
					print($unControleur->setAlert("Veuillez saisir un prénom."));
				}
			} else {
				print($unControleur->setAlert("Le nom doit commencer par une lettre majuscule, ne doit pas contenir de chiffre, et ne doit pas dépasser 50 caractères."));
			}
		} else {
			print($unControleur->setAlert("Veuillez saisir un nom."));
		}
	}

	if (isset($_POST['Annuler'])) {
		echo "<script>window.location.href='index.php?page=4';</script>";
	}

}

if (isset($_POST['Rechercher'])) {
	$mot = $_POST['mot'];
	$tab = array("iduser", "nom", "prenom", "tel", "email", "droits");
	$lesUsers = $unControleur->selectSearch($tab, $mot);
} else {
	$lesUsers = $unControleur->selectAll("*", "iduser");
}

require_once("vue/vue_utilisateurs.php");

?>