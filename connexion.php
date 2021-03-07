<style type="text/css">
#connexion {
	border: 1px solid green;
	background-color: black;
	width: 40%;
	color: white;
	height: 220px;
}

input {
	background-color: black;
	color: white;
	border: 1px solid white;
}

input[type="password"] {
	height: 19px;
}

input[type="submit"] {
	border: 1px solid white;
}
</style>

<?php

if(!isset($_SESSION['email'])){

	echo 	"<div id='connexion'>
				<h3><font color='aqua'><u>Veuillez vous connecter pour accéder au site</u></font></h3>
				<form method='post' action=''>
					<table border='0'>

						<tr>
							<td>Email : </td>
							<td><input type='text' name='email' required></td>
						</tr>

						<br>

						<tr>
							<td>Mot de passe : </td>
							<td><input type='password' name='mdp' required></td>
						</tr>

						<tr>
							<td></td>
							<td><br><input type='submit' name='SeConnecter' value='Connexion'></td>
						</tr>

					</table>
				</form>
			</div>";

} else {

	echo 	"<div style='background-color: green;'>
				<h1>Bienvenue sur le site de la Ville de Paris !</h1>
				<br>
				<a href='#'><img src='images/paris.jpg' width='600' height='200'></a>
				<br><br>
		 	</div>";
}

?>

<br>