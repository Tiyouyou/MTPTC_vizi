

<?php

	class ControlerUser
	{


		//user connection function-----------------------------------------------------------------------------------------
		function connectionControler()
		{
			require("model/Model.php");
			$User= new UserModel;//user class
			if(!isset($_POST["user"]) AND !isset($_POST["password"]))
			{
				require("view/ConnectionView.php");
			}
			if(isset($_POST["user"]) AND isset($_POST["password"]))
			{

				$user=htmlspecialchars($_POST["user"]);
				$password=htmlspecialchars($_POST["password"]);
				$long = strlen($password);
				$p="@#$%".$long."123".$password."+_)(*&^";
				$pass=hash('sha512', $p);
				$User->UserConnection($user, $pass);
				require("view/UserView.php");

			}
		}
		//------------------------------------------------------------------------------------------------------------------
		//user record------------------------------------------------------------------------------------------------------------
		function ConRecordUser()
		{
			require("model/Model.php");
			$User= new UserModel;//user class
			if(isset($_SESSION["Nom_utilisateur"]))
				{
					if($_SESSION["Statut"]==1)
					{
						require("view/RecordUserView.php");
						if(isset($_POST["id"]) AND isset($_POST["nom"]) AND isset($_POST["prenom"]) AND isset($_POST["telephone"]) AND isset($_POST["pseudo"]) AND isset($_POST["password"]) AND isset($_POST["Statut"]))
						{
							$id=$_POST["id"];
							$nom=$_POST["nom"];
							$prenom=$_POST["prenom"];
							$telephone=$_POST["telephone"];
							$pseudo=$_POST["pseudo"];
							$password=$_POST["password"];
							$long = strlen($password);
							$p="@#$%".$long."123".$password."+_)(*&^";
							$pass=hash('sha512', $p);
							$statut=$_POST["Statut"];
							$User->RecordUser($id,$nom,$prenom,$telephone,$pseudo,$pass,$statut);
						}

					}
				}
		}

		function RecordVisitor()
		{
			if(isset($_SESSION["UserName"]) AND isset($_SESSION["Password"]))
			{
				if(isset($_POST["enregistrement"]))
				{
					require("view/UserView.php");
				}

			}

		}
		function ConRecordVisitor()
		{
			require ("model/Model.php");
			$user= new UserModel;
			if(isset($_SESSION["Nom_utilisateur"]))
			{
				if($_SESSION["Statut"]==0)
				{

					require("view/RecordVisitorView.php");
					if(isset($_POST["cin"]) AND isset($_POST["nom"]) AND isset($_POST["prenom"]) AND isset($_POST["telephone"]) AND isset($_POST["personne"]) AND isset($_POST["Departement"]))
					{
						$CIN=$_POST["cin"];
						$nom=$_POST["nom"];
						$prenom=$_POST["prenom"];
						$telephone=$_POST["telephone"];
						$personne=$_POST["personne"];
						$Departement=$_POST["Departement"];
				  	$user->RecordVisitor($CIN,$nom,$prenom,$telephone,$personne,$Departement);
					}

					}
				}

			}
			function conseachVisitor()
			{
				require("view/RechercheView.php");
				require("model/Model.php");
				$user= new UserModel;
				if(isset($_POST["cin"]))
				{
					$user->SearchVisitor();
				}


			}

		}
