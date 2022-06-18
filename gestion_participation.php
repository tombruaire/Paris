<?php 

print($unControleur->setTitle("Gestion des participations"));

$laParticipation = null;

$unControleur->setTable("participation");

if (isset($_SESSION['droits']) && $_SESSION['droits'] == "admin") {

	if (isset($_GET['action']) && isset($_GET['idpers']) && isset($_GET['idevent'])) {
		$action = $_GET['action'];
		$idpers = $_GET['idpers'];
		$idevent = $_GET['idevent'];
		$where = array("idpers"=>$idpers, "idevent"=>$idevent);
		switch ($action) {
			case 'sup':
				$unControleur->delete($where);
				break;
			case 'edit':
				$laParticipation = $unControleur->selectWhere("*", $where);
				break;
		}
	}

	if (isset($_POST['Modifier'])) { // NE FONCTIONNE PAS
		$where = array("idpers"=>$_GET['idpers'],"idevent"=>$_GET['idevent']);
		$idpers = $_POST['idpers'];
		$idevent = $_POST['idevent'];
		$prixtotal = $_POST['prixtotal'];
		$dateheureachat = $_POST['dateheureachat'];
		$commentaire = $_POST['commentaire'];
		if ($prixtotal != "") {
			if ($dateheureachat <= date('Y-m-d')) {
				$tab = array(
					"idpers"=>$idpers,
					"idevent"=>$idevent,
					"prixtotal"=>$prixtotal,
					"dateheureachat"=>$dateheureachat,
					"commentaire"=>$commentaire
				);
				$unControleur->edit($tab, $where);
				// echo "<script>alert('Modification de la participation effectuée !');window.location.href='index.php?page=3';</script>";
			} else {
				print($unControleur->setAlert("La date d'achat ne peut pas être supérieur à la date du jour."));
			}
		} else {
			print($unControleur->setAlert("Veuillez saisir le prix total."));
		}
	}

	if (isset($_POST['Ajouter'])) {
		$idpers = $_POST['idpers'];
		$idevent = $_POST['idevent'];
		$prixtotal = $_POST['prixtotal'];
		$dateheureachat = $_POST['dateheureachat'];
		$commentaire = $_POST['commentaire'];
		if ($prixtotal != "") {
			if ($dateheureachat <= date('Y-m-d')) {
				$tab = array(
					"idpers"=>$idpers,
					"idevent"=>$idevent,
					"prixtotal"=>$prixtotal,
					"dateheureachat"=>$dateheureachat,
					"commentaire"=>$commentaire
				);
				$unControleur->insert($tab);
			} else {
				print($unControleur->setAlert("La date d'achat ne peut pas être supérieur à la date du jour."));
			}
		} else {
			print($unControleur->setAlert("Veuillez saisir le prix total."));
		}
	}

	if (isset($_POST['Annuler'])) {
		echo "<script>window.location.href='index.php?page=3';</script>";
	}

}

$unControleur->setTable("vparticipations");
if (isset($_POST['Rechercher'])) {
	$mot = $_POST['mot'];
	$tab = array("idpers", "nom", "prenom", "idevent", "designation", "dateevent", "heureevent", "prixtotal", "dateheureachat", "commentaire");
	$lesParticipations = $unControleur->selectSearch($tab, $mot);
} else {
	$lesParticipations = $unControleur->selectAll("*", "idpers");
}

require_once("vue/vue_participations.php");

?>