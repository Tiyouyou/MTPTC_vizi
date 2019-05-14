<?php

	/**
	*
	*/
	class UserModel
	{

		//user connection----------------------------------------------------------------------------------
		function UserConnection($user,$password)
		{
			require("model/Connectiondb.php");
			$connect=Connection();
			if($user!=NULL and $password!=NULL)
			{
				$l=$connect->query("SELECT * FROM `utlisateur` WHERE Nom_utilisateur='$user' AND Password='$password'");
				while ($user=$l->fetch()) {
					$_SESSION["Nom_utilisateur"]=$user["Nom_utilisateur"];
					$_SESSION["Password"]=$user["Password"];
					$_SESSION["Statut"]=$user["Statut"];
					$_SESSION["Nom"]=$user["Nom"];
					$_SESSION["Prenom"]=$user["Prenom"];
					$_SESSION["Id_utilisateur"]=$user["Id_utilisateur"];
				}

			}
		}
		//user enregistrement ----------------------------------------------------------------------------------------------------
		function RecordUser($id,$nom,$prenom,$telephone,$pseudo,$password,$Statut)
		{
			require("model/Connectiondb.php");
			$connect=Connection();
			if(isset($id) and isset($nom) and isset($prenom) and isset($telephone) and isset($pseudo) and isset ($password) and isset($Statut))
			{
				$con=$connect->query("INSERT INTO `utlisateur`(`Id_utilisateur`, `Nom`, `Prenom`,`tel`, `Nom_utilisateur`, `Password`, `Statut`) VALUES ('$id','$nom','$prenom','$telephone','$pseudo','$password','$Statut')");
				echo '<script> alert("Utilisateur Enregistrer.")</script>';
			}
		}
		//enregistrement visiteur......................................................................................................
function RecordVisitor($id_visiteur,$nom,$prenom,$telephone,$personne,$Departement)
{
		require("model/Connectiondb.php");
		$connect=Connection();
		if(isset($id_visiteur) and isset($nom) and isset($prenom) and isset($telephone) and isset($personne) and isset($Departement))
		{
			$iduser=$_SESSION["Id_utilisateur"];
			$con=$connect->query("INSERT INTO `visiteur`(`Id_visiteur`, `Nom`, `Prenom`, `Tel`) VALUES ('$id_visiteur','$nom','$prenom','$telephone')");
			$con2=$connect->query("INSERT INTO `visite`(`Id_visiteur`, `Id_User`, `Departement`, `Personne_a_contacter`) VALUES ('$id_visiteur','$iduser','$Departement','$personne')");
			echo '<script> alert ("Visiteur Enregistrer!")</script>';

		}
	}
	//verifier visiteur
	function VerifVisitor()
	{

		echo'
		<table class="table">
			<thead>
				<tr>
					<th scope="col">CIN/NIF</th>
					<th scope="col">Nom</th>
					<th scope="col">Prénom</th>
					<th scope="col">Département</th>
					<th scope="col">Personne visitée</th>
					<th scope="col"></th>
				</tr>
			</thead>

		';
		//$vizi;
		require("model/Connectiondb.php");
		$connect=Connection();
		$sql=$connect->query("SELECT V.Id_visiteur, V.Nom, V.Prenom, t.Id_visiteur, t.Departement, t.Personne_a_contacter, t.sorti FROM visiteur V, visite t WHERE V.Id_visiteur=t.Id_visiteur AND t.sorti=0 ");
		while($visiteur=$sql->fetch())
		{
			$vizi=$visiteur["Id_visiteur"];
			$sorti=$visiteur["sorti"];
			echo'
					<tbody>
						<tr>
							<th scope="row">'.$visiteur["Id_visiteur"].'</th>
							<td>'.$visiteur["Nom"].'</td>
							<td>'.$visiteur["Prenom"].'</td>
							<td>'.$visiteur["Departement"].'</td>
							<td>'.$visiteur["Personne_a_contacter"].'</td>
							<td><form method="post" action="">
									<SELECT type="hidden" name="val" style="display: none;"><option  value="'.$visiteur["Id_visiteur"].'"</SELECT>
									<input type="submit" name="sorti" value="Sortie">
									</form></td>
						</tr>
					</tbody>


			';

		}
		echo 	"	</table>";
		if(isset($_POST["val"]) AND isset($_POST["sorti"]))
		{

			$id=htmlspecialchars($_POST["val"]);
			$sql2=$connect->query("UPDATE `visite` SET `sorti`=1 WHERE `Id_visiteur`='$id' AND `sorti`=0");
		}
	}

	function SearchVisitor()
	{
		if(isset($_POST["cin"]))
		{
			$cin=htmlspecialchars($_POST["cin"]);

			//$vizi;
			require("model/Connectiondb.php");
			$connect=Connection();
			$sql=$connect->query("SELECT V.Id_visiteur, V.Nom, V.Prenom, t.Id_visiteur, t.Departement, t.Personne_a_contacter, t.sorti FROM visiteur V, visite t WHERE V.Id_visiteur=t.Id_visiteur AND V.Id_visiteur='$cin' ");
			while($visiteur=$sql->fetch())
			{
				$vizi=$visiteur["Id_visiteur"];
				if(isset($visiteur["Id_visiteur"]))
				{
					echo'
					<table class="table">
						<thead>
							<tr>
								<th scope="col">CIN/NIF</th>
								<th scope="col">Nom</th>
								<th scope="col">Prénom</th>
								<th scope="col">Département</th>
								<th scope="col">Personne visitée</th>
							</tr>
						</thead>

					';

					echo'
							<tbody>
								<tr>
									<th scope="row">'.$visiteur["Id_visiteur"].'</th>
									<td>'.$visiteur["Nom"].'</td>
									<td>'.$visiteur["Prenom"].'</td>
									<td>'.$visiteur["Departement"].'</td>
									<td>'.$visiteur["Personne_a_contacter"].'</td>
								</tr>
							</tbody>


					';
				}
			}
			echo 	"	</table>";

		}
		if(!isset($vizi))
		{
			echo '<script>alert("Visiteur Invalide");</script>';
		}
	}

}
