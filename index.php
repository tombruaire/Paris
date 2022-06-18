<?php session_start();
require_once("controleur/controleur.class.php");
require_once("controleur/config_bdd.php");
$unControleur = new Controleur($server, $bdd, $user, $mdp);
?>
<!DOCTYPE html>
<html>
<head>
	<title>Gestion des évènements de paris</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
	<style type="text/css">
		body {
			background-image: url('assets/img/bg.jpg');
			background-position: center center;
			background-repeat: no-repeat;
			background-attachment: fixed;
			background-size: cover;
		}
		@media only screen and (max-width: 767px) {
			body {
				background-image: url('assets/img/bg.jpg');
			}
		}
	</style>
</head>
<body>

<?php

if (isset($_POST['Connexion'])) {
	$email = $_POST['email'];
	$mdp = sha1($_POST['mdp']);
	if ($email != "" && $mdp != "") {
		$unControleur->setTable("user");
		$where = array("email"=>$email, "mdp"=>$mdp);
		$unUser = $unControleur->selectWhere("*", $where);
		if (isset($unUser['iduser'])) {
			$_SESSION['iduser'] = $unUser['iduser'];
			$_SESSION['nom'] = $unUser['nom'];
			$_SESSION['prenom'] = $unUser['prenom'];
			$_SESSION['tel'] = $unUser['tel'];
			$_SESSION['email'] = $unUser['email'];
			$_SESSION['droits'] = $unUser['droits'];
			header('Location: /paris/');
		} else {
			$erreur = "Veuillez vérifier vos identifiants.";
		}
	} else {
		$erreur = "Veuillez remplir tous les champs.";
	}
}

if (!isset($_SESSION['iduser'])) {
	require_once("vue/vue_connexion.php");
} else {

?>

<nav class="navbar navbar-expand-lg" style="background-color: #e3f2fd;">
	<div class="container-fluid">
		<a class="navbar-brand text-dark" href="/paris/">Paris</a>
		<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>
		<div class="collapse navbar-collapse" id="navbarSupportedContent">
			<ul class="navbar-nav me-auto mb-2 mb-lg-0">
				<li class="nav-item">
					<a class="nav-link active text-dark" aria-current="page" href="index.php?page=0">Accueil</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active text-dark" aria-current="page" href="index.php?page=1">Évènements</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active text-dark" aria-current="page" href="index.php?page=2">Personnes</a>
				</li>
				<li class="nav-item">
					<a class="nav-link active text-dark" aria-current="page" href="index.php?page=3">Participations</a>
				</li>
				<?php if (isset($_SESSION['droits']) && $_SESSION['droits'] == "admin") { ?>
				<li class="nav-item">
					<a class="nav-link active text-dark" aria-current="page" href="index.php?page=4">Utilisateurs</a>
				</li>
				<?php } ?>
			</ul>
			<?php if (isset($_SESSION['droits']) && $_SESSION['droits'] == "user") { ?>
			<span class="ms-3 badge bg-info text-dark me-4"><?= $_SESSION['email']; ?></span>
			<?php } else if (isset($_SESSION['droits']) && $_SESSION['droits'] == "admin") { ?>
			<span class="ms-3 badge bg-danger me-4"><?= $_SESSION['email']; ?></span>
			<?php } ?>
			<a href="index.php?page=5" class="btn btn-danger">Déconnexion</a>
		</div>
	</div>
</nav>

<div class="container">
	<div class="row d-flex justify-content-center">
		<?php
			if (isset($_GET['page'])) {
				$page= $_GET['page'];
			} else {
				$page = 0;
			}

			switch($page) {
				case 0 :
					require_once("home.php");
					break;
				case 1 :
					require_once("gestion_event.php");
					break;
				case 2 : 
					require_once("gestion_personne.php");
					break;
				case 3 : 
					require_once("gestion_participation.php");
					break;
				case 4 : 
					require_once("gestion_utilisateur.php");
					break;
				case 5 : 
					unset($_SESSION);
					session_destroy();
					header('Location: /paris/');
					break;
				default : 
					require_once("404.php");
					break;
			}
		?>
	</div>
</div>

<?php } ?>

<div class="card text-center fixed-bottom">
	<div class="card-body">
		<h5 class="card-title text-dark">Gestion des évènements de la ville de Paris</h5>
	</div>
	<div class="card-footer text-muted">&copy; Copiright <?= '<script>document.write(/\d{4}/.exec(Date())[0])</script>' ?> - Tom Bruaire</div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>



</body>
</html>