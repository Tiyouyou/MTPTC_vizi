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
			$vmod=new UserModel;
			if(isset($id) and isset($nom) and isset($prenom) and isset($telephone) and isset($pseudo) and isset ($password) and isset($Statut))
			{
				if($id!=NULL and $nom!=NULL and $prenom!=NULL and $telephone!=NULL and $pseudo!=NULL and $password!=NULL and $Statut!=NULL)
				{
					$rep=$vmod->chekUser($id,$connect);
					if((preg_match ( " #^[0-9]{3}[-/ ]?[0-9]{3}[-/ ]?[0-9]{3}[-/ ]?[0-9]{1}[-/ ]?$# " , $id ) OR preg_match ( " #^[0-9]{2}[-/ ]?[0-9]{2}[-/ ]?[0-9]{2}[-/ ]?[0-9]{4}[-/ ]?[0-9]{2}[-/ ]?[0-9]{5}[-/ ]?$# " , $id))and strlen("$id")>=10)
					{
						if (preg_match ( " #^[0-9]{2}[-/ ]?[0-9]{2}[-/ ]?[0-9]{2}[-/ ]?[0-9]{2}?$# " , $telephone ) and strlen("$telephone")>=8)
						{
							if($rep==1)
							{
								echo '<script>alert("Erreur:code CIN/NIF Existant,Utilisateur  déjà  Enregistrer");</script>';
							}
							else{
								$telephone="+509".$telephone;
								$con=$connect->query("INSERT INTO `utlisateur`(`Id_utilisateur`, `Nom`, `Prenom`,`tel`, `Nom_utilisateur`, `Password`, `Statut`) VALUES ('$id','$nom','$prenom','$telephone','$pseudo','$password','$Statut')");
								echo '<script> alert("Utilisateur Enregistrer.")</script>';
							}
						}else{echo '<script> alert ("Erreur:Le numero de telephone est invalide,format:32236233 OU 32-23-62-33")</script>';}
					}else{echo '<script> alert ("Erreur:CIN/NIF  invalide,format:1002369874 OU 002-569-638-9")</script>';}
				}	else{
						echo '<script> alert ("Erreur:Champ vide, Veuillez Remplir tout les champs du formulaire")</script>';
					}
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
				if((preg_match ( " #^[0-9]{3}[-/ ]?[0-9]{3}[-/ ]?[0-9]{3}[-/ ]?[0-9]{1}[-/ ]?$# " , $id_visiteur ) OR preg_match ( " #^[0-9]{2}[-/ ]?[0-9]{2}[-/ ]?[0-9]{2}[-/ ]?[0-9]{4}[-/ ]?[0-9]{2}[-/ ]?[0-9]{5}[-/ ]?$# " , $id_visiteur ))and strlen("$id_visiteur")>=10)
				{
					if (preg_match ( " #^[0-9]{2}[-/ ]?[0-9]{2}[-/ ]?[0-9]{2}[-/ ]?[0-9]{2}?$# " , $telephone ) and strlen("$telephone")>=8){
						if(preg_match('#^[a-zA-Z;/]+$#',$nom) and preg_match('#^[a-zA-Z;/]+$#',$prenom) and preg_match('#^[a-zA-Z;/]+$#',$personne)){
							if($rep==1)
							{
								echo '<script>alert("Erreur:code CIN/NIF Existant,le Visiteur à déjà été Enregistré");</script>';

							}
							else {
								date_default_timezone_set('America/Los_Angeles');
								$heure = date("H:i");
								$iduser=$_SESSION["Id_utilisateur"];
								$telephone="+509 ".$telephone;
								$con=$connect->query("INSERT INTO `visiteur`(`Id_visiteur`, `Nom`, `Prenom`, `Tel`) VALUES ('$id_visiteur','$nom','$prenom','$telephone')");
								$con2=$connect->query("INSERT INTO `visite`(`Id_visiteur`, `Id_User`, `Departement`, `Personne_a_contacter`,`h_entrer`,`objet_visite`) VALUES ('$id_visiteur','$iduser','$Departement','$personne','$heure ','$objet')");
								echo '<script> alert ("Visiteur Enregistrer!")</script>';
							}
					}
					else{
						echo '<script> alert ("Erreur:les champs Nom,Prenom et personne a visite ne doivent pas avoir de caractere speciaux ni de chiffres.")</script>';
					}
					}else{echo '<script> alert ("Erreur:Le numero de telephone est invalide,format:32236233 OU 32-23-62-33")</script>';}
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
					<th scope="col">Telephone</th>
					<th scope="col">Département</th>
					<th scope="col">Personne visitée</th>
					<th scope="col">Objet De Visite</th>
					<th scope="col">Date De Visite</th>
					<th scope="col">H_ENTRÉE</th>
					<th scope="col"></th>
				</tr>
			</thead>

		';
		//$vizi;
		require("model/Connectiondb.php");
		$connect=Connection();
		$sql=$connect->query("SELECT V.Id_visiteur, V.Nom, V.Prenom, V.Tel,t.Id_visiteur, t.Departement, t.Personne_a_contacter, t.sorti,t.h_entrer,t.Date_d_entree, t.objet_visite FROM visiteur V, visite t WHERE V.Id_visiteur=t.Id_visiteur AND t.sorti=0 ");
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
							<td>'.$visiteur["Tel"].'</td>
							<td>'.$visiteur["Departement"].'</td>
							<td>'.$visiteur["Personne_a_contacter"].'</td>
							<td>'.$visiteur["objet_visite"].'</td>
							<td>'.$visiteur["Date_d_entree"].'</td>
							<td>'.$visiteur["h_entrer"].'</td>';
				if($_SESSION["Statut"]=="0")
				{
						echo'		<td><form method="post" action="controler/Verification.php">
										<SELECT type="hidden" name="val" style="display: none;"><option  value="'.$visiteur["Id_visiteur"].'"</SELECT>
										<input type="submit" name="sorti" value="Sortie">
										</form></td>
							</tr>
						</tbody>


				';
			}
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
						<th></th>
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
									<td>
										<form method="post" action="index.php?enVisit">
											<SELECT type="hidden" name="vizit" style="display: none;"><option  value="'.$visiteur["Id_visiteur"].'"</SELECT>
											<input type="submit" name="sorti" value="Enregistrement de Visite" class="btn2">
										</form
									</td>
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
	function chekUser($id,$con)
	{
		$connect=$con;
		$l=$connect->query("SELECT Id_utilisateur FROM `utlisateur` WHERE Id_utilisateur='$id'");
		while ($user=$l->fetch()) {
			if(isset($user["Id_utilisateur"]))
			{
				return 1;
			}
		}
	}
function chekRapport($jour,$Mois,$Annee,$Departement)
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
				if($Departement!=NULL)
				{
						$l=$connect->query("SELECT R.Id_visiteur,R.Nom,R.Prenom,R.Tel,d.Id_visiteur,d.Date_d_entree,d.h_entrer,d.h_sortie,d.Departement,d.Personne_a_contacter,d.objet_visite  FROM Visite d ,visiteur R WHERE R.Id_visiteur=d.Id_visiteur AND YEAR(Date_d_entree)='$Annee' AND d.Departement='$Departement'");
				}
				else{
						$l=$connect->query("SELECT R.Id_visiteur,R.Nom,R.Prenom,R.Tel,d.Id_visiteur,d.Date_d_entree,d.h_entrer,d.h_sortie,d.Departement,d.Personne_a_contacter,d.objet_visite  FROM Visite d ,visiteur R WHERE R.Id_visiteur=d.Id_visiteur AND YEAR(Date_d_entree)='$Annee' ");
				}
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
				if($Departement!="none")
				{
					$l=$connect->query("SELECT R.Id_visiteur,R.Nom,R.Prenom,R.Tel,d.Id_visiteur,d.Date_d_entree,d.h_entrer,d.h_sortie,d.Departement,d.Personne_a_contacter,d.objet_visite  FROM Visite d ,visiteur R WHERE R.Id_visiteur=d.Id_visiteur AND YEAR(Date_d_entree)='$Annee' AND MONTH(Date_d_entree)='$Mois' AND d.Departement='$Departement'");
				}
				else {
					$l=$connect->query("SELECT R.Id_visiteur,R.Nom,R.Prenom,R.Tel,d.Id_visiteur,d.Date_d_entree,d.h_entrer,d.h_sortie,d.Departement,d.Personne_a_contacter,d.objet_visite  FROM Visite d ,visiteur R WHERE R.Id_visiteur=d.Id_visiteur AND YEAR(Date_d_entree)='$Annee' AND MONTH(Date_d_entree)='$Mois' ");
				}
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
				if($Departement!="none")
				{
					$l=$connect->query("SELECT R.Id_visiteur,R.Nom,R.Prenom,R.Tel,d.Id_visiteur,d.Date_d_entree,d.h_entrer,d.h_sortie,d.Departement,d.Personne_a_contacter,d.objet_visite  FROM Visite d ,visiteur R WHERE R.Id_visiteur=d.Id_visiteur AND YEAR(Date_d_entree)='$Annee' AND MONTH(Date_d_entree)='$Mois' AND DAY(Date_d_entree)='$jour' AND d.Departement='$Departement'");
				}
				else {
					$l=$connect->query("SELECT R.Id_visiteur,R.Nom,R.Prenom,R.Tel,d.Id_visiteur,d.Date_d_entree,d.h_entrer,d.h_sortie,d.Departement,d.Personne_a_contacter,d.objet_visite  FROM Visite d ,visiteur R WHERE R.Id_visiteur=d.Id_visiteur AND YEAR(Date_d_entree)='$Annee' AND MONTH(Date_d_entree)='$Mois' AND DAY(Date_d_entree)='$jour'");
				}
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
			echo 	"	</table>";
		}

	}
