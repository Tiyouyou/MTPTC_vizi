
	
<?php
	
	class ControlerUser
	{

		//user connection function-----------------------------------------------------------------------------------------
		function connectionControler()
		{	
			if(!isset($_POST["user"]) AND !isset($_POST["password"]))
			{
				require("view/ConnectionView.php");
			}
			if(isset($_POST["user"]) AND isset($_POST["password"]))
			{

				$user=htmlspecialchars($_POST["user"]);
				$pass=htmlspecialchars($_POST["password"]);
				require("model/Model.php");

				$User= new UserModel;
				$User->UserConnection($user, $pass);
				require("view/UserView.php");

			}		
		}
		//------------------------------------------------------------------------------------------------------------------
		//user record------------------------------------------------------------------------------------------------------------
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
	}