<!-- <div id="formulaire-users"> -->
<div id="formulaire-evenements">

<h2>Insertion d'un Utilisateur</h2>

<form method="post" action="">

	<table>

		<tr>
			<td>Nom : </td>
			<td> <input type="text" name="nom"></td>
		</tr>

		<tr>
			<td>Prénom : </td>
			<td><input type="text" name="prenom"></td>
		</tr>

		<tr>
			<td>Email : </td>
			<td><input type="text" name="email"></td>
		</tr>

		<tr>
			<td>Téléphone : </td>
			<td><input type="text" name="telephone"></td>
		</tr>

		<tr>
			<td>Mot de passe : </td>
			<td><input type="text" name="mdp"></td>
		</tr>

		<tr>
			<td>Droits : </td>
			<td>
				<select name="droits">
					<option value="Admin">Administrateur</option>
					<option value="User">Utilisateur</option>
				</select>
			</td>
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