function adminRapport ($jour,$Mois,$Annee,$Departement)
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
			$l=$connect->query("SELECT U.id_utilisateur,d.Id_User,R.Id_visiteur,R.Nom,R.Prenom,R.Tel,d.Id_visiteur,d.Date_d_entree,d.h_entrer,d.h_sortie,d.Departement,d.Personne_a_contacter,d.objet_visite  FROM Visite d ,visiteur R,utlisateur U WHERE R.Id_visiteur=d.Id_visiteur AND U.id_utilisateur=d.Id_User AND YEAR(Date_d_entree)='$Annee' AND d.Departement='$Departement'");
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

			$l=$connect->query("SELECT U.id_utilisateur,d.Id_User,R.Id_visiteur,R.Nom,R.Prenom,R.Tel,d.Id_visiteur,d.Date_d_entree,d.h_entrer,d.h_sortie,d.Departement,d.Personne_a_contacter,d.objet_visite  FROM Visite d ,visiteur R,utlisateur U WHERE R.Id_visiteur=d.Id_visiteur AND U.id_utilisateur=d.Id_User AND YEAR(Date_d_entree)='$Annee' AND MONTH(Date_d_entree)='$Mois' AND d.Departement='$Departement'");
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
			$l=$connect->query("SELECT U.id_utilisateur,d.Id_User,R.Id_visiteur,R.Nom,R.Prenom,R.Tel,d.Id_visiteur,d.Date_d_entree,d.h_entrer,d.h_sortie,d.Departement,d.Personne_a_contacter,d.objet_visite  FROM Visite d ,visiteur R,utlisateur U WHERE R.Id_visiteur=d.Id_visiteur AND U.id_utilisateur=d.Id_User AND YEAR(Date_d_entree)='$Annee' AND MONTH(Date_d_entree)='$Mois' AND DAY(Date_d_entree)='$jour' AND d.Departement='$Departement' ");
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
	function search()
	{
		echo'
		<table class="table">
			<thead>
				<tr>
					<th scope="col">CIN/NIF</th>
					<th scope="col">Nom</th>
					<th scope="col">Prénom</th>
					<th scope="col">TELEPHONE</th>
					<th scope="col">Nom_utilisateur</th>
					<th scope="col">MOTS DE PASSE</th>
					<th scope="col">ACTIVATION</th>
				</tr>
			</thead>

		';
		if(isset($_POST["cin"]))
		{
			$cin=htmlspecialchars($_POST["cin"]);
			require("model/Connectiondb.php");
			$connect=Connection();
			$l=$connect->query("SELECT Id_utilisateur,Nom,Prenom,tel,Nom_utilisateur,Active FROM Utlisateur WHERE Id_utilisateur='$cin'");
			while ($Utilisateur=$l->fetch())
			{
				$vizi=$Utilisateur["Id_utilisateur"];
				if(isset($Utilisateur["Id_utilisateur"]))
				{
					echo'
					<tbody>
					<tr>
						<td>'.$Utilisateur["Id_utilisateur"].'</td>
						<td>'.$Utilisateur["Nom"].'</td>
						<td>'.$Utilisateur["Prenom"].'</td>
						<td>'.$Utilisateur["tel"].'</td>
						<td>'.$Utilisateur["Nom_utilisateur"].'</td>';

						echo'<td><form method="post" action="view/ModifiPassword.php?val='.$Utilisateur["Id_utilisateur"].'">
									<input type="submit" name="sorti" value="MODIFIER">
									</form></td>';
						if($Utilisateur["Active"]==0)
						{
							echo'<td><form method="post" action="model/Activation.php">
										<SELECT type="hidden" name="val" style="display: none;"><option  value="'.$Utilisateur["Id_utilisateur"].'"></option>"
										<option  value="'.$Utilisateur["Active"].'></option>"</SELECT>
										<input type="submit" name="desactive" value="DESACTIVER">
										</form></td>';
						}
						if($Utilisateur["Active"]==1)
						{
							echo'<td><form method="post" action="model/Activation.php">
										<SELECT type="hidden" name="val" style="display: none;"><option  value="'.$Utilisateur["Id_utilisateur"].'"></option>"
										<option  value="'.$Utilisateur["Active"].'></option>"</SELECT>
										<input type="submit" name="active" value="Activer">
										</form></td>';
						}


					echo'	</tr>

					</tbody>';
				}
			}
				echo "</table";
		}
		if(!isset($vizi))
		{

		}

	}
	function modificationUser($id)
	{
		require("Connectiondb.php");
			$id=htmlspecialchars($id);
			if(isset($_POST["password"]) AND isset($_POST["passwordConfirm"]))
			{
					if($_POST["password"]!=NULL AND $_POST["passwordConfirm"]!=NULL)
					{
						$pass=htmlspecialchars($_POST["password"]);
						$pass2=htmlspecialchars($_POST["passwordConfirm"]);
						if($pass == $pass2)
						{
							$connect=Connection();
							$vuser= new UserModel;
							$rep=$vuser->chekUser($id,$connect);
							if($rep==1)
							{
								$password=htmlspecialchars($_POST["password"]);
								$long = strlen($password);
								$p="@#$%".$long."123".$password."+_)(*&^";
								$pass=hash('sha512', $p);

								$sql=$connect->query("UPDATE `utlisateur` SET `Password`='$pass' WHERE `Id_utilisateur`='$id' ");
								header("location:ModifiPassword.php?001");
							}
							else {
								header("location:../index.php");
							}

						}
					}
					else {
						echo '<script> alert ("Erreur:Champ vide, Veuillez Remplir tout les champs du formulaire")</script>';
					}

				}

		}
		function Rvisite($cin,$Departement,$personne,$objet,$heure)
		{
			if(isset($cin))
			{
				if($cin!=NULL)
				{
					require("Connectiondb.php");
					$con=Connection();
					$mv= new UserModel;
					$vri=$mv->chekVizitor($cin,$con);
					if($vri==1)
					{
						$user=$_SESSION["Id_utilisateur"];
							$sql=$con->query("INSERT INTO `visite`(`Id_visiteur`, `Id_User`, `Departement`, `Personne_a_contacter`, `h_entrer`, `objet_visite`) VALUES ('$cin','$user','$Departement','$personne','$heure','$objet')");
							echo '<script> alert ("Visiteur Enregistrer!")</script>';
					}
					else{
						echo'<script>alert("Ce Visiteur n\'a pas été enregistré dans le systeme");</script>';
					}
				}
			}
		}

	}
