<br>

<div id="tableau-evenements">

	<h2>Liste des participations aux prochains Évènements de Paris</h2>

	<table border="1" id="tableau">
		<tr>
			<td id="titre-colonne" class="designation-event">Désignation</td>
			<td id="titre-colonne" class="date-event">Date</td>
			<td id="titre-colonne">Nom</td>
			<td id="titre-colonne">Prénom</td>
			<td id="titre-colonne">Nb Places</td>
			<td id="titre-colonne">Prix Total</td>
			<td id="titre-colonne">Date Achat</td>
			<td id="titre-colonne">Commentaire</td>
			<td id='titre-colonne' class='action-supprimer'>Action</td>

			
		</tr>

<?php

foreach ($lesParticipations as $uneParticipation) {
	echo   "<tr> 
			    <td>".$uneParticipation['designation']."</td>
			   	<td>".$uneParticipation['dateevent']."</td>
			   	<td>".$uneParticipation['nom']."</td>
			   	<td>".$uneParticipation['prenom']."</td>
			   	<td>".$uneParticipation['nbplaces']."</td>
			   	<td>".$uneParticipation['prixtotal']."</td>
			   	<td>".$uneParticipation['dateachat']."</td>
			   	<td>".$uneParticipation['commentaire']."</td>";

	if(isset($_SESSION['droits']) && $_SESSION['droits'] == "Admin") {
		echo "<td><a href='index.php?page=3&action=s&idevent=".$uneParticipation['idevent']."&idpers=".$uneParticipation['idpers']."'> <img src='images/supprimer.png' width='20' height='20'> </a></td>";
	} else if(isset($_SESSION['iduser']) && $_SESSION['iduser'] == $uneParticipation['idpers']) {
		echo "<td><a href='index.php?page=3&action=s&idevent=".$uneParticipation['idevent']."&idpers=".$uneParticipation['idpers']."'> <img src='images/supprimer.png' width='20' height='20'> </a></td>";
	} /* else {
		echo "<td></td>";
	} */

	echo "</tr>";
}

?>

	</table>
<br>
</div>