<div class="row" >
<div class="col-md-12" id="rvisitor">
	<h2>ENREGISTRER VISITEUR</h2>
		<form method="post" action="#">
			<p><input type="text" name="cin" minlength="10"  maxlength="22" size="50" placeholder="CIN/NIF"></p>
			<p><input type="text" name="nom" maxlength="10" size="50" placeholder="Nom"></p>
			<p><input type="text" name="prenom"size="50" maxlength="10" placeholder="Prenom"></p>
			<p><input type="tel" name="telephone" minlength="11" maxlength="15" sixe="30" placeholder="Telephone"></p>
			<p><input type="text" name="personne" maxlength="10" size="50" placeholder="Personne à visiter"></p>
			<p><select name="Departement">
				<option value="CC">Comptabilité centrale (CC)</option>
				<option value="CDD">Coordination Des Directions Départementales(CDD)</option>
				<option value="CUT">Coordination des Unités Techniques(CUT)</option>
				<option value="DA">Direction Administratif (DA)</option>
				<option value="DT">Direction Des Transports (DT)</option>
				<option value="DTP">Direction des Travaux Publics (DTP)</option>
				<option value="DG">Direction générale (DG)</option>
				<option value="reception">Réception</option>
				<option value="SAG">SAG</option>
				<option value="SCDD">Secrétariat Coordination Des Directions Départementales (SCDD)</option>
				<option value="SM">Secrétariat Ministre (SM)</option>
				<option value="SDT">Secrétaire des Direction des Travaux publics (SDT)</option>
				<option value="SDP">Service du personnel (SDP)</option>
				<option value="UE">Unité Entretien (UE)</option>
				<option value="UTSI">Unité Technique de Statistiques et d’informatique (UTSI)</option>
				<option></option>
			</select></p>
			<p><input type="text" name="objet" maxlength="100" size="50" placeholder="Objet visite"></p>
			<p><input type="submit" value="ENREGISTRER" class="btn"></p>

		</form>
</div>
</div>
