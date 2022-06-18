<?php 

print($unControleur->setTitle("Gestion des évènements"));

$lEvent = null;

$unControleur->setTable("evenement");

if (isset($_SESSION['droits']) && $_SESSION['droits'] == "admin") {

	if (isset($_GET['action']) && isset($_GET['idevent'])) {
		$action = $_GET['action'];
		$idevent = $_GET['idevent'];
		$where = array("idevent"=>$idevent);
		switch ($action) {
			case 'sup':
				$unControleur->delete($where);
				echo "<script>alert('Suppression de l\'évènement réussi !');window.location.href='index.php?page=1';</script>";
				break;
			case 'edit':
				$lEvent = $unControleur->selectWhere("*", $where);
				break;
		}
	}

	if (isset($_POST['Modifier'])) {
		$where = array("idevent"=>$_GET['idevent']);
		$designation = $_POST['designation'];
		$dateevent = $_POST['dateevent'];
		$heureevent = $_POST['heureevent'];
		$lieuevent = $_POST['lieuevent'];
		$inscrits = $_POST['inscrits'];
		$description = $_POST['description'];
		$prixplace = $_POST['prixplace'];
		$placestotal = $_POST['placestotal'];
		if ($designation != "") {
			if ($lieuevent != "") {
				if ($inscrits < 0) {
					if ($prixplace < 0) {
						if ($placestotal <= 0) {
							if ($inscrits < $placestotal) {
								if ($dateevent >= date('Y-m-d')) {
									$tab = array(
										"designation"=>$designation,
										"dateevent"=>$dateevent,
										"heureevent"=>$heureevent,
										"lieuevent"=>$lieuevent,
										"inscrits"=>$inscrits,
										"description"=>$description,
										"prixplace"=>$prixplace,
										"placestotal"=>$placestotal
									);
									$unControleur->edit($tab, $where);
									echo "<script>alert('Modification de l\'évènement effectuée !');window.location.href='index.php?page=1';</script>";
								} else {
									print($unControleur->setAlert("La date de l'évènement ne peut pas être inférieur à la date du jour."));
								}
							} else {
								print($unControleur->setAlert("Le nombre d'inscrit ne peut pas être inférieur au nombre de places total."));
							}
						} else {
							print($unControleur->setAlert("Le nombre de places total ne peut pas être inférieur ou égale à 0."));
						}
					} else {
						print($unControleur->setAlert("Le prix de la place ne peut pas être inférieur à 0."));
					}
				} else {
					print($unControleur->setAlert("Le nombre d'inscrit ne peut pas être inférieur à 0."));
				}
			} else {
				print($unControleur->setAlert("Veuillez saisir un lieu."));
			}
		} else {
			print($unControleur->setAlert("Veuillez saisir une désignation."));
		}
	}

	if (isset($_POST['Ajouter'])) {
		$designation = $_POST['designation'];
		$dateevent = $_POST['dateevent'];
		$heureevent = $_POST['heureevent'];
		$lieuevent = $_POST['lieuevent'];
		$inscrits = $_POST['inscrits'];
		$description = $_POST['description'];
		$prixplace = $_POST['prixplace'];
		$placestotal = $_POST['placestotal'];
		if ($designation != "") {
			if ($lieuevent != "") {
				if ($inscrits < 0) {
					if ($prixplace < 0) {
						if ($placestotal <= 0) {
							if ($inscrits < $placestotal) {
								if ($dateevent >= date('Y-m-d')) {
									$tab = array(
										"designation"=>$designation,
										"dateevent"=>$dateevent,
										"heureevent"=>$heureevent,
										"lieuevent"=>$lieuevent,
										"inscrits"=>$inscrits,
										"description"=>$description,
										"prixplace"=>$prixplace,
										"placestotal"=>$placestotal
									);
									$unControleur->insert($tab);
									echo "<script>alert('Insertion de l\'évènement réussi !');window.location.href='index.php?page=1';</script>";
								} else {
									print($unControleur->setAlert("La date de l'évènement ne peut pas être inférieur à la date du jour."));
								}
							} else {
								print($unControleur->setAlert("Le nombre d'inscrit ne peut pas être inférieur au nombre de places total."));
							}
						} else {
							print($unControleur->setAlert("Le nombre de places total ne peut pas être inférieur ou égale à 0."));
						}
					} else {
						print($unControleur->setAlert("Le prix de la place ne peut pas être inférieur à 0."));
					}
				} else {
					print($unControleur->setAlert("Le nombre d'inscrit ne peut pas être inférieur à 0."));
				}
			} else {
				print($unControleur->setAlert("Veuillez saisir un lieu."));
			}
		} else {
			print($unControleur->setAlert("Veuillez saisir une désignation."));
		}
	}

	if (isset($_POST['Annuler'])) {
		echo "<script>window.location.href='index.php?page=1';</script>";
	}

}

$unControleur->setTable("vevenements");
if (isset($_POST['Rechercher'])) {
	$mot = $_POST['mot'];
	$tab = array("idevent", "designation", "dateevent", "heureevent", "lieuevent", "inscrits", "description", "prixplace", "placestotal");
	$lesEvenements = $unControleur->selectSearch($tab, $mot);
} else {
	$lesEvenements = $unControleur->selectAll("*", "idevent");
}

require_once("vue/vue_evenements.php");

?>