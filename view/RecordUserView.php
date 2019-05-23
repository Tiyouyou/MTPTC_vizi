<div class="row">
<div class="col-md-12">
	<h2>Enregistrer Utilisateur</h2>
		<form method="post" action="#">
			<p><input type="text" name="id" minlength="10" maxlength="22"size="50" placeholder="CIN/NIF"></p>
			<p><input type="text" name="nom" minlength="2" maxlength="10" size="50" placeholder="Nom"></p>
			<p><input type="text" name ="prenom" size="50" maxlength="10" placeholder="Prenom"></p>
			<p><input type="tel" name="telephone" minlength="8" maxlength="12" sixe="30" placeholder="Telephone"></p>
			<p><input type="text"name="pseudo" minlength="5" maxlength="8" size="50" placeholder="Nom Utilisateur"></p>
      <p><input type="password" name="password" minlength="8" maxlength="20" size="50" placeholder="Password"></p>
			<P>
				<select name="Statut">
					<option value="1">ADMIN</option>
					<option value="0">AGENT</option>
					<option value="2">DIRECTEUR</option>
				</select>
			</p>
			<p><input type="submit" value="ENREGISTRER" class="btn"></p>
		</form>
</div>
</div>
