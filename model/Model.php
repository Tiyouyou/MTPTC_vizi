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
function RecordVisitor($id_visiteur,$nom,$prenom,$telephone,$personne,$Departement,$objet)
{
		$ok=0;
		require("model/Connectiondb.php");
		$connect=Connection();
		$vmodel= new UserModel;
		$rep=$vmodel->chekVizitor($id_visiteur,$connect);
		if(isset($id_visiteur) and isset($nom) and isset($prenom) and isset($telephone) and isset($personne) and isset($Departement) and isset($objet))
		{
			if($id_visiteur!=NULL and $nom!=NULL and $prenom!=NULL and $telephone!=NULL and $personne!=NULL and $Departement!=NULL and $objet!=NULL)
			{
				if( preg_match ( " #^[0-9]{3}[-/ ]?[0-9]{3}[-/ ]?[0-9]{3}[-/ ]?[0-9]{1}[-/ ]?$# " , $id_visiteur ) and strlen("$id_visiteur")>=10)
				{
					if (preg_match ( " #^[0-9]{3}[-/ ]?[0-9]{2}[-/ ]?[0-9]{2}[-/ ]?[0-9]{2}[-/ ]?[0-9]{2}?$# " , $telephone ) and strlen("$telephone")>=11){
						if(preg_match('#^[a-zA-Z;/]+$#',$nom) and preg_match('#^[a-zA-Z;/]+$#',$prenom) and preg_match('#^[a-zA-Z;/]+$#',$personne)){
							if($rep==1)
							{
								echo '<script>alert("Erreur:code CIN/NIF Existant,le Visiteur à déjà été Enregistré");</script>';

							}
							else {
								date_default_timezone_set('America/Los_Angeles');
								$heure = date("H:i");
								$iduser=$_SESSION["Id_utilisateur"];
								$con=$connect->query("INSERT INTO `visiteur`(`Id_visiteur`, `Nom`, `Prenom`, `Tel`) VALUES ('$id_visiteur','$nom','$prenom','$telephone')");
								$con2=$connect->query("INSERT INTO `visite`(`Id_visiteur`, `Id_User`, `Departement`, `Personne_a_contacter`,`h_entrer`,`objet_visite`) VALUES ('$id_visiteur','$iduser','$Departement','$personne','$heure ','$objet')");
								echo '<script> alert ("Visiteur Enregistrer!")</script>';
								header("location:view/printcardsView.php?$id_visiteur & $nom & $prenom & $telephone");
							}
					}
					else{
						echo '<script> alert ("Erreur:les champs Nom,Prenom et personne a visite ne doivent pas avoir de caractere speciaux ni de chiffres.")</script>';
					}
					}else{echo '<script> alert ("Erreur:Le numero de telephone est invalide,format:50932236233 OU 509-32-23-62-33")</script>';}
				}else{echo '<script> alert ("Erreur:CIN/NIF  invalide,format:1002369874 OU 002-569-638-9")</script>';}
			}
			else{
				echo '<script> alert ("Erreur:Champ vide, Veuillez Remplir tout les champs du formulaire")</script>';
			}
		}
	}
	//--------------------------------------------------------------------------------------------------------------------------------------
	//verifier visiteur----------------------------------------------------------------------------------------------------------------------
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
					<th scope="col">Date De Visite</th>
					<th scope="col">H_ENTRÉE</th>
					<th scope="col"></th>
				</tr>
			</thead>

		';
		//$vizi;
		require("model/Connectiondb.php");
		$connect=Connection();
		$sql=$connect->query("SELECT V.Id_visiteur, V.Nom, V.Prenom, t.Id_visiteur, t.Departement, t.Personne_a_contacter, t.sorti,t.h_entrer,t.Date_d_entree FROM visiteur V, visite t WHERE V.Id_visiteur=t.Id_visiteur AND t.sorti=0 ");
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
							<td>'.$visiteur["Date_d_entree"].'</td>
							<td>'.$visiteur["h_entrer"].'</td>
							<td><form method="post" action="controler/Verification.php">
									<SELECT type="hidden" name="val" style="display: none;"><option  value="'.$visiteur["Id_visiteur"].'"</SELECT>
									<input type="submit" name="sorti" value="Sortie">
									</form></td>
						</tr>
					</tbody>


			';

		}
		echo 	"	</table>";

	}

	function SearchVisitor()
	{
		if(isset($_POST["cin"]))
		{
			$cin=htmlspecialchars($_POST["cin"]);
			echo'
			<table class="table">
				<thead>
					<tr>
						<th scope="col">CIN/NIF</th>
						<th scope="col">Nom</th>
						<th scope="col">Prénom</th>
						<th scope="col">Département</th>
						<th scope="col">Personne visitée</th>
						<th scope="col">Date De Visite</th>
						<th scope="col">H_ENTRÉE</th>
						<th scope="col">H_SORTIE</th>
					</tr>
				</thead>

			';
			//$vizi;
			require("model/Connectiondb.php");
			$connect=Connection();
			$sql=$connect->query("SELECT V.Id_visiteur, V.Nom, V.Prenom, t.Id_visiteur, t.Departement, t.Personne_a_contacter, t.sorti,t.h_entrer,t.h_sortie,t.Date_d_entree FROM visiteur V, visite t WHERE V.Id_visiteur=t.Id_visiteur AND V.Id_visiteur='$cin' ");
			while($visiteur=$sql->fetch())
			{
				$vizi=$visiteur["Id_visiteur"];
				if(isset($visiteur["Id_visiteur"]))
				{


					echo'
							<tbody>
								<tr>
									<th scope="row">'.$visiteur["Id_visiteur"].'</th>
									<td>'.$visiteur["Nom"].'</td>
									<td>'.$visiteur["Prenom"].'</td>
									<td>'.$visiteur["Departement"].'</td>
									<td>'.$visiteur["Personne_a_contacter"].'</td>
									<td>'.$visiteur["Date_d_entree"].'</td>
									<td>'.$visiteur["h_entrer"].'</td>
									<td>'.$visiteur["h_sortie"].'</td>
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

	function chekVizitor($id,$con)
	{
		$connect=$con;
		$l=$connect->query("SELECT Id_visiteur FROM `visiteur` WHERE Id_visiteur='$id'");
		while ($user=$l->fetch()) {
			if(isset($user["Id_visiteur"]))
			{
				return 1;
			}
		}
	}
function chekRapport($jour,$Mois,$Annee)
	{
		require("model/Connectiondb.php");
		$connect=Connection();
		if(isset($Annee) OR isset($Mois) OR isset($jour))
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
						<th scope="col">Date De Visite</th>
						<th scope="col">H_ENTRÉE</th>
						<th scope="col">H_SORTIE</th>
						<th scope="col">OBJET DE LA VISITE</th>
					</tr>
				</thead>

			';

			if($Annee!="none" AND $Mois=="none" AND $jour=="none")
			{
				echo $Annee ."<br/>";
				$l=$connect->query("SELECT R.Id_visiteur,R.Nom,R.Prenom,R.Tel,d.Id_visiteur,d.Date_d_entree,d.h_entrer,d.h_sortie,d.Departement,d.Personne_a_contacter,d.objet_visite  FROM Visite d ,visiteur R WHERE R.Id_visiteur=d.Id_visiteur AND YEAR(Date_d_entree)='$Annee'");
					while ($visiteur=$l->fetch()) {
						if(isset($visiteur["Id_visiteur"]))
						{
							echo'
									<tbody>
										<tr>
											<th scope="row">'.$visiteur["Id_visiteur"].'</th>
											<td>'.$visiteur["Nom"].'</td>
											<td>'.$visiteur["Prenom"].'</td>
											<td>'.$visiteur["Departement"].'</td>
											<td>'.$visiteur["Personne_a_contacter"].'</td>
											<td>'.$visiteur["Date_d_entree"].'</td>
											<td>'.$visiteur["h_entrer"].'</td>
											<td>'.$visiteur["h_sortie"].'</td>
											<td>'.$visiteur["objet_visite"].'</td>
										</tr>
									</tbody>';
						}
					}

			}
			if($Annee!="none" AND $Mois!="none" AND $jour=="none")
			{

				$l=$connect->query("SELECT R.Id_visiteur,R.Nom,R.Prenom,R.Tel,d.Id_visiteur,d.Date_d_entree,d.h_entrer,d.h_sortie,d.Departement,d.Personne_a_contacter,d.objet_visite  FROM Visite d ,visiteur R WHERE R.Id_visiteur=d.Id_visiteur AND YEAR(Date_d_entree)='$Annee' AND MONTH(Date_d_entree)='$Mois'");
					while ($visiteur=$l->fetch()) {
						if(isset($visiteur["Id_visiteur"]))
						{
							echo'
									<tbody>
										<tr>
											<th scope="row">'.$visiteur["Id_visiteur"].'</th>
											<td>'.$visiteur["Nom"].'</td>
											<td>'.$visiteur["Prenom"].'</td>
											<td>'.$visiteur["Departement"].'</td>
											<td>'.$visiteur["Personne_a_contacter"].'</td>
											<td>'.$visiteur["Date_d_entree"].'</td>
											<td>'.$visiteur["h_entrer"].'</td>
											<td>'.$visiteur["h_sortie"].'</td>
											<td>'.$visiteur["objet_visite"].'</td>
										</tr>
									</tbody>';
						}
					}

			}
			if($Annee!="none" AND $Mois!="none" AND $jour!="none")
			{
				echo $Annee ."<br/>";
				$l=$connect->query("SELECT R.Id_visiteur,R.Nom,R.Prenom,R.Tel,d.Id_visiteur,d.Date_d_entree,d.h_entrer,d.h_sortie,d.Departement,d.Personne_a_contacter,d.objet_visite  FROM Visite d ,visiteur R WHERE R.Id_visiteur=d.Id_visiteur AND YEAR(Date_d_entree)='$Annee' AND MONTH(Date_d_entree)='$Mois' AND DAY(Date_d_entree)='$jour'");
					while ($visiteur=$l->fetch()) {
						if(isset($visiteur["Id_visiteur"]))
						{
							echo'
									<tbody>
										<tr>
											<th scope="row">'.$visiteur["Id_visiteur"].'</th>
											<td>'.$visiteur["Nom"].'</td>
											<td>'.$visiteur["Prenom"].'</td>
											<td>'.$visiteur["Departement"].'</td>
											<td>'.$visiteur["Personne_a_contacter"].'</td>
											<td>'.$visiteur["Date_d_entree"].'</td>
											<td>'.$visiteur["h_entrer"].'</td>
											<td>'.$visiteur["h_sortie"].'</td>
											<td>'.$visiteur["objet_visite"].'</td>
											<td>'.$visiteur["Id_User].'</td>
										</tr>
									</tbody>';
						}
					}

			}
			echo 	"	</table>";
		}

	}
function adminRapport ($jour,$Mois,$Annee)
{
	require("model/Connectiondb.php");
	$connect=Connection();
	if(isset($Annee) OR isset($Mois) OR isset($jour))
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
					<th scope="col">Date De Visite</th>
					<th scope="col">H_ENTRÉE</th>
					<th scope="col">H_SORTIE</th>
					<th scope="col">OBJET DE LA VISITE</th>
					<th scope="col">ID Agent</th>
				</tr>
			</thead>

		';

		if($Annee!="none" AND $Mois=="none" AND $jour=="none")
		{
			echo $Annee ."<br/>";
			$l=$connect->query("SELECT U.id_utilisateur,d.Id_User,R.Id_visiteur,R.Nom,R.Prenom,R.Tel,d.Id_visiteur,d.Date_d_entree,d.h_entrer,d.h_sortie,d.Departement,d.Personne_a_contacter,d.objet_visite  FROM Visite d ,visiteur R,utlisateur U WHERE R.Id_visiteur=d.Id_visiteur AND U.id_utilisateur=d.Id_User AND YEAR(Date_d_entree)='$Annee'");
				while ($visiteur=$l->fetch()) {
					if(isset($visiteur["Id_visiteur"]))
					{
						echo'
								<tbody>
									<tr>
										<th scope="row">'.$visiteur["Id_visiteur"].'</th>
										<td>'.$visiteur["Nom"].'</td>
										<td>'.$visiteur["Prenom"].'</td>
										<td>'.$visiteur["Departement"].'</td>
										<td>'.$visiteur["Personne_a_contacter"].'</td>
										<td>'.$visiteur["Date_d_entree"].'</td>
										<td>'.$visiteur["h_entrer"].'</td>
										<td>'.$visiteur["h_sortie"].'</td>
										<td>'.$visiteur["objet_visite"].'</td>
										<td>'.$visiteur["Id_User"].'</td>
									</tr>
								</tbody>';
					}
				}

		}
		if($Annee!="none" AND $Mois!="none" AND $jour=="none")
		{

			$l=$connect->query("SELECT U.id_utilisateur,d.Id_User,R.Id_visiteur,R.Nom,R.Prenom,R.Tel,d.Id_visiteur,d.Date_d_entree,d.h_entrer,d.h_sortie,d.Departement,d.Personne_a_contacter,d.objet_visite  FROM Visite d ,visiteur R WHERE R.Id_visiteur=d.Id_visiteur AND U.id_utilisateur=d.Id_User AND YEAR(Date_d_entree)='$Annee' AND MONTH(Date_d_entree)='$Mois'");
				while ($visiteur=$l->fetch()) {
					if(isset($visiteur["Id_visiteur"]))
					{
						echo'
								<tbody>
									<tr>
										<th scope="row">'.$visiteur["Id_visiteur"].'</th>
										<td>'.$visiteur["Nom"].'</td>
										<td>'.$visiteur["Prenom"].'</td>
										<td>'.$visiteur["Departement"].'</td>
										<td>'.$visiteur["Personne_a_contacter"].'</td>
										<td>'.$visiteur["Date_d_entree"].'</td>
										<td>'.$visiteur["h_entrer"].'</td>
										<td>'.$visiteur["h_sortie"].'</td>
										<td>'.$visiteur["objet_visite"].'</td>
										<td>'.$visiteur["Id_User"].'</td>
									</tr>
								</tbody>';
					}
				}

		}
		if($Annee!="none" AND $Mois!="none" AND $jour!="none")
		{
			echo $Annee ."<br/>";
			$l=$connect->query("SELECT R.Id_visiteur,R.Nom,R.Prenom,R.Tel,d.Id_visiteur,d.Date_d_entree,d.h_entrer,d.h_sortie,d.Departement,d.Personne_a_contacter,d.objet_visite  FROM Visite d ,visiteur R WHERE R.Id_visiteur=d.Id_visiteur AND U.id_utilisateur=d.Id_User AND YEAR(Date_d_entree)='$Annee' AND MONTH(Date_d_entree)='$Mois' AND DAY(Date_d_entree)='$jour'");
				while ($visiteur=$l->fetch()) {
					if(isset($visiteur["Id_visiteur"]))
					{
						echo'
								<tbody>
									<tr>
										<th scope="row">'.$visiteur["Id_visiteur"].'</th>
										<td>'.$visiteur["Nom"].'</td>
										<td>'.$visiteur["Prenom"].'</td>
										<td>'.$visiteur["Departement"].'</td>
										<td>'.$visiteur["Personne_a_contacter"].'</td>
										<td>'.$visiteur["Date_d_entree"].'</td>
										<td>'.$visiteur["h_entrer"].'</td>
										<td>'.$visiteur["h_sortie"].'</td>
										<td>'.$visiteur["objet_visite"].'</td>
										<td>'.$visiteur["Id_User"].'</td>
									</tr>
								</tbody>';
					}
				}

		}
		echo 	"	</table>";
	}

}


}
