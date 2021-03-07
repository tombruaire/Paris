<br>

<div id="tableau-evenements">

	<h2>Liste des prochains Évènements</h2>

	<table border="1" id="tableau">
		<tr>
			<td id="titre-colonne" class="id-event">ID</td>
			<td id="titre-colonne" class="designation-event">Désignation</td>
			<td id="titre-colonne" class="date-event">Date</td>
			<td id="titre-colonne" class="heure-event">Heure</td>
			<td id="titre-colonne" class="description-event">Description</td>
			<td id="titre-colonne" class="prix-place-event">Prix</td>
			<?php
			if(isset($_SESSION['droits']) && $_SESSION['droits'] == "Admin") {
				echo "<td id='titre-colonne' class='action-supprimer'>Action</td>";
			}
			?>
		</tr>

<?php

foreach ($lesEvenements as $unEvent) {
	echo   "<tr> 
			    <td>".$unEvent['idevent']."</td>
			   	<td>".$unEvent['designation']."</td>
			   	<td>".$unEvent['dateevent']."</td>
			   	<td>".$unEvent['heureevent']."</td>
			   	<td>".$unEvent['description']."</td>
			   	<td>".$unEvent['prixplace']."</td> ";

	if(isset($_SESSION['droits']) && $_SESSION['droits'] == "Admin") {
	echo	   	"<td><a href='index.php?page=2&action=s&idevent=".$unEvent['idevent']."'> <img src='images/supprimer.png' width='20' height='20'> </a></td>";
	}
	echo	 	"</tr>";
}

?>

	</table>
<br>
</div>