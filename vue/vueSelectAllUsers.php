<br>
<div id="tableau-evenements">

<h2>Liste des Utilisateurs</h2>

<table border="1" id="tableau">
	<tr>
		<td>ID Users</td>
		<td>Nom</td>
		<td>Prénom</td>
		<td>Email</td>
		<td>Téléphone</td>
		<td>Droits</td>
		<?php
		if(isset($_SESSION['droits']) && $_SESSION['droits'] == "Admin") {
			echo "<td>Action</td>";
		}
		?>
		
	</tr>

<?php

foreach ($lesUsers as $unUser) {
	echo   "<tr> 
			    <td>".$unUser['iduser']."</td>
			   	<td>".$unUser['nom']."</td>
			   	<td>".$unUser['prenom']."</td>
			   	<td>".$unUser['email']."</td>
			   	<td>".$unUser['telephone']."</td>
			   	<td>".$unUser['droits']."</td>";

	if(isset($_SESSION['droits']) && $_SESSION['droits'] == "Admin") {
		echo "<td><a href='index.php?page=5&action=s&iduser=".$unUser['iduser']."'> <img src='images/supprimer.png' width='20' height='20'> </a></td>";
	}
	
	echo "</tr>";
}

?>

</table>
<br>
</div>