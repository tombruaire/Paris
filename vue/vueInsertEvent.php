<div id="formulaire-evenements">

<h2>Insertion d'un Évènement</h2>

<form method="post" action="">

	<table>

		<tr>
			<td>Désignation de l'Évènement : </td>
			<td> <input type="text" name="designation" placeholder="Match de Foot"></td>
		</tr>

		<tr>
			<td>Date de l'Évènement : </td>
			<td><input type="date" name="dateevent"></td>
		</tr>

		<tr>
			<td>Heure de l'Évènement : </td>
			<td><input type="time" name="heureevent"></td>
		</tr>

		<tr>
			<td>Description de l'Évènement : </td>
			<td><textarea name="description" placeholder="PSG - Lille"></textarea></td>
		</tr>

		<tr>
			<td>Prix de la place de l'Évènement : </td>
			<td><input type="text" name="prixplace" placeholder="150 €"></td>
		</tr>

		<tr>
			<td></td>
			<td>
				<input type="reset" name="Annuler" value="Annuler">
				<input type="submit" name="Valider" value="Valider">
			</td>
		</tr>

	</table>

</form>

</div>