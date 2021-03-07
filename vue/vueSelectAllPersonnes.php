<br>
<div id="tableau-evenements">

<h2>Liste des Personnes</h2>

<table border="1" id="tableau">
	<tr>
		<td>ID Personnes</td>
		<td>Nom</td>
		<td>Prénom</td>
		<td>Email</td>
		<td>Téléphone</td>
		<td>Adresse</td>
		<?php
		if(isset($_SESSION['droits']) && $_SESSION['droits'] == "Admin") {
			echo "<td>Action</td>";
		}
		?>
		
	</tr>

<?php

foreach ($lesPersonnes as $unePersonne) {
	echo   "<tr> 
			    <td>".$unePersonne['idpers']."</td>
			   	<td>".$unePersonne['nom']."</td>
			   	<td>".$unePersonne['prenom']."</td>
			   	<td>".$unePersonne['email']."</td>
			   	<td>".$unePersonne['telephone']."</td>
			   	<td>".$unePersonne['adresse']."</td>";

	if(isset($_SESSION['droits']) && $_SESSION['droits'] == "Admin") {
		echo "<td><a href='index.php?page=3&action=s&idpers=".$unePersonne['idpers']."'> <img src='images/supprimer.png' width='20' height='20'> </a></td>";
	}
	
	echo "</tr>";
}

?>

</table>
<br>
</div>